@extends('admin.master')

@section('layout')
    <div class="mt-5 col-10 offset-1">
        <h2 class="mt-3 mb-3">Edit Lesson</h2>

        {{--  --}}
        @if (session('updated'))
            <div class="alert alert-danger alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('updated') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{--  --}}
        <form class="row g-3" action="{{ route('admin#updateLesson') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <input type="hidden" name="lesson_id" value={{ $videoData->id }}>

                <label for="validationDefault01" class="form-label">Lesson name</label>
                <input type="text" class="form-control @error('lesson_name') is-invalid @enderror" name="lesson_name"
                    id="validationDefault01" value="{{ $videoData->name }}">
                @error('lesson_name')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-4 offset-1">

                <label for="validationDefault02" class="form-label">Lesson Video</label>
                <a href="{{ route('admin#getVideo', $videoData->file_name) }}">{{ $videoData->file_name }}</a>
                <input type="file" class="form-control mt-3 @error('lesson_video') is-invalid @enderror"
                    name="lesson_video" id="validationDefault02" value="{{ $videoData->name }}">
                @error('lesson_video')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="col-12">
                <button class="btn btn-success" type="submit">Update Lesson</button>
            </div>
        </form>

    </div>
@endsection
