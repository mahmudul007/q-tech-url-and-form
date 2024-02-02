@extends('frontend.layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('Form Edit') }}</div>

                    <div class="card-body">
                        <form action="{{ route('forms.update' , $form->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div
                                class="form-group
                                {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="url">Form Title</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Enter title" value="{{ $form->title }}">
                                <span class="text-danger">{{ $errors->first('main_url') }}</span>
                            </div>
                            <div
                                class="form-group mt-2
                                {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label for="url">Select Form Category</label>
                                <select class="form-select" aria-label="Default select example " name="category_id">

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $form->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('main_url') }}</span>
                            </div>
                            <div
                                class="form-group mt-4
                                {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Description</label>
                                <div class="input-group">

                                    <textarea class="form-control" name="description" aria-label="With textarea">
                                        {{ $form->description }}
                                    </textarea>
                                </div>
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
