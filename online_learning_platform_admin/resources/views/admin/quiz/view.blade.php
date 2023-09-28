@extends('admin.master')

@section('layout')
    <div class="row col-8 offset-2 mt-3">
        <div class="hstack gap-3">
            <h1 class="d-inline">Manage Quiz</h1>
            <a href="{{ route('admin#viewQuiz') }}" class="ms-auto">
                <span class="btn btn-outline-success ">View Your Quiz</span>
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }} !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('admin#addQuiz') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Choose Your Course</label>
                <select name="course_name" class="form-control  @error('course_name') is-invalid @enderror">
                    <option value="" disabled selected>Choose Your Course</option>

                    @foreach ($courseData as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('course_name')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Question</label>
                <input type="text" name="quiz_question"
                    class="form-control @error('quiz_question') is-invalid @enderror">
                @error('quiz_question')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 1</label>
                <input type="text" name="opt_1" class="form-control @error('opt_1') is-invalid @enderror">
                @error('opt_1')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 2</label>
                <input type="text" name="opt_2" class="form-control @error('opt_2') is-invalid @enderror">
                @error('opt_2')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 3</label>
                <input type="text" name="opt_3" class="form-control @error('opt_3') is-invalid @enderror">
                @error('opt_3')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Option 4</label>
                <input type="text" name="opt_4" class="form-control @error('opt_4') is-invalid @enderror">
                @error('opt_4')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Correct Answer</label>
                <input type="text" name="correct_answer"
                    class="form-control @error('correct_answer') is-invalid @enderror">
                @error('correct_answer')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Add New Quiz</button>
        </form>
    </div>
@endsection
