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
                    <div class="card-header">{{ __('Form') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title"> Title:{{ $form->title }}</h3>
                                <p class="text-muted">desc: {{ $form->description }}</p>
                                <p> Category: <span class="text-success">{{ $form->category->category_name }}</span></p>
                            </div>
                            <div class="col text-end">

                                <a class="btn btn-success" href="{{ $form->id }}/edit"> Edit form</a>
                                <a class="btn btn-danger" href="{{ route('dashboard') }}">Go back</a>



                            </div>
                        </div>



                        <hr class="text-danger">
                        <!-- Button trigger modal -->
                        <div class="text-end mb-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Add Options
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('formfields.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="input-group input-group-sm mb-3">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Label
                                                        name</span>
                                                    <input type="text" class="form-control" name="label">
                                                </div>
                                                <input type="text" value=" {{ $form->id }}" name="form_id" hidden>
                                                <div class="form-group mt-2 text-start">
                                                    <label for="num_options">Number of Options</label>
                                                    <input type="number" class="form-control" name="num_options"
                                                        id="num_options" min="1" value="1">
                                                </div>
                                                <div class="form-group mt-2 text-start">
                                                    <label class=" text text-start">Option type</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="field_type" id="field_type">
                                                        <option value="text">default text</option>
                                                        @foreach ($option_types as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div id="optionsContainer" class="mt-2">

                                                </div>
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
                        <br>


                        <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            @foreach ($questions as $question)
                                <div class="card w-100">

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title">Title: {{ $question->label }}</h5>

                                                <p>Type: {{ $question->field_type }} &nbsp;

                                                </p>
                                            </div>
                                            <div class="col">
                                                <div class="text-end m-2">

                                                    <a href="{{ route('formfields.edit', $question) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a onclick="return confirm('Are you sure to delete this?')"
                                                        href="{{ route('formfield.destroy', $question->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>


                                        @php
                                            $options = json_decode($question->options);
                                        @endphp
                                        @if ($question->field_type == 'radio')
                                            @foreach ($options as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="options[{{ $question->id }}]"
                                                        id="flexRadioDefault1_{{ $item }}"
                                                        value="{{ $item }}">
                                                    <label class="form-check-label"
                                                        for="flexRadioDefault1_{{ $item }}">
                                                        {{ $item }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @elseif ($question->field_type == 'checkbox')
                                            @foreach ($options as $item)
                                                <div class="form-check">
                                                    <input name="options[{{ $question->id }}]" class="form-check-input"
                                                        type="checkbox" value="   {{ $item }}"
                                                        id="flexCheckDefault_{{ $item }}">
                                                    <label class="form-check-label"
                                                        for="flexCheckDefault_{{ $item }}">
                                                        {{ $item }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @elseif ($question->field_type == 'select')
                                            <select class="form-select"name="options[{{ $question->id }}]"
                                                aria-label="Default select example">
                                                @foreach ($options as $item)
                                                    <option value={{ $item }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        @elseif($question->field_type == 'text')
                                            <div class="input-group mb-3">
                                                <input type="text" name="options[{{ $question->id }}]"
                                                    class="form-control" placeholder="write your answer">

                                            </div>
                                        @endif





                                    </div>
                                </div>
                                <br>
                            @endforeach
                            <input type="submit" class="btn btn-success">
                            <input type="text" name="form_id" value="{{$form->id}}" hidden>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Add an event listener to the field_type select to dynamically update the options container
        document.getElementById('field_type').addEventListener('change', function() {
            var selectedFieldType = this.value;
            var optionsContainer = document.getElementById('optionsContainer');
            var numOptions = parseInt(document.getElementById('num_options').value);

            optionsContainer.innerHTML = '';

            if (selectedFieldType === 'radio' || selectedFieldType === 'select' || selectedFieldType ===
                'checkbox') {
                // For radio button, generate 4 options with text boxes
                for (var i = 1; i <= numOptions; i++) {
                    var optionLabel = document.createElement('label');

                    optionLabel.textContent = 'Option ' + i;

                    var optionInput = document.createElement('input');
                    optionInput.className = 'form-control';
                    optionInput.type = 'text';
                    optionInput.name = 'options[]'; // Use an array to collect multiple options

                    optionsContainer.appendChild(optionLabel);
                    optionsContainer.appendChild(optionInput);
                }
            }
        });
    </script>
@endsection
