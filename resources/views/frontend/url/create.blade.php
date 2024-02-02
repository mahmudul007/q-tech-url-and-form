@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="text-end">
            <a href="{{route('url.index')}}"class="btn btn-success"> Show All</a>
           
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('Url') }}</div>

                    <div class="card-body">
                        <form action="{{ route('url.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div
                                class="form-group
                                {{ $errors->has('url') ? 'has-error' : '' }}">
                                <label for="url">Url</label>
                                <input type="text" id="main_url" name="main_url" class="form-control"
                                    placeholder="Enter url" value="{{ old('main_url') }}">
                                <span class="text-danger">{{ $errors->first('main_url') }}</span>
                            </div>
                            &nbsp; &nbsp; &nbsp;
                            <br>

                            <input class="btn btn-success" type="submit">


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
