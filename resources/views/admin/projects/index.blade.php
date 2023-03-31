@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center mb-4">
            <div class="col">
                <h1>
                    Tutti i progetti
                </h1>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
                    Aggiungi progetto
                </a>
            </div>
        </div>
        @include('partials.success')
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Titolo</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Link</th>
                            <th scope="col">Preview</th>
                            <th scope="col">Tipologia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->title }}</th>
                                <td>{{ $project->slug }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->link }}</td>
                                <td>{{ $project->image }}</td>
                                <td>
                                    @if ($project->type)
                                        <a href="{{ route('admin.types.show', $project->type->id) }}">
                                            {{ $project->type->name }}
                                        </a>
                                    @else
                                        Nessuna tipologia
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        Dettagli
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning text-light">
                                        <i class="fa-solid fa-pencil text-light"></i>
                                        Modifica
                                    </a>
                                    <form class="d-inline block" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Sei sicura/o di voler eliminare questo progetto? Non sarai più in grado di recuperarlo!');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                            Elimina
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection