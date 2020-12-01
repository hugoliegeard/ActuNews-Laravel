@extends('layouts.base')

@section('title', 'Gestion des Articles')

@section('stylesheets')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection

@section('javascripts')
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#postTable').DataTable();
        } );
    </script>
@endsection

@section('content')
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Gestion des Articles</h1>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card p-2 shadow-sm">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table id="postTable" class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Date de rédaction</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->user->firstname }} {{ $post->user->lastname }}</td>
                                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('default.post', [
                                            'category' => $post->category->alias,
                                            'alias' => $post->alias,
                                            'id' => $post->id
                                        ]) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('post.update', [ 'id' => $post->id ]) }}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                        <a href="{{ route('post.delete', [ 'id' => $post->id ]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <p class="text-center">Pas d'article pour le moment.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
