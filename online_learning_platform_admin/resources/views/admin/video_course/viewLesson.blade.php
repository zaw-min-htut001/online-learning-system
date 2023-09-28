    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Learning Dashboard</title>
        <link href="{{ asset('UI_design/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
            integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    </head>

    <body class="sb-nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand text-success fs-3" href="{{ route('dashboard') }}">CodeMentor</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('dashboard') }}">Home <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('admin#viewCourse') }}">My Course <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Link
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin#adminList') }}">Admin Lists</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin#lessonCategory') }}">Category</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin#createCourse') }}">Create Course</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin#editCourse') }}">Manage Course</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin#manageQuiz') }}">Manage Quiz</a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
                <div class="d-flex justify-content-end me-5">
                    <div class="dropdown-center me-3">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-regular fa-circle-user"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" @disabled(true)>Manage Account</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="btn btn-success ms-3" type="submit">Log out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <main>
            <div class="row container-fluid">
                <div class="col-7 mt-3">

                    @foreach ($video as $item)
                        <h1>{{ $item->name }}</h1>

                        <video width="100%" height="500px" controls>
                            <source src="{{ route('admin#getVideo', $item->file_name) }}" type="video/mp4" />
                            <source src="myVideo.mp4" type="video/mp4" />
                            <p>
                                Your browser doesn't support HTML video. Here is a
                                <a href="myVideo.mp4">link to the video</a> instead.
                            </p>
                        </video>
                        {{ $video->appends(request()->query())->links() }}
                    @endforeach

                </div>
                <div class="col-3 offset-2 mt-3">
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

                                                {{ $item->file_name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website {{ date('Y') }}</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
        </div>
        </div>

        <script src="{{ asset('UI_design/js/scripts.js') }}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
        <script src="{{ asset('UI_design/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('UI_design/demo/chart-bar-demo.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('UI_design/js/datatables-simple-demo.js') }}"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
            integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>

    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('script')

    </html>
