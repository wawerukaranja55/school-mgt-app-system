@extends('admins.admin_layout')
@section('title','Add a Subject with Classes')
@section('content')

@section('adminaddsubjectpagestyles')
    <style>
        .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fffefe;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #1d1c22;
            border: 1px solid #aaa;
            border-radius: 8px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
        }
    </style>
@stop


    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Subject Details</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Subject details</li>
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
                            <h3 class="mb-2 panel-title">Add a Subject Details</h3>
                        </div>
                        <form method="POST" action="javascript:void(0);" id="add-new-subject-form" class="form-horizontal" role="form" style="margin-bottom: 100px;">
                            @csrf
                            <div class="card padding-card product-card">
                                <div class="card-body">
                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Subject Name<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark subject-name" required name="subject_name" placeholder="Write The Subject official Name">
                                        </div>
                
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Subject Teacher<span class="text-danger inputrequired">*</span></label>
                                            <select name="teacher_id" id="teacher-id" class="adminselect2 form-control" style="width: 100%;" required>
                                                <option value=" " disabled selected>Choose a Teacher</option>
                                                @foreach($all_teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-12">
                                            <label>Classes for the Subject<span class="text-danger inputrequired">*</span></label>
                                            <select name="grades[]" id="grades-id" class="form-control adminselect2" required multiple style="width: 100%;" >
                                                <option value=" " disabled selected>Select Grade/s</option>
                                                @foreach($gradesarray as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <ul class="alert alert-warning d-none" id="error_subject_list"></ul>
                            <div style="display: flex;justify-content:space-around;">
                                <button type="submit" class="btn btn-success" style="width:60%;text-align:center;">SUBMIT</button>
                            </div>
                            
                        </form>
                    </div>
                </div> 
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->

@endsection

@section('adminaddpupilscript')
    <script>
        $(document).on('submit','#add-new-subject-form',function()
        {
            var url = '{{ route("admin.store.subject") }}';

            var form = $('#add-new-subject-form')[0];
            var formdata=new FormData(form);
            $('#error_subject_list').html(" ");
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
                    $('error_subject_list').removeClass('d-none');
                    $.each(response.message,function(key,err_value)
                    {
                        $('error_subject_list').append('<li>' + err_value + '</li>');
                    })
                } 
                else if (response.status==200)
                {
                    $('.subject-name').val('');
                    $('.guardian-name').val('');
                    
                    var index = $('#teacher-id').get(0).selectedIndex;
                    $('#teacher-id option:eq(' + index + ')').remove();

                    var index2 = $('#grades-id').get(0).selectedIndex;
                    $('#grades-id option:eq(' + index2 + ')').remove();
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
        });

    </script>
@stop