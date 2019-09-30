<?php

namespace App\Http\Controllers;

use App\Ingrediente;
use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::all();
        $listas_pizzas_informacion = [];
        foreach($pizzas as $p)
        {
            $precioP = 0;
            $ing = [];
            foreach($p->ingredientes as $ingrediente)
            {
                $precioP += $ingrediente->precio;
                $ing[]= ["id"=>$ingrediente->id,"nombre"=>$ingrediente->nombre,"precio"=>$ingrediente->precio];
            }
            $precioP += $precioP/2;
            $listas_pizzas_informacion[]= [
                "nombre"=> $p->nombre,
                "imagen"=> $p->imagen,
                "precio"=> $precioP,
                "ingredientes" => $ing,
            ] ;
        }
        return $listas_pizzas_informacion;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imagen = "";
        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $nombre = $file->getClientOriginalName();
            $path = Storage::disk('public')->put('image',$file);
            $imagen = asset($path);
        }
        $data = $request->all();
        $rules = [
            'nombre'=>'required',
            'imagen'=>'required',
            'ingredientes_id'=>'required'
         ];
         $msgError = [
            'nombre.required'=>'El nombre es requerido',
            'imagen.required'=>'La imagen es requerido',
            'ingredientes_id.required'=>'Los ingredientes son requerido'
        ];
        $validation = Validator::make($data, $rules,$msgError);
        if ($validation->fails()){
            return response()->json($validation->errors()->all());
        }
        $new_pizza = Pizza::create(array_merge($request->except('ingredientes_id'),['imagen'=>$imagen]) );
        $new_pizza->ingredientes()->sync($request->input('ingredientes_id'));
        $new_pizza->fill(['imagen'=>$imagen])->save();
        return $new_pizza;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pizza = Pizza::find($id);
        return $pizza;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'nombre'=>'required',
         ];
         $msgError = [
            'nombre.required'=>'El nombre es requerido',
        ];
        $validation = Validator::make($data, $rules,$msgError);
        if ($validation->fails()){
            return response()->json($validation->errors()->all());
        }
        $pizza = Pizza::find($id);
        $imagen = $pizza->imagen;
        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $nombre = $file->getClientOriginalName();
            $path = Storage::disk('public')->put('image',$file);
            $imagen = asset($path);
        }
        $pizza ->fill($request->all())->save();
        $pizza->fill(['imagen'=>$imagen])->save();
        return $pizza;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizza = Pizza::find($id);
        $pizza->delete();
    }
}
