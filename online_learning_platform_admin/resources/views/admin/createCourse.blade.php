@extends('admin.master')

@section('layout')
    <div class="mt-5 col-10 offset-1">
        <h2 class="mt-3 mb-3">Create New Course</h2>

        {{--  --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{--  --}}
        <form class="row g-3" action="{{ route('admin#createNewCourse') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">Course name</label>
                <input type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name"
                    id="validationDefault01" value="">
                @error('course_name')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Course Thumbnail</label>
                <input type="file" name="course_img" class="form-control @error('course_img') is-invalid @enderror"
                    id="validationDefault02" value="">
                @error('course_img')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="validationDefaultUsername" class="form-label">Category Id</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend2">Id</span>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="" disabled selected>--Choose Category--</option>
                        @foreach ($categoryData as $item)
                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback"> {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>
            <div class="col-md-6">
                <label for="validationDefault03" class="form-label">Description</label>
                <textarea name="course_description" class="form-control @error('course_description') is-invalid @enderror"
                    id="validationDefault03" cols="30" rows="10"></textarea>
                @error('course_description')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <button class="btn btn-success" type="submit">Submit form</button>
            </div>
        </form>
    </div>
@endsection
