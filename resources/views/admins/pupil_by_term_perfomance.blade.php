@extends('admins.admin_layout')
@section('title','Pupil by Term Performance')
@section('content')

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">All Exam Results </h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Exam Results</li>
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
                    <div class="col-md-4">
                        <a class="btn btn-dark" href="{{ route('admin.results.page') }}">Exam Results</a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-dark" href="{{ route('admin.pupils.page') }}">All Pupils</a>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-lg-12 col-md-10 mx-auto">
                        <div class="panel-heading mt-5" style="text-align: center; font-size:18px;"> 
                            <h3 class="mb-2 panel-title">Mean Exam Results for Pupil by Term</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <ul class="alert alert-warning d-none error_list"></ul>
                               <table id="pupilPerfomanceByTermTable" class="table table-striped table-bordered" style="width:100%; margin-top:50px;">
                                  <thead>
                                    <tr>              
                                      <td>id</td>
                                      <td>Pupil Name</td>
                                      <td>Mean</td>
                                      <td>Term</td>
                                      <td>Year</td>
                                      <td>Graduate Next Class</td>
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
      var allpupilstable = $('#pupilPerfomanceByTermTable').DataTable({
         processing:true,
         serverside:true,
         responsive:true,

         ajax:"{{ route('admin.get_all_pupil_perfomance') }}",
         columns: [           
            {   data: 'id' },
            {   data: 'pupil_id',name:'student_id.pupilname', orderable:true,searchable:true},
            {   data: 'mean' },
            {   data: 'term' },
            {   data: 'year'},
            {   data:
                function (row) {
                    let pupilresultsgrades= [];
                    $(row.pupilresultsgrade).each(function (i, e) {
                        pupilresultsgrades.push(e.grade_name);
                    });
                    return '<input readonly=" " class="showpupilgrade bg-dark text-white" style="width:145px;" value="' + pupilresultsgrades + '" data-id="' + row.id + '"><br><button type="button" data-year="' + row.year + '" data-term="' + row.term + '" value="' + row.id + '" class="graduatenextclass">Graduate Next Class</button>';
    
                }, name: 'pupilresultsgrade.grade_name'
            },
            { data: 'action',name:'action',orderable:false,searchable:false },
         ],
      });

        $(document).on('click','.graduatenextclass',function(e){
            e.preventDefault();

            var pupilgradeid=$(this).val();

            var yearid=$(this).data('year');

            var termid=$(this).data('term');

            var url = '{{ route("admin.get_pupil_grade", ":id") }}';
                    url = url.replace(':id', pupilgradeid);
            $('#graduatenxtgrademodal').modal('show');

            $.ajax({
              type:"GET",
              url:url,
              processData: false,
              contentType: false,
              success:function(response)
              {
                console.log(response);
                if (response.status==404)
                {
                    alert(response.message);
                    $('#graduatenxtgrademodal').modal('hide');
                } 
                else
                {
                    $('#pupilyear').val(yearid);
                    $('#pupilterm').val(termid);

                    $('#graduate_pupil_name').val(response.pupil_grade.pupil_name);
                    $('#pupilclass_id').val(response.pupil_grade.id);

                    var pupilgradesobject = response.pupil_grade.pupilgrade.id;
                    $('#pupilgradeid').val(pupilgradesobject).trigger('change');
                              
                }
              }
            })
        })

        $(document).on('submit','#graduatenxtgrade',function()
        {
            var url = '{{ route("admin.graduate.pupil") }}';

            $('.error_list').html(" ");
            $('.error_list').removeClass('d-none');

            var form = $('#graduatenxtgrade')[0];
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
                    $('#graduate_pupil_name').val('');
                    $('#pupilgradeid').val('');

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

                    $('#graduatenxtgrademodal').modal('hide');


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