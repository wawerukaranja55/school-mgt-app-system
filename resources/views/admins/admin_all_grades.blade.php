@extends('admins.admin_layout')
@section('title','All Grades')
@section('content')

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">All Grades/Classes in the school</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Grades</li>
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
                            <h3 class="mb-2 panel-title">All Grades</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                               <table id="allgradestable" class="table table-striped table-bordered" style="width:100%; margin-top:50px;">
                                  <thead>
                                    <tr>              
                                      <td>id</td>
                                      <td>Grade Name</td>
                                      <td>Grade Level</td>
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

@section('adminallgradesscript')
    <script>
        // show activated houses of the house in a datatable
      var allteacherstable = $('#allgradestable').DataTable({
         processing:true,
         serverside:true,
         responsive:true,

         ajax:"{{ route('admin.get_all_classes') }}",
         columns: [    
            { data: 'id' },
            { data: 'grade_name' },
            { data: 'grade_level' },
         ],
      });
    </script>
@stop