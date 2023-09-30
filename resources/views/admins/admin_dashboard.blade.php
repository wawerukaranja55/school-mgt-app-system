@extends('admins.admin_layout')
@section('title','Admin dashboard')
@section('content')
@section('admindashboardpagestyles')
    <style>
        .wrapper{
            border: 1px solid #ccc;
            background-color: #fff;
            width: 100%;
            margin: auto;
        }

        .my-list li {
            padding: 8px;
            padding-left: -194px;
            transition: ease 400ms;
            cursor: pointer;
            display: flex;
            letter-spacing: 1px;
            opacity: 0.85;
        }

        .my-list li p{
            font-size: 16px;
            color: black;
        }

        .my-list li p a{
            padding: 2px;
            font-size: 16px;
            color: rgb(241, 235, 235);
            background: rgb(0, 0, 0);
            border-radius: 50%;
        }

        .my-list li:hover {
            transform: translateX(20px);
            opacity: 1;
        }

        .my-list li:focus-visible {
            outline: 2px solid red;
            outline-offset: 2px;
            border-radius: 4px;
        }

        .my-list {
            list-style: none;
            counter-reset: ordered-list;
        }

        .my-list li:before {
            counter-increment: ordered-list;
            content: counter(ordered-list);
            font-family: "Sharpie", sans-serif;
            margin-right: 10px;
            background-color: #ff4e4e;
            color: #f6f6f6;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
        }
    </style>
@stop
    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">System Analytics</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><span>{{ $noofteachers }}</span></h1>
                                <h6 class="text-white">Teachers</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><span>{{ $noofpupils }}</span></h1>
                                <h6 class="text-white">Pupils</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><span>{{ $noofexamresults }}</span></h1>
                                <h6 class="text-white">Exams Results</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><span>{{ $noofgrades }}</span></h1>
                                <h6 class="text-white">Grades</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body bg-success">
                                <h5 class="card-title font-light text-white mb-0">Recent Exam Results</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Term</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latestresults as $result)
                                        <tr>
                                            <td>{{ $result->pupilresultsname->pupil_name }}</td>
                                            <td class="text-success">{{ $result->pupilresultsgrade->grade_name }}</td>
                                            <td class="text-success">{{ $result->term }}</td>
                                            <td class="text-success">{{ $result->year }}</td>
                                            <td>
                                                <a href="/admin/view_pupil_perfomance/{{ $result->pupilresultsname->id }}/{{ $result->term }}/{{ $result->year }}" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Update">
                                                    <i class="fa-solid fa-eye"  style="font-size: 15px;"></i>
                                                </a>
                                                <a href="/admin/download_pupil_perfomance/{{ $result->pupilresultsname->id }}/{{ $result->term }}/{{ $result->year }}" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Update">
                                                    <i class="fa-solid fa-download" style="font-size: 15px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body bg-success">
                                <h5 class="card-title font-light text-white mb-0">How the system works.</h5>
                            </div>
                            <div class="wrapper">
                                <ol class="my-list">
                                    <li tabindex="1"><p>Add All pupils in the school with thier specific details.Click <a href="/admin/add_pupil">here</a> to register the pupils</p></li>
                                    <li tabindex="1"><p>Add An Exam that you want to add Results.Click <a href="/admin/add_exam">here</a> to register the Exam</p></li>
                                    <li tabindex="1"><p>Add the Results for each pupil by selectng the exam and the class they belong.Click <a href="/admin/add_exam_results">here</a> to access the page</p></li>
                                    <li tabindex="1"><p>Add all the total marks for every exam in the term,you can now be able to view the mean grade for every pupil whereby you can be able to graduate them to the next class.Click <a href="/admin/all_pupil_perfomance">here</a> to access the page</p></li>
                                </ol>
                            </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->

@endsection

@section('admindashboardscript')
    <script>
        

    </script>
@stop