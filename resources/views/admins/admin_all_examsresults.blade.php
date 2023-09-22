@extends('admins.admin_layout')
@section('title','Exams Results Management')
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

         alert(pupilresultsid);

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
                  $('#rentalhouseid').val(response.$editpupilresults.id);
                  $('.edit_title').html('Edit details for' + response.$editpupilresults.rental_name);
                  $('#rental_title').val(response.$editpupilresults.rental_name);
                  $('#rental_slug').val(response.editrentalhsedetail.rental_slug);
                  $('#monthly_rent').val(response.editrentalhsedetail.monthly_rent);
               }
            }
         })
      });

      
    </script>
@stop