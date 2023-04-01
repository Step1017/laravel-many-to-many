@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center mb-4">
            <div class="col">
                <h1>
                    Modifica Progetto
                </h1>
            </div>
        </div>
        @include('partials.errors')
        <div class="row mb-4">
            <div class="col">
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo<span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="title"
                            name="title"
                            required
                            maxlength="128"
                            value="{{ old('title', $project->title) }}" 
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
                            placeholder="Inserisci la descrizione..."> {{ old('description', $project->description) }}
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
                            value="{{ old('link', $project->link) }}" 
                            placeholder="Inserisci il link del progetto...">
                    </div>
                    <div class="mb-3">
                        <label for="type_id">
                            Tipologia
                        </label>
                        <select name="type_id" id="type_id" class="form-select">
                            <option value="">Nessuna tipologia</option>
                            @foreach ($types as $type )
                                <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="technology_id" class="form-label d-block mb-2">
                            Tecnologie
                        </label>
                        @foreach ($technologies as $technology )
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                        type="checkbox" 
                                        id="technology-{{ $technology->id }}" 
                                        name="technologies[]"
                                        @if (old('technologies') && is_array(old('technologies')) && count(old('technologies')) > 0)
                                            {{ in_array($technology->id, old('technologies')) ? 'checked' : '' }}
                                        @elseif($project->technologies->contains($technology))
                                            checked
                                        @endif
                                        {{-- OPPURE AL POSTO DI TUTTO L'IF:
                                        {{ in_array($technology->id, old('technologies', $project->technologies()->pluck('id')->toArray())) ? 'checked' : '' }} --}}
                                        value="{{ $technology->id }}">
                                <label class="form-check-label" for="technology-{{ $technology->id }}">
                                    {{ $technology->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label for="preview" class="form-label">Preview</label>
                            @if ($project->image)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" name="delete_img" id="delete_img">
                                    <label class="form-check-label" for="delete_img">
                                        Cancella immagine
                                    </label>
                                </div>
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$project->image) }}" style="width: 300px" alt="">
                                </div>
                            @endif
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
                        <button type="submit" class="btn btn-success">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection