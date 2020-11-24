@extends('layouts.base')

@section('title', 'Catégorie')

@section('content')
    {{--.p-3.mx-auto.text-center>h1.display-4{ActuNews}--}}
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Catégorie</h1>
    </div>

    {{--.py-5.bg-light>.container>.row>.col-md-4.mt-4--}}
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/500" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/500" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/500" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection