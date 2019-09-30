<?php

namespace App\Http\Controllers;

use App\Ingrediente;
use App\Pizza;
use Illuminate\Http\Request;


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
            foreach($p->ingredientes as $ingrediente)
            {
                $precioP += $ingrediente->precio;
            }
            $precioP += $precioP/2;
            $listas_pizzas_informacion[]= [
                "nombre"=> $p->nombre,
                "imagen"=> $p->imagen,
                "precio"=> $precioP
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
        $validator = request()->validate([
            'name'=>'required',
            'last_name'=>'required',
            'user_name'=>'required',
            'email'=>'required',
            'birth_date'=>'required',
            'id_role'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'El nombre es requerido',
            'last_name.required'=>'El nombre es requerido',
            'email.required'=>'El nombre es requerido',
            'birth_date.required'=>'El nombre es requerido',
            'id_role.required'=>'El nombre es requerido',
            'password.required'=>'El nombre es requerido'
        ]);
        if ($validator->fails()){
            //dd($validator->errors());
            return response()->json($validator->errors()->all());
        }
        $this->validate($request,[ 'title'=>'required', 'body'=>'required', 'imagen'=>'required', 'source'=>'required', 'publisher'=>'required']);
        $pizza = Pizza::create($request->all());
        $pizza->fill(['image'=>$imagen])->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
