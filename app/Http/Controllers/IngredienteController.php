<?php

namespace App\Http\Controllers;

use App\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $ingredientes = Ingrediente::all();
        return $ingredientes
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
        $data = $request->all();
        $rules = [
            'nombre'=>'required',
            'precio'=>'required|numeric',
         ];
         $msgError = [
            'nombre.required'=>'El nombre es requerido',
            'precio'=>'El precio es requerido',
        ];
        $validation = Validator::make($data, $rules,$msgError);
        if ($validation->fails()){
            return response()->json($validation->errors()->all());
        }
        $new_ingrediente = Ingrediente::create($request->all());
        return $new_ingrediente;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingrediente = Ingrediente::find($id);
        return $ingrediente;
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
            'precio'=>'required|numeric',
         ];
         $msgError = [
            'nombre.required'=>'El nombre es requerido',
            'precio'=>'El precio es requerido',
        ];
        $validation = Validator::make($data, $rules,$msgError);
        if ($validation->fails()){
            return response()->json($validation->errors()->all());
        }
        $ingrediente = Ingrediente::find($id);
        $ingrediente ->fill($request->all())->save();
        return $ingrediente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingrediente = Ingrediente::find($id);
        $ingrediente->delete();
    }
}
