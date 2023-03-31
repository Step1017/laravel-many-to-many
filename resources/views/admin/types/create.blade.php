@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center mb-4">
            <div class="col">
                <h1>
                    Crea Tipologia
                </h1>
            </div>
        </div>
        @include('partials.errors')
        <div class="row mb-4">
            <div class="col">
                <form action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome<span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="name"
                            name="name"
                            required
                            max="255"
                            value="{{ old('name') }}" 
                            placeholder="Inserisci il nome...">
                    </div>
                    <div>
                        <p>
                            N.B. i campi contrassegnati con <span class="text-danger">*</span> sono obbligatori.
                        </p>
                    </div>
                    <div class="btn-box mt-4">
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-warning text-light">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                        <button type="submit" class="btn btn-success">Crea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection