<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="Dj Voskill The Muzikal Genious">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>
            @yield('title','User Login/Register Account')
        </title>

       {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}"/>

      {{-- fonawesome  --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/font-awesome_6.4.2_css_all.min.css') }}">

      {{--main css style--}}
      <link rel="stylesheet" href="{{ asset('assets/sweetalert/sweetalert2@10.10.1_dist_sweetalert2.min.css') }}"/>

      {{-- icon for our website --}}
      <link rel="icon" type="image/png" href="{{ asset('images/icon/cover.png') }}">

      {{-- css for datatables --}}
      <link rel="stylesheet" href="{{ asset('assets/datatables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('assets/datatables/FixedHeader-3.1.9/css/fixedHeader.bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('assets/datatables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('assets/datatables/Buttons-1.7.1/css/buttons.bootstrap4.min.css') }}"/>
      
      {{--sweetalert css style--}}
      <link rel="stylesheet" href="{{ asset('assets/user_main.css') }}"/>
      
      {{-- select2 --}}
      <link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}"/>

     {{-- @yield('customcssstyles') --}}
   </head>
   <body class="animate fadeIn four">
    <div class="container-fluid">

        @yield('content')

        
    </div>

    <!-- ------- FORGOT FORM ------- -->
    <div class="modal fade" id="ForgotModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <!-- Form Title -->
                        <div class="form-heading text-center">
                            <div class="title">Forgot Password?</div>
                            <p class="title-description">We'll email you a link to reset it.</p>
                        </div>

                        <form method="POST" action="javascript:void(0);" id="forgot-password-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group inputdetails">
                                        <label for="reset-email">Email Address</label>
                                        <input type="email" class="form-control text-white bg-dark" id="forgot-email" name="email" placeholder="Your E-mail Address" required>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-md btn-danger">Send Mail</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ------- FORGOT FORM ends ------- --> 

    {{-- jquery --}}
    <script src="{{ asset('assets/jquery/jquery-3.5.1.js') }}"></script>

    {{-- bootstrap --}}
    <script src="{{ asset('assets/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/popper.min.js') }}"></script>

    {{-- sweetalert --}}
    <script src="{{ asset('assets/sweetalert/sweetalert2@10.16.6_dist_sweetalert2.all.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>

    {{-- font-awesome --}}
    <script src="{{ asset('assets/fontawesome/font-awesome_6.4.2_css_all.min.js') }}"></script>

    {{-- datatables --}}
    <script type="text/javascript" src="{{ asset('assets/datatables/DataTables-1.10.25/js/jquery.dataTables.min.js')}}"></script> 
    <script type="text/javascript" src="{{ asset('assets/datatables/Responsive-2.2.9/js/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/Buttons-1.7.1/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/jszip3.1.3/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/Buttons-1.7.1/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables/Buttons-1.7.1/js/buttons.print.min.js')}}"></script>


    @yield('userauthscript')
    @section('scripts')
      <script>
         $(document).ready(function() {

            // csrf token
            // $.ajaxSetup({
            //    headers: {
            //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //    }
            // });

            // hide editing property modal if no data has been updated
            $("#ForgotModal").on('hide.bs.modal', function(){
               $('#forgot-email').val('');
            });
         });
      </script>

</body>
</html>