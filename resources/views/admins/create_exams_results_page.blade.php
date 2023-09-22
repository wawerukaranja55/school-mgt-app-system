@extends('admins.admin_layout')
@section('title','Add Exam Results Per Class')
@section('content')

@section('adminaddexamresultspagestyles')
    <style>
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
            }

            table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
            }

            table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
            }

            table th,
            table td {
            padding: .625em;
            text-align: center;
            }

            table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
            }

            @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }
            
            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
            
            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }
            
            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }
            
            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
            
            table td:last-child {
                border-bottom: 0;
            }
            }
        
    </style>
@stop

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Add Exam Results For each Grade</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add exam Results</li>
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
                
                <div class="row" style="
                display: flex;
                justify-content: center;">
                    <div class="col-md-12">
                        <a class="btn btn-dark" href="{{ route('admin.pupils.page') }}">All Pupils in the school</a>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-lg-10 col-md-10 mx-auto">
                        <div class="panel-heading mt-5" style="text-align: center; font-size:18px;"> 
                            <h3 class="mb-2 panel-title">Find a Class to add Exam Results</h3>
                        </div>
                            <div class="card padding-card product-card">
                                <ul class="alert alert-warning d-none error_list"></ul>
                                <div class="card-body">
                                    <label><span class="text-danger inputrequired">Step 1.</span> Select the name of the Exam<span class="text-danger inputrequired">*</span></label><br>
                                    <select id="exam-results-id" class="adminselect2 form-control text-white bg-dark" style="width: 100%;" required>
                                        <option value=" " disabled selected>Select an Exam</option>
                                        @foreach($unfilledexams as $exam)
                                            <option value="{{ $exam['id'] }}">{{ $exam->exam_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="card-body">
                                    <label><span class="text-danger inputrequired">Step 2.</span> Select a class<span class="text-danger inputrequired">*</span></label><br>

                                    <input type="hidden" id="exams_id" name="exam_results"/>
                                    <select name="class_results_id" id="class_id_results" class="adminselect2 form-control text-white bg-dark" style="width: 100%;" required>
                                        <option value=" " disabled selected>Select a Class</option>
                                        @foreach($unfilledgrades as $grade)
                                            <option value="{{ $grade['id'] }}">{{ $grade->grade_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>

                <div class="row">    
                    <div class="col-lg-10 col-md-10 mx-auto">
                        <div id="add_results_form_table">
                            <div class="card padding-card">
                                <div class="card-body">
                                    <label><span class="text-danger inputrequired">Step 3.</span>Add Pupils Results for the class<span class="text-danger inputrequired">*</span></label><br>
                                    
                                    <table>
                                        <thead>
                                          <tr>
                                            <th>Pupil Name</th>
                                            <th class="d-none">Pupil id</th>
                                            <th>Exam Name</th>
                                            <th>Maths</th>
                                            <th>English</th>
                                            <th>Kiswa</th>
                                            <th>Home Sci</th>
                                            <th>Science</th>
                                            <th>CRE</th>
                                            <th>Social Studies</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <ul class="alert alert-warning d-none results_error_list"></ul>
                                        <tbody id="addresultstbody">
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->

            {{-- form method="POST" action="javascript:void(0);" class="add-new-exam-results-form">@csrf --}}
            <!-- End Container fluid  -->

@endsection

@section('adminfindclassscript')
    <script>
        // show houses based on the dropdown selected
        $("#exam-results-id").on('change',function(){

            var examid = $('#exam-results-id').val();

            $('#exams_id').val(examid);
        });

        $("#class_id_results").on('change',function(){

            var examid = $('#exams_id').val();

            var classid=$('#class_id_results').val();

            $.ajax({
                type:"GET",
                url:'{{ route("admin.find.class.exam") }}',
                data:{
                    class_results_id:classid,
                    exam_results:examid
                },
                success:function(response)
                {
                    console.log(response)

                    if (response.status==405)
                    {
                        $('.results_error_list').html(" ");
                        $('.results_error_list').removeClass('d-none');
                        $.each(response.message,function(key,err_value)
                        {
                            $('.results_error_list').append('<li>' + err_value + '</li>');
                        })
                    } 
                    else if (response.status==200)
                    {

                        console.log(response.pupildetails['pupil_name']);
                        $('#addresultstbody').empty()

                        swal.fire({
                            title: response.message,
                            showClass: {
                                popup: 'animate__fadeOutDown'
                            },
                            hideClass: {
                                popup: 'animate__fadeOutUpBig'
                            },
                            timer:3000
                        });

                        for (let i = 0; i < response.pupildetails.length; i++) {
                            $('#addresultstbody').append(
                            '<tr id="row' + response.pupildetails[i].id + '"><td data-label="Pupil Name">' + response.pupildetails[i].pupil_name + '</td><td class="d-none"><form method="POST" id="results-form' + response.pupildetails[i].id + '" action="javascript:void(0);" class="add-new-exam-results-form">@csrf</form><input name="term" id="term' + response.pupildetails[i].id + '" value="' + response.examnme[0].term + '" form="results-form' + response.pupildetails[i].id + '"/><input name="pupil_id" id="pupilresults' + response.pupildetails[i].id + '" value="' + response.pupildetails[i].id + '" form="results-form' + response.pupildetails[i].id + '"/><input name="exam_id" id="classexamresultsid' + response.pupildetails[i].id + '" value="' + response.examnme[0].id + '" form="results-form' + response.pupildetails[i].id + '"/><input name="class_id" id="classresultsid' + response.pupildetails[i].id + '" value="' + response.pupildetails[i].grade_id + '" form="results-form' + response.pupildetails[i].id + '"/></td><td data-label="Exam Name">' + response.examnme[0].exam_name + '</td><td data-label="Maths"><input form="results-form' + response.pupildetails[i].id + '" class="form-control text-white bg-dark rounded" id="maths' + response.pupildetails[i].id + '" name="maths" placeholder="maths results"></td><td data-label="English"><input form="results-form' + response.pupildetails[i].id + '" class="form-control text-white bg-dark rounded" id="eng' + response.pupildetails[i].id + '" name="eng" placeholder="english results"></td><td data-label="Kiswa"><input form="results-form' + response.pupildetails[i].id + '" class="form-control text-white bg-dark rounded" id="kiswa' + response.pupildetails[i].id + '" name="kiswa" placeholder="kiswahili results"></td><td data-label="Home Sci"><input form="results-form' + response.pupildetails[i].id + '" class="form-control text-white bg-dark rounded" id="home_sci' + response.pupildetails[i].id + '" name="home_sci" placeholder="Home sci results"></td><td data-label="Science"><input form="results-form' + response.pupildetails[i].id + '" class="form-control text-white bg-dark rounded" id="sci' + response.pupildetails[i].id + '" name="science" placeholder="Science results"></td><td data-label="CRE"><input form="results-form' + response.pupildetails[i].id + '" class="form-control text-white bg-dark rounded" id="cre' + response.pupildetails[i].id + '" name="cre" placeholder="CRE results"></td><td data-label="Social Studies"><input form="results-form' + response.pupildetails[i].id + '" class="form-control text-white bg-dark rounded" id="social_stud' + response.pupildetails[i].id + '" name="social_stud" placeholder="social s results"></td><td data-label="Action"><button type="submit" form="results-form' + response.pupildetails[i].id + '" form-id=' + response.pupildetails[i].id + ' onclick="storepupilresults(this)" class="btn btn-success" style="text-align:center;" title="Save Results"><i class="fas fa-save" style="color: #ffffff; font-size:20px;"></i></button></td></tr>')    
                        }
                    }
                    else if (response.status==400)
                    {
                        console.log(response);

                        $('#addresultstbody').empty()

                        swal.fire({
                            title: response.message,
                            showClass: {
                                popup: 'animate__fadeOutDown'
                            },
                            hideClass: {
                                popup: 'animate__fadeOutUpBig'
                            },
                            timer:3000
                        });

                        for (let i = 0; i < response.pupilsToAddResults.length; i++) {
                            $('#addresultstbody').append(
                            '<tr><td data-label="Pupil Name">' + response.pupilsToAddResults[i].pupil_name + '</td><td class="d-none"><form method="POST" id="results-form' + response.pupilsToAddResults[i].id + '" action="javascript:void(0);" class="add-new-exam-results-form">@csrf</form><input name="term" id="pupilresults' + response.pupildetails[i].id + '" value="' + response.examnme[0].term + '" form="results-form' + response.pupildetails[i].id + '"/><input name="pupil_id" id="pupilresults' + response.pupilsToAddResults[i].id + '" value="' + response.pupilsToAddResults[i].id + '" form="results-form' + response.pupilsToAddResults[i].id + '"/><input name="exam_id" id="classexamresultsid' + response.pupilsToAddResults[i].id + '" value="' + response.examnme[0].id + '" form="results-form' + response.pupilsToAddResults[i].id + '"/><input name="class_id" id="classresultsid' + response.pupilsToAddResults[i].id + '" value="' + response.pupilsToAddResults[i].grade_id + '" form="results-form' + response.pupilsToAddResults[i].id + '"/></td><td data-label="Exam Name">' + response.examnme[0].exam_name + '</td><td data-label="Maths"><input form="results-form' + response.pupilsToAddResults[i].id + '" class="form-control text-white bg-dark rounded" id="maths' + response.pupilsToAddResults[i].id + '" name="maths" placeholder="maths results"></td><td data-label="English"><input form="results-form' + response.pupilsToAddResults[i].id + '" class="form-control text-white bg-dark rounded" id="eng' + response.pupilsToAddResults[i].id + '" name="eng" placeholder="english results"></td><td data-label="Kiswa"><input form="results-form' + response.pupilsToAddResults[i].id + '" class="form-control text-white bg-dark rounded" id="kiswa' + response.pupilsToAddResults[i].id + '" name="kiswa" placeholder="kiswahili results"></td><td data-label="Home Sci"><input form="results-form' + response.pupilsToAddResults[i].id + '" class="form-control text-white bg-dark rounded" id="home_sci' + response.pupilsToAddResults[i].id + '" name="home_sci" placeholder="Home sci results"></td><td data-label="Science"><input form="results-form' + response.pupilsToAddResults[i].id + '" class="form-control text-white bg-dark rounded" id="sci' + response.pupilsToAddResults[i].id + '" name="science" placeholder="Science results"></td><td data-label="CRE"><input form="results-form' + response.pupilsToAddResults[i].id + '" class="form-control text-white bg-dark rounded" id="cre' + response.pupilsToAddResults[i].id + '" name="cre" placeholder="CRE results"></td><td data-label="Social Studies"><input form="results-form' + response.pupilsToAddResults[i].id + '" class="form-control text-white bg-dark rounded" id="social_stud' + response.pupilsToAddResults[i].id + '" name="social_stud" placeholder="social s results"></td><td data-label="Action"><button type="submit" form="results-form' + response.pupilsToAddResults[i].id + '" form-id=' + response.pupilsToAddResults[i].id + ' onclick="storepupilresults(this)" class="btn btn-success" style="text-align:center;" title="Save Results"><i class="fas fa-save" style="color: #ffffff; font-size:20px;"></i></button></td></tr>')    
                        }
                    }
                    else if (response.status==420)
                    {
                        swal.fire({
                            title: response.message,
                            showClass: {
                                popup: 'animate__fadeOutDown'
                            },
                            hideClass: {
                                popup: 'animate__fadeOutUpBig'
                            },
                            timer:3000
                        });
                    }
                }
            })
        });

        function storepupilresults(btn){
            var id = $(btn).attr('form-id');

            var url = '{{ route("admin.store.results") }}';

            $('.error_list').html(" ");
            var form = $('#results-form'+ id +'')[0];
            var formdata=new FormData(form);
            $.ajax({
                url:url,
                method:'POST',
                processData:false,
                contentType:false,
                data:formdata,
                success:function(response)
                {
                console.log(response);
                if (response.status==405)
                {
                    $('.error_list').html(" ");
                    $('.error_list').removeClass('d-none');
                    $.each(response.message,function(key,err_value)
                    {
                        $('.error_list').append('<li>' + err_value + '</li>');
                    })
                } 
                else if (response.status==200)
                {
                    console.log(response.pupilid);
                    $('.maths' + response.pupilid + '').val('');
                    $('.eng' + response.pupilid + '').val('');
                    $('.home_sci' + response.pupilid + '').val('');
                    $('.social_stud' + response.pupilid + '').val('');
                    $('.cre' + response.pupilid + '').val('');
                    $('.sci' + response.pupilid + '').val('');
                    $('.kiswa' + response.pupilid + '').val('');

                    swal.fire({
                        title: response.message,
                        showClass: {
                            popup: 'animate__fadeOutDown'
                        },
                        hideClass: {
                            popup: 'animate__fadeOutUpBig'
                        },
                        timer:3000
                    });
        
                }
                else if (response.status==400)
                {
                    swal.fire({
                        title: response.message,
                        showClass: {
                            popup: 'animate__fadeOutDown'
                        },
                        hideClass: {
                            popup: 'animate__fadeOutUpBig'
                        },
                        timer:3000
                    });
                }
                }
            });

        }

    </script>
@stop