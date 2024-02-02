@extends('frontend.layouts.app')
@section('content')
    <div class="container">



        <div class="row justify-content-center">
            <div class="text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add new category
                </button>

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
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">category
                                            description</span>
                                        <input name="description" type="text" class="form-control"
                                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                    <input type="text" name="modaltype" value="modal" hidden>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="{{ route('categories.show', $item->id) }}">
                                    <button type="button" class="btn btn-primary">View</button>
                                </a>
                                <a href="{{ route('categories.edit', $item->id) }}">
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </a>
                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure to delete this?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
