@extends('frontend.layouts.app')
@section('content')
    <div class="container">
      
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    </div>
                @endif

                <div class="card">
                    <div class="text-end">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-header">{{ __('Category Update') }}</div>

                    <div class="card-body">
                        <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div
                                class="form-group
                                {{ $errors->has('category_name') ? 'has-error' : '' }}">
                                <label for="url">Category Name</label>
                                <input type="text" id="category_name" name="category_name" class="form-control"
                                    placeholder="Enter url" value="{{ $category->category_name }}">
                                <span class="text-danger">{{ $errors->first('category_name') }}</span>
                            </div>
                            <div
                                class="form-group
                                {{ $errors->has('url') ? 'has-error' : '' }}">
                                <label for="url">Description Name</label>
                                <input type="text" id="description" name="description" class="form-control"
                                    placeholder="Enter url" value="{{$category->description}}">
                                <span class="text-danger">{{ $errors->first('description') }}</span>
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
