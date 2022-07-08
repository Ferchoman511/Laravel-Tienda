@extends('app') 

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
        <form  method="POST" action="{{ route('categorias.update',['categoria' => $categorias->id]) }}">
            @method('PATCH')
            @csrf
            <div class="mb-3 col">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @error('color')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif

                <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría</label>
                <input type="text" class="form-control mb-2" name="name" value="{{$categorias->name}}" id="exampleFormControlInput1" placeholder="Hogar">
                
                <label for="exampleColorInput" class="form-label">Escoge un color para la categoría</label>
                <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="{{ $categorias->color }}" title="Choose your color">

                <input type="submit" value="Actualizar Categoria" class="btn btn-primary my-2" />
            </div>
        </form>
        <div>
        @if($categorias->tareas->count() > 0)
            @foreach ($categorias->tareas as $tarea)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('tareas-show',['id' => $tarea->id]) }}">{{$tarea->titulo}}</a>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <form method="POST" action="{{ route('tareas-destroy', $tarea->id ) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger bt-sm">Eliminar</button>
                    </form>
                </div>
                @endforeach
            @else  
                No hay tareas para esta categoria                 
            @endif
        </div>
    </div>
</div>
@endsection