@extends('layouts.base')

@section('title', 'Rédiger un Article')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
          integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
          crossorigin="anonymous"/>
@endsection

@section('javascripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'));
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
            crossorigin="anonymous"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                default: 'Glissez-d&eacute;posez un fichier ici ou cliquez',
                replace: 'Glissez-d&eacute;posez un fichier ou cliquez pour remplacer',
                remove:  'Supprimer',
                error:   'D&eacute;sol&eacute;, le fichier est trop volumineux'
            }
        });
    </script>
@endsection

@section('content')

    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Rédiger un Article</h1>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ $post->id == null ? '/admin/article' : '/admin/article/' . $post->id }}" enctype="multipart/form-data" method="POST">
                        @isset($post->id)
                            {{ method_field('PATCH') }}
                        @endisset
                        @csrf
                        {{-- Titre --}}
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text"
                                   name="title"
                                   value="{{ old('title', $post->title) }}"
                                   placeholder="Titre."
                                   class="form-control @error('title') is-invalid @enderror">
                            <small class="form-text text-muted">
                                Saisissez le titre de votre article
                            </small>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Categorie --}}
                        <div class="form-group">
                            <label>Catégorie</label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror">
                                @foreach(\App\Models\Category::all() as $category)
                                    <option @if(isset($post->category->id) && $post->category->id === $category->id) selected @endif value="{{ $category->id }}">{{ $category->name  }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">
                                Choisissez la catégorie de votre article
                            </small>
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Contenu --}}
                        <div class="form-group">
                            <label>Contenu</label>
                            <textarea id="editor" name="content"
                                      placeholder="Contenu."
                                      class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                            <small class="form-text text-muted">
                                Saisissez le contenu de votre article
                            </small>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Illustration | Dropify : https://github.com/JeremyFagis/dropify --}}
                        <div class="form-group">
                            <label>Illustration</label>
                            <input data-default-file="{{ asset("storage/posts/$post->featuredImage") }}" name="featuredImage" class="form-control dropify @error('featuredImage') is-invalid @enderror" type="file">
                            <small class="form-text text-muted">
                                Choisissez l'illustration de votre article
                            </small>
                            @error('featuredImage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-block btn-dark">Publier mon Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
