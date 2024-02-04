@extends('frontend.layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Form title</th>
                            <th scope="col">Form category</th>
                            <th scope="col">Submitted by</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Submitted at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submissions as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>

                                <td>{{ $item->form->title }}</td>
                                <td>{{ $item->form->category->category_name }}</td>
                                <td>{{ $item->SubmissionUser->name }}</td>
                                <td>{{ $item->form->formOwner->name }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('submissions.show', $item->id) }}" class="btn btn-primary">View</a>

                                    <form class="d-inline" action="{{ route('submissions.destroy', $item->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this submission?')">Delete</button>

                                    </form>
                                </td>


                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
