<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tareas;
use App\Models\Categorias;

class tareasController extends Controller
{
    public function index()
    {
        $tareas = tareas::all();
        $categorias = Categorias::all();
        return view('tareas.index', ['tareas' => $tareas, 'categorias'=>$categorias]);       
    }
    public function store(Request $request){
        $request->validate([
            'titulo'=>'required|min:3'
        ]);
        $tareas = new tareas;
        $tareas->titulo = $request->titulo;
        $tareas->categoria_id = $request->categoria_id;
        $tareas->save();
        
        return redirect()->route('tareas')->with('success','tarea creada correctamente');
    }
    public function destroy($id)
    {
        $tareas = tareas::find($id);
        $tareas->delete();
        return redirect()->route('tareas')->with('success','Tarea Eliminada');  
    }
    public function show($id)
    {
        $tareas = tareas::find($id);
        $categorias = Categorias::all();
        return view('tareas.show', ['tareas' => $tareas,'categorias' => $categorias]);
    }
    public function update(Request $request, $id)
    {
        $tareas = tareas::find($id);
        $tareas->titulo = $request->titulo;
        $tareas->save();
        //return view('tareas.index', ['success' => "Tarea Actualizada"]);   
        return redirect()->route('tareas')->with('success','tarea Actualizada');
    }
}
