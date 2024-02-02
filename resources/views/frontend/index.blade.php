@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>Home</h1>
                    <p>Login first to create short url </p>
                    <div>
                        @auth

                        <a class="btn btn-success" href="{{ route('url.index') }}">Url create or show</a>
                      @endauth
                    </div>
                  
                </div>
            </div>

        </div>
    @endsection
