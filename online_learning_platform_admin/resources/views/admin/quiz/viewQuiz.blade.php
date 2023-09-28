@extends('admin.master')

@section('layout')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Your Quiz</h1>

            <!-- Navbar Search-->
            <form method="get" action="{{ route('admin#searchQuiz') }}"
                class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                @csrf
                <div class="input-group mb-5">
                    <input name="quizSearchKey" value="{{ request('quizSearchKey') }}" class="form-control" type="text"
                        placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-success" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show offset-8 col-4" role="alert">
                    <strong> {{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('deleted'))
                <div class="alert alert-danger alert-dismissible fade show offset-8 col-4" role="alert">
                    <strong> {{ session('deleted') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="card mb-4">

                @if (count($data) == 0)
                    <h3 class="text-center text-danger">There is no Quiz ... !</h3>
                @else
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>Question</th>
                                    <th>Opt-1</th>
                                    <th>Opt-2</th>
                                    <th>Opt-3</th>
                                    <th>Opt-4</th>
                                    <th>Correct Ans:</th>
                                    <th>Related Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->question }}</td>
                                        <td>{{ $item->option_1 }}</td>
                                        <td>{{ $item->option_2 }}</td>
                                        <td>{{ $item->option_3 }}</td>
                                        <td>{{ $item->option_4 }}</td>
                                        <td>{{ $item->answer }}</td>
                                        <td>{{ $item->course_name }}</td>
                                        <td class="">
                                            <button type="button" class="btn btn-light" data-toggle="tooltip"
                                                data-placement="top" title="Edit Quiz">
                                                <a class="col" href="{{ route('admin#editQuiz', $item->id) }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </button>
                                            <button type="button" class="btn btn-light" data-toggle="tooltip"
                                                data-placement="top" title="Delete Quiz">
                                                <a href="{{ route('admin#deleteQuiz', $item->id) }}">
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

            {{ $data->appends(request()->query())->links() }}

        </div>
    </main>
@endsection
