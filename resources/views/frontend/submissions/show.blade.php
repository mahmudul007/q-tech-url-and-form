@extends('frontend.layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="div text-end m-3">
                    <a class="btn btn-success " href="{{route('submissions.index')}}" >all submission</a>
                </div>
            
                <div class="card">
                    <div class="card-header text-center">{{ $submission->form->title }}</div>
                    <div class="text-center text-success">
                        {{ $submission->form->description }}
                        <p class="text-danger">form owned by : {{ $submission->form->formOwner->name }}</p>
                    </div>

                    <div class="card-body">
                        <h6> submitted by:{{ $submission->SubmissionUser->name }}</h6>
                        <h6> submission time :{{ $submission->created_at->diffForHumans() }} </h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Field</th>
                                    <th scope="col">Field Values</th>
                                    <th scope="col">submitted answer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $submissionData = json_decode($submission->submission_data);

                                @endphp


                                @foreach ($submission->form->FormFieldSubmissions as $field)
                                    @php
                                        $options = json_decode($field->options);
                                    @endphp
                                    <tr>
                                        <td>{{ $field->label }}</td>
                                        <td>


                                            @if (!empty($options))
                                                @foreach ($options as $item)
                                                    <p>{{ $item }}</p>
                                                @endforeach
                                            @else
                                                <p>No data available</p>
                                            @endif



                                        </td>
                                        <td>
                                            @foreach ($submissionData as $key => $value)
                                                @if ($field->id == $key)
                                                    <p>{{ $value }}</p>
                                                @endif
                                            @endforeach
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
@endsection
