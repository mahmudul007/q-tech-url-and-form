@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Url') }}</div>

                    <div class="card-body">
                        <hr class="text-danger">
                        <div class="card">
                           
                            <div class="card-body">
                             
                                <h5 class="card-title"> Url:{{$data->main_url}}</h5>
                                <h5 class="card-title"> Short Url: {{$data->short_url}}</h5>
                                <br>
                                <a href="#" class="btn btn-primary">View all made by you</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
