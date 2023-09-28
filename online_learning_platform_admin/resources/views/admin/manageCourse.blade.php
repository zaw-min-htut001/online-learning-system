@extends('admin.master')

@section('layout')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage Course</h1>

            <!-- Navbar Search-->
            <form method="get" action="{{ route('admin#listSearch') }}"
                class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                @csrf
                <div class="input-group mb-5">
                    <input name="adminSearchKey" value="{{ request('adminSearchKey') }}" class="form-control" type="text"
                        placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-success" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>

            {{-- // deleted status --}}
            @if (session('deleted'))
                <div class="alert alert-success alert-dismissible fade show offset-8 col-4" role="alert">
                    <strong> {{ session('deleted') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{--  --}}
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-hover">

                        @if (count($courseData) == 0)
                            <h1 class="text-center text-danger">There is no Course !</h1>
                        @else
                            <thead class="table-success">
                                <tr>
                                    <th>ID</th>
                                    <th>Course Name</th>
                                    <th>Description</th>
                                    <th>Course Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courseData as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>{{ Str::substr($item->content, 0, 20) }} ...
                                        </td>
                                        <td>{{ ucwords($item->category_name) }}</td>
                                        <td class="d-flex justify-content-around">
                                            <button type="button" class="btn btn-light" data-toggle="tooltip"
                                                data-placement="top" title="Add Course Lesson">
                                                <a class="col" href="{{ route('admin#createLesson', $item->id) }}">
                                                    <i class="fa-solid fa-folder-plus text-success"></i>
                                                </a>
                                            </button>

                                            <button type="button" class="btn btn-light" data-toggle="tooltip"
                                                data-placement="top" title="Edit Course">
                                                <a class="col" href="{{ route('admin#updateCourse', $item->id) }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </button>

                                            <button type="button" class="btn btn-light" data-toggle="tooltip"
                                                data-placement="top" title="Delete Course">
                                                <a href="{{ route('admin#deleteCourse', $item->id) }}" class="col">
                                                    <i class="fa-regular fa-trash-can text-danger"></i>
                                                </a>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                                {{-- {{ $categoryData->appends(request()->query())->links() }} --}}
                            </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
