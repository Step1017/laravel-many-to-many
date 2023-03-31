@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center mb-4">
            <div class="col">
                <h1>
                    Crea Progetto
                </h1>
            </div>
        </div>
        @include('partials.errors')
        <div class="row mb-4">
            <div class="col">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo<span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="title"
                            name="title"
                            required
                            maxlength="128"
                            value="{{ old('title') }}" 
                            placeholder="Inserisci il titolo...">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione<span class="text-danger">*</span></label>
                        <textarea 
                            class="form-control" 
                            id="description"
                            name="description"
                            required
                            maxlength="2000"
                            placeholder="Inserisci la descrizione..."> {{ old('description') }}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link<span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="link"
                            name="link"
                            required
                            maxlength="255"
                            value="{{ old('link') }}" 
                            placeholder="Inserisci il link del progetto...">
                    </div>
                    <div class="mb-3">
                        <label for="type_id">
                            Tipologia
                        </label>
                        <select name="type_id" id="type_id" class="form-select">
                            <option value="">Nessuna tipologia</option>
                            @foreach ($types as $type )
                                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="preview" class="form-label">Preview</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="image"
                            name="image"
                            accept="image/*" 
                            placeholder="Inserisci anteprima del progetto...">
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