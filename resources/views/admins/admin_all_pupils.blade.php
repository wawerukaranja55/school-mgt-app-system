@extends('admins.admin_layout')
@section('title','Pupils Management')
@section('content')

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">All Pupils in the school</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All pupils</li>
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
                        <a class="btn btn-dark" href="{{ route('admin.create.pupil.page') }}">Create a new pupil record</a>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-lg-12 col-md-10 mx-auto">
                        <div class="panel-heading mt-5" style="text-align: center; font-size:18px;"> 
                            <h3 class="mb-2 panel-title">All Pupils</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <ul class="alert alert-warning d-none error_list"></ul>
                               <table id="allpupilstable" class="table table-striped table-bordered" style="width:100%; margin-top:50px;">
                                  <thead>
                                    <tr>              
                                      <td>id</td>
                                      <td>Pupil Name</td>
                                      <td>Pupil guardian name</td>
                                      <td>Grade</td>
                                      <td>Year joined</td>
                                      <td>Pupil guardian phone</td>
                                      <td>Pupil reg number</td>
                                      <td>Action</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                            </div>
                         </div>
                    </div>
                </div> 
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->

@endsection

@section('adminallpupilsscript')
    <script>
        // show activated houses of the house in a datatable
        var allpupilstable = $('#allpupilstable').DataTable({
            processing:true,
            serverside:true,
            responsive:true,

            ajax:"{{ route('admin.get_all_pupils') }}",
            columns: [           
                { data: 'id' },
                { data: 'pupil_name' },
                { data: 'pupil_guardian_name' },
                {  data: 'grade_id', name:'grade_id.pupilgrade', orderable:true,searchable:true},
                { data: 'year_joined' },
                { data: 'pupil_guardian_phone'},
                { data: 'pupil_reg_number'},
                { data: 'action',name:'action',orderable:false,searchable:false },
            ],
        });

        //   show editing modal
        $(document).on('click','.editpupildetails',function(){

            var pupildetailsid=$(this).data('id');

            $('#editpupildetailsmodal').modal('toggle');

            $.ajax({
            url:'{{ url("admin/get_pupil_details",'') }}' + '/' + pupildetailsid + '/edit',
            method:'GET',
            processData: false,
            contentType: false,
            success:function(response)
            {
                console.log(response)
                if (response.status==404)
                {
                    alert(response.message);
                } 
                else if(response.status==200)
                {
                    $('#edit-pupil-id').val(response.editpupildetails.id);
                    $('#edit_pupil_name').val(response.editpupildetails.pupil_name);
                    $('#edit_reg_number').val(response.editpupildetails.pupil_reg_number);
                    $('#edit_phone_number').val(response.editpupildetails.pupil_guardian_phone);
                    $('#edit_pupil_parent').val(response.editpupildetails.pupil_guardian_name);
                    $('#edit_year_joined').val(response.editpupildetails.year_joined);
                    $('#edit_pupil_class').val(response.editpupildetails.grade_id);
                }
            }
            })
        });

        $(document).on('submit','#editpupildetailsform',function()
        {
            var url = '{{ route("admin.store.pupil") }}';

            console.log(url);

            $('.error_list').html(" ");
            var form = $('#editpupildetailsform')[0];
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
                    $('#edit_pupil_id').val('');
                    $('#edit_pupil_name').val('');
                    $('#edit_reg_number').val('');
                    $('#edit_phone_number').val('');
                    $('#edit_pupil_parent').val('');
                    $('#edit_year_joined').val('');
                    $('#edit_pupil_class').val('');

                    $('#editpupildetailsmodal').modal('hide');

                    allpupilstable.ajax.reload( null, false );

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