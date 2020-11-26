@extends('layouts.base')

@section('title', $post->title)

@section('content')
    {{--.p-3.mx-auto.text-center>h1.display-4{ActuNews}--}}
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">{{ $post->title }}</h1>
    </div>

    {{--.py-5.bg-light>.container>.row>.col-md-4.mt-4--}}
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="jumbotron">
                        <div class="row">
                            <div class="col-6">
                                <img class="img-fluid" src="{{ $post->featuredImage }}"
                                     alt="{{ $post->title }}">
                            </div>
                            <div class="col-6">
                               {!! $post->content !!}
                                <p><small class="text-muted">
                                        {{ $post->user->firstname }} {{ $post->user->lastname }}
                                    </small>
                                </p>
                            </div> <!-- /.col-6 -->
                        </div> <!-- /.row -->
                    </div> <!-- /.jumbotron -->
                </div> <!-- /.col-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.py-5 -->
@endsection
