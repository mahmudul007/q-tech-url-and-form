@extends('frontend.layouts.app')
@section('content')
    @php
        $option_types = ['text' => 'text', 'radio' => 'radio', 'checkbox' => 'checkbox', 'select' => 'select'];

    @endphp
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
                    <div class="card-header">{{ __('Option Update') }}</div>

                    <div class="card-body">
                        <form action="{{ route('formfields.update', $field->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            @php
                                $options = json_decode($field->options);
                            @endphp

                            <div
                                class="form-group
                                {{ $errors->has('label') ? 'has-error' : '' }}">
                                <label for="url">Option Title</label>
                                <input type="text" id="label" name="label" class="form-control"
                                    placeholder="Enter label" value="{{ $field->label }}">
                                <span class="text-danger">{{ $errors->first('label') }}</span>
                            </div>
                            <div class="form-group mt-2 text-start">
                                <label class=" text text-start">Option type</label>
                                <select class="form-select" aria-label="Default select example" name="field_type"
                                    id="field_type">
                                    <option value="text">default text</option>
                                    @foreach ($option_types as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $key == $field->field_type ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <hr>

                                @foreach (  $options as $key=>$item )
                                <label for="url">Options &nbsp;{{ $key+1}} </label>

                                <input type="text" id="label" name="options[]" class="form-control"
                                    placeholder="Enter label" value="{{ $item }}">
                                <span class="text-danger">{{ $errors->first('main_url') }}</span>
                                @endforeach
                               
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
