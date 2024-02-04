@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>Home</h1>
                    <p>Login /Register first to create short url and <br> you can submit form by category or just from list </p>
                    <p> make from when you login as admin </p>
                    <p> you can see all submission from admin </p>
                    <p>username for admin : admin@gmail.com <br>
                    password : 123456789
                    </p>
                    <p>username for user : user@gmail.com <br>
                    password : 123456789
                    </p>

                    <h3> database i attached on 'database/sql_database' folder</h3>
                    <h6>you can also run it via migrating and seeding permissions and role</h6>

                 
                    <div>
                        @auth

                        <a class="btn btn-success" href="{{ route('url.index') }}">Url create or show</a>
                      @endauth
                    </div>

                  
                </div>
            </div>

        </div>
    @endsection
