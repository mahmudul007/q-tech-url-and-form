@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Category') }}</div>

                    <div class="card-body">
                        <h3>Category: {{ $category->category_name }} </h3>
                        <hr class="text-danger">
                        <div class="card">



                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Form Name</th>
                                        <th>Form Description</th>
                                        <th>Form Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->forms as $form)
                                        <tr>
                                            <td>{{ $form->title }}</td>
                                            <td>{{ $form->description }}</td>
                                            <td><a class="btn btn-warning" href="{{ route('forms.show', $form->id) }}">View
                                                    Form</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>






                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
