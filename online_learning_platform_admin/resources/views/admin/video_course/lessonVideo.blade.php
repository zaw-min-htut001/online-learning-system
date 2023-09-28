@extends('admin.master')

@section('layout')
    <div class="mt-5 col-10 offset-1">
        <h2 class="mt-3 mb-3">Create Lesson</h2>

        {{--  --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{--  --}}
        <form class="row g-3" action="{{ route('admin#uploadLesson') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">Lesson name</label>
                <input type="text" class="form-control @error('lesson_name') is-invalid @enderror" name="lesson_name"
                    id="validationDefault01" value="">
                @error('lesson_name')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Video upload</label>
                <input type="file" name="lesson_video" class="form-control @error('lesson_video') is-invalid @enderror"
                    id="validationDefault02" value="">
                @error('lesson_video')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="validationDefaultUsername" class="form-label">Course Name</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend2">Id</span>
                    <select name="lesson_id" class="form-control @error('lesson_id') is-invalid @enderror">
                        <option value="{{ $course_name->id }}" selected>{{ $course_name->name }}</option>
                    </select>
                    @error('lesson_id')
                        <div class="invalid-feedback"> {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>


            <div class="col-12">
                <button class="btn btn-success" type="submit">Submit form</button>
            </div>
        </form>
    </div>
@endsection
