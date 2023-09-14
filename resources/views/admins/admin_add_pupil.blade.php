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
                                            <input type="text" class="form-control text-white bg-dark" required name="pupil_name" placeholder="Write The pupil official Name">
                                        </div>
                
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Registration number<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark" required name="pupil_reg_number" placeholder="Write The Pupil Regstration Number">
                                        </div>
                                    </div>

                                    <div class="row section-groups">
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Year Joined<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark" required name="year_joined" placeholder="Write a slug for the Rental House Name">
                                        </div>
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Grade(class)<span class="text-danger inputrequired">*</span></label><br>
                                            <select name="grad_id" class="adminselect2 form-control text-white bg-dark" style="width: 100%;" required>
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
                                            <label>Pupil Guardian Name<span class="text-danger inputrequired">*</span></label>
                                            <input type="text" class="form-control text-white bg-dark" required name="pupil_guardian_name" placeholder="Write The pupil Guardian Name">
                                        </div>
                
                                        <div class="form-group inputdetails col-sm-6">
                                            <label>Pupil Guardian Phone Number<span class="text-danger inputrequired">*</span></label>
                                            <input type="number" class="form-control text-white bg-dark" required name="pupil_guardian_phone" placeholder="Write The pupil Guardian Phone Number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <ul class="alert alert-warning d-none" id="error_list"></ul>
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

        $(function() {
            $('#event_date_picker').datepicker({
                dateFormat: 'dd.mm.yy',
                minDate: 0,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                rtl: true,
                orientation: "auto",
                changeMonth: true,
                changeYear: true,
            });
            
            $('.date-icon').on('click', function() {
                $('#event_date_picker').focus();
            })
        });


        $(document).on('submit','#add-new-pupil-form',function()
        {
            var url = '{{ route("admin.store.pupil") }}';

            console.log(url);

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
                if (response.status==400)
                {
                    $('#error_list').html(" ");
                    $('#error_list').removeClass('d-none');
                    $.each(response.message,function(key,err_value)
                    {
                        $('#error_list').append('<li>' + err_value + '</li>');
                    })
                } 
                else if (response.status==200)
                {
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(response.message);
                    inactiverentalhousestable.ajax.reload();
                    $('#rentalhouseid').val('');
                    $('.edit_title').html('');
                    $('#rental_title').val('');
                    $('#rental_slug').val('');
                    $('#monthly_rent').val('');

                    $("#rental_details_ck").children("textarea").remove();
                    $('.hsedetailstextarea').val('');

                    $('#totalrooms').val('');
                    $('#rental_address').val('');
                    
                    $('.rentalhsevideo').val('');

                    $(".rentalselectcat").val('');

                    $(".rentalhsevacancy").val('');

                    $(".rentalhselocation").val('');

                    //pass array object value to select2
                    $('.rentaltagselect2').val('');

                    // preview an image that was previously uploaded
                    var deleteimage=$('#showimage').removeAttr('src');
                    $('.rentalhseimage').html('deleteimage');

                    // $('.editcheckbox').prop('checked', false);

                    $('input[name^="edit_is_featured"]').prop('checked', false);

                    $('input[name^="edit_wifi"]').prop('checked', false);

                    $('input[name^="edit_generator"]').prop('checked', false);

                    $('input[name^="edit_balcony"]').prop('checked', false);

                    $('input[name^="edit_parking"]').prop('checked', false);

                    $('input[name^="edit_cctv_cameras"]').prop('checked', false);

                    $('input[name^="edit_servant_quarters"]').prop('checked', false);
                    $('#editrentalhsedetailsmodal').modal('hide');
                }
                }
            });
        });

    </script>
@stop