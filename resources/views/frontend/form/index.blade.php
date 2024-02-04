@extends('frontend.layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <h3>All your forms here, you can add question when you enter it</h3>
            <div class="text-end">
                <a class="btn btn-danger" href="{{ route('dashboard') }}">Go back</a>
            </div>

            <hr class="text-warning">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">title</th>
                        <th scope="col">description</th>
                        <th scope="col">category</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->category->category_name }}</td>
                            <td>
                                <a href="{{ route('forms.show', $item->id) }}" class="btn btn-primary">View</a>
                                @can('form_edit')
                                    <a href="{{ route('forms.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                @endcan
                                @can('form_delete')
                                    <form action="{{ route('forms.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
