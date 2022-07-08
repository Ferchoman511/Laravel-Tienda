@extends('app') 

@section('content')
    <div class="container w-25 border p-4 mt-4"> 
    <form action="{{route('tareas')}}" method="POST">
        @csrf
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success')}}</h6>
        @endif
        @error('titulo')
             <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        <div class="mb-3">
            <label for="title" class="form-label">Titulo de la tarea</label>
            <input type="text" class="form-control" name="titulo" >
        </div>
        <label for="categoria_id" class="form-label">Categoria de la tarea</label>
        <select name="categoria_id" class="form-select">
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-2">Crear tarea</button>
    </form>
    <div>
        @foreach ($tareas as $tarea)
        <div class="row py-1">
            <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('tareas-show', ['id' => $tarea->id])}}">{{ $tarea->titulo }}</a>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <form action="{{ route('tareas-destroy', $tarea->id ) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger bt-sm">Eliminar</button>
                </form>
            </div>
        </div>
            
        @endforeach
    </div>
    </div>
@endsection