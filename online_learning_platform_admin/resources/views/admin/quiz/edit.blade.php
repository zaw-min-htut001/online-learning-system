@extends('admin.master')

@section('layout')
    <div class="row col-8 offset-2 mt-3">
        <div class="hstack gap-3">
            <h1 class="d-inline">Edit Quiz</h1>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }} !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('admin#updateQuiz', $data->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Choose Your Course</label>
                <select name="course_name" class="form-control  @error('course_name') is-invalid @enderror">
                    <option value="" disabled>Choose Your Course</option>
                    <option value="{{ $data->lesson_id }}" selected>{{ $data->course_name }}</option>
                </select>
                @error('course_name')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Question</label>
                <input type="text" name="quiz_question" class="form-control @error('quiz_question') is-invalid @enderror"
                    value="{{ $data->question }}">
                @error('quiz_question')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 1</label>
                <input type="text" name="opt_1" class="form-control @error('opt_1') is-invalid @enderror"
                    value="{{ $data->option_1 }}">
                @error('opt_1')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 2</label>
                <input type="text" name="opt_2" class="form-control @error('opt_2') is-invalid @enderror"
                    value="{{ $data->option_2 }}">
                @error('opt_2')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 3</label>
                <input type="text" name="opt_3" class="form-control @error('opt_3') is-invalid @enderror"
                    value="{{ $data->option_3 }}">
                @error('opt_3')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 4</label>
                <input type="text" name="opt_4" class="form-control @error('opt_4') is-invalid @enderror"
                    value="{{ $data->option_4 }}">
                @error('opt_4')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Correct Answer</label>
                <input type="text" name="correct_answer"
                    class="form-control @error('correct_answer') is-invalid @enderror" value="{{ $data->answer }}">
                @error('correct_answer')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
