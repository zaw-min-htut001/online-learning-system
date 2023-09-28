@extends('admin.master')

@section('layout')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin List</h1>

            <!-- Navbar Search-->
            <form method="get" action="{{ route('admin#adminSearch') }}"
                class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                @csrf
                <div class="input-group mb-5">
                    <input name="adminSearchKey" value="{{ request('adminSearchKey') }}" class="form-control" type="text"
                        placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-success" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>

            {{-- // admin deleted status --}}
            @if (session('status'))
                <div class="alert alert-danger alert-dismissible fade show offset-8 col-4" role="alert">
                    <strong> {{ session('status') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="card mb-4">

                <div class="card-body">
                    @if (count($user) === 0)
                        <h1 class="text-center text-danger">There is no User !</h1>
                    @else
                        <table class="table table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td class="">
                                            @if (auth()->user()->id !== $item->id)
                                                <a href="{{ route('admin#adminDelete', $item->id) }}">
                                                    <i class="fa-regular fa-trash-can text-danger"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
