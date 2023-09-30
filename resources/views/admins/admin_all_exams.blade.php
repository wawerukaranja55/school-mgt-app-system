@extends('admins.admin_layout')
@section('title','All Exams')
@section('content')

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">All Past and Recent Exams in the school</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Exams</li>
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
                    <div class="col-lg-10 col-md-10 mx-auto">
                        <div class="panel-heading mt-5" style="text-align: center; font-size:18px;"> 
                            <h3 class="mb-2 panel-title">All Exams</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <ul class="alert alert-warning d-none error_list"></ul>
                               <table id="allexamstable" class="table table-striped table-bordered" style="width:100%; margin-top:50px;">
                                  <thead>
                                    <tr>              
                                      <td>id</td>
                                      <td>Exam Name</td>
                                      <td>Term</td>
                                      <td>Year</td>
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

@section('adminallexamsscript')
    <script>
        // show activated houses of the house in a datatable
        var allexamstable = $('#allexamstable').DataTable({
            processing:true,
            serverside:true,
            responsive:true,

            ajax:"{{ route('admin.get_all_exams') }}",
            columns: [    
                { data: 'id' },
                { data: 'exam_name' },
                { data: 'term' },
                { data: 'year' },
                { data: 'action',name:'action',orderable:false,searchable:false },
            ],
        });

        $(document).on('click','.editexamdetails',function(){

            var examid=$(this).data('id');

            $('#editexamdetailsmodal').modal('toggle');

            $.ajax({
            url:'{{ url("admin/exam",'') }}' + '/' + examid + '/edit',
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
                    $('#editexamid').val(response.exam.id);
                    $('#edit_exam_name').val(response.exam.exam_name);
                    $('#edit_exam_year').val(response.exam.year);
                    $('#edit_exam_term').val(response.exam.term);
                }
            }
            })
        });

        $(document).on('submit','#editexamdetails',function()
        {
            var url = '{{ route("admin.store.exam") }}';

            console.log(url);

            $('.error_list').html(" ");
            var form = $('#editexamdetails')[0];
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
                    $('#editexamid').val('');
                    $('#edit_exam_name').val('');
                    $('#edit_exam_year').val('');
                    $('#edit_exam_term').val('');

                    $('#editexamdetailsmodal').modal('hide');

                    allexamstable.ajax.reload( null, false );

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