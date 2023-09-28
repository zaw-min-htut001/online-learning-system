@extends('admin.master')

@section('layout')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Lesson Category</h1>

            <!-- Navbar Search-->
            <form method="get" action="{{ route('admin#categorySearch') }}"
                class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                @csrf
                <div class="input-group mb-5">
                    <input name="categorySearchKey" value="{{ request('adminSearchKey') }}" class="form-control" type="text"
                        placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-success" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>

            {{-- category modal --}}
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="@mdo"><i class="fa-solid fa-circle-plus me-3"></i> Add New Category</button>

            <form action="{{ route('admin#addCategory') }}" method="post">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Category Name</label>
                                        <input required type="text" name="category_name" class="form-control"
                                            id="recipient-name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Category Description</label>
                                        <textarea required name="category_description" class="form-control" id="message-text"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- category modal --}}

            {{-- // admin deleted status --}}
            @if (session('delete'))
                <div class="alert alert-danger alert-dismissible fade show offset-8 col-4" role="alert">
                    <strong> {{ session('delete') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-hover">

                        @if (count($categoryData) == 0)
                            <h1 class="text-center text-danger">There is no Category !</h1>
                        @else
                            <thead class="table-success">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryData as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->category_description }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a class="col" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal1-{{ $item->id }}"
                                                data-bs-whatever="@mdo"><i class="fa-regular fa-pen-to-square"></i></a>

                                            <form id="my-form" action="{{ route('admin#updateCategory', $item->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal fade" id="exampleModal1-{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" id="update-form">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update
                                                                    Category</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form>
                                                                    <div class="mb-3">
                                                                        <input id="id" type="hidden"
                                                                            value="{{ $item->id }}">
                                                                        <label for="recipient-name1"
                                                                            class="col-form-label">Category Name</label>
                                                                        <input type="text" name="category_name"
                                                                            class="form-control @error('category_name') is-invalid @enderror"
                                                                            id="myModal"
                                                                            value="{{ $item->category_name }}">
                                                                        @error('category_name')
                                                                            <div class="invalid-feedback"> {{ $message }}
                                                                            </div>
                                                                        @enderror

                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="message-text1"
                                                                            class="col-form-label">Category
                                                                            Description</label>
                                                                        <textarea name="category_description" class="form-control @error('category_description') is-invalid @enderror"
                                                                            id="message-text1">{{ $item->category_description }}</textarea>
                                                                        @error('category_description')
                                                                            <div class="invalid-feedback"> {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button id="update-data" type="submit"
                                                                    class="btn btn-success">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="{{ route('admin#deleteCategory', $item->id) }}" class="col">
                                                <i class="fa-regular fa-trash-can text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $categoryData->appends(request()->query())->links() }}
                            </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
