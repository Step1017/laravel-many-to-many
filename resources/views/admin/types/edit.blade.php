@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center mb-4">
            <div class="col">
                <h1>
                    Modifica Tipologia
                </h1>
            </div>
        </div>
        @include('partials.errors')
        <div class="row mb-4">
            <div class="col">
                <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome<span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="name"
                            name="name"
                            required
                            max="255"
                            value="{{ old('name', $type->name) }}" 
                            placeholder="Inserisci il nome...">
                    </div>
                    <div>
                        <p>
                            N.B. il campo contrassegnato con <span class="text-danger">*</span> è obbligatorio.
                        </p>
                    </div>
                    <div class="btn-box mt-4">
                        <a href="{{ route('admin.types.index') }}" class="btn btn-warning text-light">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                        <button type="submit" class="btn btn-success">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection