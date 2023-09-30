@extends('admins.admin_layout')
@section('title','Pupil Perfomance Management')
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
                    <div class="col-md-12">
                        <a class="btn btn-dark" href="{{ route('admin.create.pupil.page') }}">Create a new pupil record</a>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-lg-12 col-md-10 mx-auto">
                        <div class="panel-heading mt-5" style="text-align: center; font-size:18px;"> 
                            <h3 class="mb-2 panel-title">All Exam Results</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                               <table id="allexamresultstable" class="table table-striped table-bordered" style="width:100%; margin-top:50px;">
                                  <thead>
                                    <tr>              
                                      <td>id</td>
                                      <td>Pupil Name</td>
                                      <td>Exam Name</td>
                                      <td>Class</td>
                                      <td>Maths</td>
                                      <td>English</td>
                                      <td>Kiswahili</td>
                                      <td>Science</td>
                                      <td>Home Science</td>
                                      <td>CRE</td>
                                      <td>Social studies</td>
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
      var allpupilstable = $('#allexamresultstable').DataTable({
         processing:true,
         serverside:true,
         responsive:true,

         ajax:"{{ route('admin.get_all_exam_results') }}",
         columns: [           
            { data: 'id' },
            { data: 'student_id',name:'student_id.pupilname', orderable:true,searchable:true},
            { data: 'exam_id',name:'exam_id.pupilexam', orderable:true,searchable:true},
            { data: 'class_id', name:'class_id.studentgrade', orderable:true,searchable:true},
            { data: 'maths' },
            { data: 'eng'},
            { data: 'kiswa'},
            { data: 'home_sci' },
            { data: 'sci'},
            { data: 'cre'},
            { data: 'social_stud'},
            { data: 'action',name:'action',orderable:false,searchable:false },
         ],
      });

      //   show editing modal
      $(document).on('click','.editpupilresults',function(){

         var pupilresultsid=$(this).data('id');

         $('#editpupilresultsmodal').modal('toggle');

         $.ajax({
            url:'{{ url("admin/get_pupil_results",'') }}' + '/' + pupilresultsid + '/edit',
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
                    $('#edit_pupil_id').val(response.editpupilresults.student_id);
                    $('#edit_results_id').val(response.editpupilresults.id);
                    $('#edit_class_id').val(response.editpupilresults.class_id);
                    $('#edit_exam_id').val(response.editpupilresults.exam_id);
                    $('#edit_maths').val(response.editpupilresults.maths);
                    $('#edit_eng').val(response.editpupilresults.eng);
                    $('#edit_kiswa').val(response.editpupilresults.kiswa);
                    $('#edit_cre').val(response.editpupilresults.cre);
                    $('#edit_socialstud').val(response.editpupilresults.social_stud);
                    $('#edit_sci').val(response.editpupilresults.sci);
                    $('#edit_homesci').val(response.editpupilresults.home_sci);
                    $('#edit_term').val(response.termyear[0].term);
                    $('#edit_year').val(response.termyear[0].year);
               }
            }
         })
      });

      $(document).on('submit','#editpupilresultsform',function()
        {
            var url = '{{ route("admin.store.results") }}';

            console.log(url);

            $('.update_error_list').html(" ");
            var form = $('#editpupilresultsform')[0];
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
                    $('.update_error_list').html(" ");
                    $('.update_error_list').removeClass('d-none');
                    $.each(response.message,function(key,err_value)
                    {
                        $('.update_error_list').append('<li>' + err_value + '</li>');
                    })
                } 
                else if (response.status==200)
                {
                    $('#edit_results_id').val('');
                    $('#edit_class_id').val('');
                    $('#edit_exam_id').val('');
                    $('#edit_maths').val('');
                    $('#edit_eng').val('');
                    $('#edit_kiswa').val('');
                    $('#edit_cre').val('');
                    $('#edit_socialstud').val('');
                    $('#edit_sci').val('');
                    $('#edit_homesci').val('');
                    $('#edit_term').val('');
                    $('#edit_year').val('');

                    $('#editpupilresultsmodal').modal('hide');

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