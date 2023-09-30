@extends('admins.admin_layout')
@section('title','Add Pupil Details ')
@section('content')

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Pupil Details</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add pupil details</li>
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
                            <h3 class="mb-2 panel-title">Add a Pupil Details</h3>
                        </div>
                        <form method="POST" action="javascript:void(0);" id="add-new-pupil-form" class="form-horizontal" role="form" style="margin-bottom: 100px;">
                            @csrf
                            <div class="card padding-card product-card">
                                <div class="card-body">
                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Name<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark pupil-name" required name="pupil_name" placeholder="Write The pupil official Name">
                                        </div>
                
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Registration number<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark reg-number" required name="pupil_reg_number" placeholder="Write The Pupil Regstration Number">
                                        </div>
                                    </div>

                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Year Joined<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark year_joined_picker" required readonly name="year_joined" placeholder="Select the year pupil was admitted">
                                            <span class="date-icon"><i class="fa-solid fa-calendar"></i></span>
                                        </div>
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Grade(class)<span class="text-danger inputrequired">*</span></label><br>
                                            <select name="grad_id" id="grad-id" class="adminselect2 form-control text-white bg-dark" style="width: 100%;" required>
                                                <option value=" " disabled selected>Choose a Grade</option>
                                                @foreach($all_grades as $grade)
                                                    <option value="{{ $grade['id'] }}"
                                                        @if (!empty (@old('grade_id')) && $grade->id==@old('grade_id'))
                                                            selected=""    
                                                        @endif>{{ $grade->grade_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Guardian/Parent Name<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark guardian-name" required name="pupil_guardian_name" placeholder="Write The pupil Guardian Name">
                                        </div>
                
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Guardian Phone Number<span class="text-danger inputrequired">*</span></label>
                                            <input type="number" class="form-control text-white bg-dark guardian-phone" required name="pupil_guardian_phone" placeholder="Write The pupil Guardian Phone Number">
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

@section('adminaddpupilscript')
    <script>
        $(document).on('submit','#add-new-pupil-form',function()
        {
            var url = '{{ route("admin.store.pupil") }}';

            console.log(url);
            $('.error_list').html(" ");
            var form = $('#add-new-pupil-form')[0];
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
                    $('.guardian-phone').val('');
                    $('.guardian-name').val('');
                    
                    // var index = $('#grad-id').get(0).selectedIndex;
                    // $('#grad-id option:eq(' + index + ')').remove();

                    $('#year_joined_picker').val('');
                    $('.reg-number').val('');
                    $('.pupil-name').val('');

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