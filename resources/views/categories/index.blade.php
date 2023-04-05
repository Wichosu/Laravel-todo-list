@extends('app')

@section('content')
  <div class="container w-25 border p-4 my-4">
    <div class="row mx-auto">
      <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        @if (session('success'))
          <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

        @error('name')
          <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        <div class="mb-3">
          <label for="name" class="form-label">Nombre de la categoría</label>
          <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
          <label for="color" class="form-label">Color de la categoría</label>
          <input type="color" name="color" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Crear nueva categoría</button>
      </form>

      <div>
        @foreach ($categories as $category)
          <div class="row py-1">
            <div class="col-md d-flex align-items-center justify-content-between">
              <a class="d-flex align-items-center gap-2 text-decoration-none" href="{{ route('categories.show', ['category'=>$category->id]) }}">
                <span class="color-container" style="width: 1rem; height: 1rem;background-color: {{ $category->color }}"></span> {{ $category->name }}
              </a>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ $category->name }}">
                Eliminar Categoria
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="{{ $category->name }}" tabindex="-1" aria-labelledby="{{ $category->name }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $category->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form action="{{ route('categories.destroy', ['category'=>$category->id]) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
