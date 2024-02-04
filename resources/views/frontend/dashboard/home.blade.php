@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3>Form part</h3>
                        <a href="{{route('categories.index')}}">
                            <button type="button" class="btn btn-primary"> Categories </button>
                        </a>

                        @can('form_create')
                        <a href="{{url('forms/create')}}">
                            <button type="button" class="btn btn-primary"> Form create </button>
                        </a>
                        @endcan
                        <a href="{{url('forms')}}">
                            <button type="button" class="btn btn-primary"> All Forms </button>
                        </a>
                        @can('special_access')
                        <a href="{{route('submissions.index')}}">
                            <button type="button" class="btn btn-primary"> All submitted form </button>
                        </a>
                        @endcan

                        <hr>
                        

                        <a href="/url">
                            <button type="button" class="btn btn-primary"> Url create </button>
                        </a>
                        <a href="{{ route('url.index') }}">
                            <button type="button" class="btn btn-warning"> Your All Url </button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
