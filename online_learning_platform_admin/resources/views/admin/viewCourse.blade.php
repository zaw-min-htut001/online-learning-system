@extends('admin.master')

@section('layout')
    <main>
        <div class="container-fluid px-4 mb-5">
            <h1 class="mt-4">Course List</h1>

            <!-- Navbar Search-->
            <form method="get" action="{{ route('admin#courseSearch') }}"
                class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                @csrf
                <div class="input-group mb-5">
                    <input name="courseSearchKey" value="{{ request('courseSearchKey') }}" class="form-control" type="text"
                        placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-success" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>

            {{--  --}}
            <div class="row row-cols-1 row-cols-md-3 g-4 mx-3 ">
                @foreach ($lessonData as $item)
                    <a href="{{ route('admin#viewLesson', $item->id) }}" class="text-decoration-none">
                        <div class="col">
                            <div class="card ">
                                <img src="{{ asset('storage/web_img/' . $item->image) }}" class="card-img-top img-thumbnail"
                                    alt="..." style="height:250px;">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">{{ $item->name }}</h5>
                                    <p class="card-text text-muted">{{ substr($item->content, 0, 50) }}...</p>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success">{{ ucwords($item->category_name) }}</button>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            {{--  --}}


            <div class="mt-3">
                {{ $lessonData->appends(request()->query())->links() }}
            </div>

        </div>
    </main>
@endsection
