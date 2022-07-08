@extends('app')
@section('content')
    <div class="container w-25 border p-4">
        <div class="row mx-auto">
            <form  method="POST" action="{{route('categorias.store')}}">
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
                    <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1" placeholder="Hogar">
                    
                    <label for="exampleColorInput" class="form-label">Escoge un color para la categoría</label>
                    <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="#563d7c" title="Choose your color">

                    <input type="submit" value="Crear Categoria" class="btn btn-primary my-2" />
                </div>
            </form>
            <div>
                @foreach ($categorias as $categoria)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a class="d-flex align-items-center gap-2" href="{{ route('categorias.show',['categoria' => $categoria->id]) }}">
                            <span class="color-container" style="background-color: {{$categoria->color}}"></span>{{$categoria->name}}
                        </a>
                    </div>
                    <div class="col md-3 d-flex justify-content-end">
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$categoria->id}}">Eliminar categoria</button>
                    </div>
                </div>



                <div class="modal fade" id="modal{{$categoria->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">¿Seguro que quieres eliminar?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Al eliminar la categoría <strong>{{ $categoria->name }}</strong> se eliminan todas las tareas asignadas a la misma. 
                                ¿Está seguro que desea eliminar la categoría <strong>{{ $categoria->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <form  action="{{route('categorias.destroy',['categoria'=> $categoria->id ])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button  type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection