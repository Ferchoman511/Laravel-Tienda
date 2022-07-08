@extends('app') 

@section('content')
    <div class="container w-25 border p-4 mt-4"> 
    <form action="{{route('tareas-update',['id'=>$tareas->id])}}" method="POST">
    @method('PATCH')    
    @csrf
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success')}}</h6>
        @endif
        @error('titulo')
             <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        <div class="mb-3">
            <label for="title" class="form-label">Titulo de la tarea</label>
            <input type="text" class="form-control" name="titulo" value= "{{ $tareas->titulo}}" >
        </div>
        <button type="submit" class="btn btn-primary">Actualizar tarea</button>
    </form>
   
    </div>
@endsection