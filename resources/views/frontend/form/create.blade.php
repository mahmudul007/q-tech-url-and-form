@extends('frontend.layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="text-end">
                    <!-- Button trigger modal -->
                    @can('category_create')
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add new category
                    </button>
                    @endcan

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">category
                                                name</span>
                                            <input type="text" name="category_name" class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">category
                                                description</span>
                                            <input name="description" type="text" class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <input type="text" name="modaltype" value="modal" hidden>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
                    <div class="card-header">{{ __('Form create') }}</div>

                    <div class="card-body">
                        <form action="{{ route('forms.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div
                                class="form-group
                                {{ $errors->has('url') ? 'has-error' : '' }}">
                                <label for="url">Form Title</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Enter title" value="{{ old('main_url') }}">
                                <span class="text-danger">{{ $errors->first('main_url') }}</span>
                            </div>
                            <div
                                class="form-group mt-2
                                {{ $errors->has('url') ? 'has-error' : '' }}">
                                <label for="url">Select Form Category</label>
                                <select class="form-select" aria-label="Default select example " name="category_id">
                                  
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('main_url') }}</span>
                            </div>
                            <div
                                class="form-group mt-4
                                {{ $errors->has('url') ? 'has-error' : '' }}">
                                <label for="url">Description</label>
                                <div class="input-group">

                                    <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
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
