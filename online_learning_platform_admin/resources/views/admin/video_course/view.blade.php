@extends('admin.master')

@section('layout')
    <main>

        <div class="container text-center mt-3">
            <h1>{{ $data->name }}</h1>
            <div class="row container">
                <div class="col mt-5">
                    <img src="{{ asset('storage/web_img/' . $data->image) }}" alt="..." style="height:70%; width:300px"
                        class="img-thumbnail">
                    <div class="mt-5">
                        <a href="{{ route('admin#viewLessonCourse', $data->id) }}"><button
                                class=" btn btn-outline-primary">Watch
                                Now</button></a>
                    </div>
                </div>
                <div class="col mt-5">
                    <h3 class="text-start">About Course</h3>
                    <p class="text-start text-muted">{{ $data->content }}</p>
                    <div class="text-start">
                        <h3>Course Outline</h3>
                        @foreach ($video_data as $item)
                            <div class="">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                {{ $item->name }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body"><i
                                                    class="fa-solid fa-clapperboard text-primary"></i>
                                                {{ $item->file_name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
