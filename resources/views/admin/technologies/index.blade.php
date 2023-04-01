@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center mb-4">
            <div class="col">
                <h1>
                    Tutte le tecnologie
                </h1>
                <a href="{{ route('admin.technologies.create') }}" class="btn btn-success">
                    Aggiungi tecnologia
                </a>
            </div>
        </div>
        @include('partials.success')
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Slug</th>
                            <th scope="col"># Progetti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technologies as $technology)
                            <tr>
                                <th scope="row">{{ $technology->name }}</th>
                                <td>{{ $technology->slug }}</td>
                                <td>{{ $technology->projects()->count() }}</td> {{-- sarebbe SELECT COUNT(*) FROM projects WHERE technology_id = $technology->id --}}
                                <td>
                                    <a href="{{ route('admin.technologies.show', $technology->id) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        Dettagli
                                    </a>
                                    <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-warning text-light">
                                        <i class="fa-solid fa-pencil text-light"></i>
                                        Modifica
                                    </a>
                                    <form class="d-inline block" action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST" onsubmit="return confirm('Sei sicura/o di voler eliminare questa tecnologia? Non sarai più in grado di recuperarla!');">
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