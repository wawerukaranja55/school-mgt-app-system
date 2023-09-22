@extends('admins.admin_layout')
@section('title','Add Pupil Details ')
@section('content')

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Exam Details</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add exam details</li>
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
                            <h3 class="mb-2 panel-title">Add an Exam</h3>
                        </div>
                        <form method="POST" action="javascript:void(0);" id="add-new-exam-form" class="form-horizontal" role="form" style="margin-bottom: 100px;">
                            @csrf
                            <div class="card padding-card product-card">
                                <div class="card-body">
                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-12">
                                            <label>Exam Name<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark exam-name" required name="exam_name" placeholder="for example, Opener Term 1 2023 Exam">
                                        </div>
                                    </div>

                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Term of the year<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark" required id="term" name="term" placeholder="e.g 1st term 2023">
                                        </div>
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Year<span class="text-danger inputrequired">*</span></label>
                                            <input type="number" class="form-control text-white bg-dark" required id="year" name="year" placeholder="Write the year">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <ul class="alert alert-warning d-none error_list"></ul>
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

@section('adminaddexamscript')
    <script>
        $(document).on('submit','#add-new-exam-form',function()
        {
            var url = '{{ route("admin.store.exam") }}';

            console.log(url);

            var form = $('#add-new-exam-form')[0];
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
                    $('.exam-name').val('');
                    $('#term').val('');
                    $('#year').val('');

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