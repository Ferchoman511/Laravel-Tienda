<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorias;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::all();
    
        return view('categorias.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categorias|max:255',
            'color' => 'required|max:7'
        ]);
        $categorias = new Categorias;
        $categorias->name = $request->name;
        $categorias->color = $request->color;
        $categorias->save();
         return redirect()->route('categorias.index')->with('success', 'Nueva categoria agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorias = Categorias::find($id);

        return view('categorias.show',['categorias' => $categorias]);

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
    public function update(Request $request,$id)
    {
        $categorias = Categorias::find($id);
        $categorias->name = $request->name;
        $categorias->color = $request->color;
        $categorias->save();

        return redirect()->route('categorias.index')->with('success', 'categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($categorias)
    {
        $categorias = Categorias::find($categorias);
        $categorias->tareas()->each(function($tarea){$tarea->delete();});
        $categorias->delete();

        return redirect()->route('categorias.index')->with('success','Categoria eliminada');
    }
}
