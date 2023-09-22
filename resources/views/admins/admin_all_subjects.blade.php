@extends('admins.admin_layout')
@section('title','Subject Management')
@section('content')
@section('adminallsubjectsspagestyles')
    <style>
        .subjectgrade {width: 100%;
            background-color: #1d1c22;border: 1px solid #aaa;
    border-radius: 8px;cursor: default;margin-right: 5px;margin-top: 5px;padding: 0 5px;
        }
    </style>
@stop

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Subjects we teach</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Subjects</li>
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
                        <a class="btn btn-dark" href="{{ route('admin.create.pupil.page') }}">Create a new Subject</a>
                    </div>
                </div>
                <div class="row">    
                    <div class="col-lg-12 col-md-10 mx-auto">
                        <div class="panel-heading mt-5" style="text-align: center; font-size:18px;"> 
                            <h3 class="mb-2 panel-title">All Subjects</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                               <table id="allsubjectstable" class="table table-striped table-bordered" style="width:100%; margin-top:50px;">
                                  <thead>
                                    <tr>              
                                      <td>id</td>
                                      <td>Subject Name</td>
                                      <td>Subject Teacher</td>
                                      <td>Grades</td>
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

@section('adminallsubjectsscript')
    <script>
        // show activated houses of the house in a datatable
      var allteacherstable = $('#allsubjectstable').DataTable({
         processing:true,
         serverside:true,
         responsive:true,

         ajax:"{{ route('admin.get_all_subjects') }}",
         columns: [    
            { data: 'id' },
            { data: 'subject_name' },
            { data: 'subject_teacher_id', name:'subject_teacher_id.subjectteachers', orderable:true,searchable:true},
            { data:
                function (row) {
                let classes= [];
                    $(row.subjectgrades).each(function (i, e)
                    {
                        classes.push(e.grade_name,);
                    });
                    return '<input readonly=" " class="subjectgrade bg-dark text-white" style="" value="' + classes + '" data-id="' + row.id + '">';
                }, name: 'subjectgrades.grade_name'
            },
            { data: 'action',name:'action',orderable:false,searchable:false },
         ],
      });

        // show form for assigning the teacher a class
        $(document).on('click','.assigngrade',function(e){
            e.preventDefault();

            var user_id=$(this).val();

            var url = '{{ route("admin.get_teacher_class", ":id") }}';
                    url = url.replace(':id', user_id);
            $('#assignteachermodal').modal('show');

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
                        $('#assignteachermodal').modal('hide');
                    } 
                    else
                    {
                        $('#edit_name').val(response.teacherdata.name);
                        $('#teachergrade_id').val(response.teacherdata.id);

                        $('#gradeid').val(response.teacherdata.classes.id);
                        $('#gradeid').select2();
                        
                                    
                    }
                }
            })
        })

          // Update role for an admin
          $(document).on('submit','#assignteacheragrade',function(e){
              e.preventDefault();

              var teacherid=$('#teachergrade_id').val();
              var url = '{{ route("admin.assign-class", ":id") }}';
                    url = url.replace(':id', teacherid);
              var gradename = $('#gradeid').val();
              
              $.ajax({
                type:"POST",
                url:url,
                data:$("#assignteacheragrade").serialize(),
                success:function(response)
                {
                    console.log(response);
                    if (response.status==404)
                    {
                        alert(response.message);

                    } 
                    else if (response.status==200)
                    {
                        $('#assignteachermodal').modal('hide');
                        allteacherstable.ajax.reload();
                        $('#edit_name').val('');
                        $('#gradeid').val('');
                        $('#teachergrade_id').val('');

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
          })
    </script>
@stop