@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <hr>
        <div class="text-end">
            <a href="/url/create"> <button class="btn btn-success">Create Url</button></a>
            <a href="/dashboard"> <button class="btn btn-danger">Back</button></a>

        </div>
        <h3>Url Listing</h3>
        <div class="row justify-content-center">


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Url</th>
                        <th scope="col">Short Url</th>
                        <th scope="col">Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($urls as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->user->name }}</td>
                            <td> {{ $item->main_url }}</td>
                            <td> <a href="{{ url('/urlxx/' . $item->short_url) }}" target="blank">
                                    {{ $item->short_url }}</a></td>
                            <td>{{ $item->hits }}</td>
                            <td>
                                <a href="/url/{{ $item->id }}/edit"> <button class="btn btn-primary">Edit</button></a>
                                <form action="{{ route('url.destroy', $item->id) }}" method="POST" class="d-inline">
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
