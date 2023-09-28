@extends('admin.master')

@section('layout')
    <div class="mt-5 col-10 offset-1">
        <h2 class="mt-3 mb-3">Update Course</h2>

        {{--  --}}
        @if (session('updated'))
            <div class="alert alert-danger alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('updated') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{--  --}}
        <form class="row g-3" action="{{ route('admin#updateCreatedCourse') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <input type="hidden" name="course_Id" value={{ $courseData->id }}>

                <label for="validationDefault01" class="form-label">Course name</label>
                <input type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name"
                    id="validationDefault01" value="{{ $courseData->name }}">
                @error('course_name')
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
                            <option @if ($item->id == $courseData->category_id) selected @endif value="{{ $item->id }}">
                                {{ $item->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback"> {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="validationDefault02" class="form-label">Course Thumbnail</label>
                    <img src="{{ asset('storage/web_img/' . $courseData->image) }}" class="card-img-top thumbnail"
                        alt="..." style="height:250px;">
                    <input type="file" name="course_img" class="form-control @error('course_img') is-invalid @enderror"
                        id="validationDefault02" value="">
                    @error('course_img')
                        <div class="invalid-feedback"> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="validationDefault03" class="form-label">Description</label>
                    <textarea name="course_description" class="form-control @error('course_description') is-invalid @enderror"
                        id="validationDefault03" cols="30" rows="10">{{ $courseData->content }}</textarea>
                    @error('course_description')
                        <div class="invalid-feedback"> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>



            <div class="col-12">
                <button class="btn btn-success" type="submit">Update Course</button>
            </div>
        </form>

        {{-- //  deleted status --}}
        @if (session('deleted'))
            <div class="alert alert-danger alert-dismissible fade show offset-8 col-4" role="alert">
                <strong> {{ session('deleted') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4 mt-4">

            @if (count($lessonVideo) == 0)
                <h3 class="text-danger text-center">There is no Lesson ...</h3>
            @else
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>Lesson Name</th>
                                <th>Lesson Video</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($lessonVideo as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->file_name }}</td>

                                    <td class="">
                                        <button type="button" class="btn btn-light" data-toggle="tooltip"
                                            data-placement="top" title="Edit Lesson">
                                            <a class="col" href="{{ route('admin#editLesson', $item->id) }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </button>
                                        <button type="button" class="btn btn-light" data-toggle="tooltip"
                                            data-placement="top" title="Delete Lesson">
                                            <a href="{{ route('admin#deleteLesson', $item->id) }}">
                                                <i class="fa-regular fa-trash-can text-danger"></i>
                                            </a>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
@endsection
