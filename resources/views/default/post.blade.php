@extends('layouts.base')

@section('title', 'Article')

@section('content')
    {{--.p-3.mx-auto.text-center>h1.display-4{ActuNews}--}}
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Article</h1>
    </div>

    {{--.py-5.bg-light>.container>.row>.col-md-4.mt-4--}}
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="jumbotron">
                        <h1 class="display-4">Hello, world!</h1>
                        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra
                            attention to featured content or information.</p>
                        <hr class="my-4">
                        <p>It uses utility classes for typography and spacing to space content out within the larger
                            container.</p>
                        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
