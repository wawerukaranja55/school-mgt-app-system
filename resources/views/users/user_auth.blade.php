
@extends('users.user_layout')
@section('title','Login and Sign Up')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">Login Form</div>
                <div class="title signup">Signup Form</div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login" checked>
                    <input type="radio" name="slide" id="signup">
                    <label for="login" class="slide login">Login</label>
                    <label for="signup" class="slide signup">Signup</label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                    <form method="POST" action="javascript:void(0);" id="login-form" class="login">
                        @csrf
                        <div class="field">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required required>
                        </div>
                        <div class="field">
                            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="current-password" id="loginshowpassword"  required>
                        </div>

                        <input type="checkbox" id="logincheckpasswordform">Show Password

                        <div class="pass-link">
                            <a href="#" id="forgot-password-btn">Forget Password?</a>
                        </div>
                        <div class="field btn" id="login-submit-btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Login">
                        </div>
                        <div class="signup-link">Not Yet created account? <a href="">Signup now</a></div>
                    </form>
                                                                    
                    <form method="POST" action="javascript:void(0);" class="signup" id="sign-up-form">
                        @csrf
                        <div class="field">
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
                        </div>
                        <div class="field">
                            <input type="email" class="form-control" name="email_address" placeholder="Email Address" required>
                        </div>
                        {{-- <div class="field">
                            <input type="number" class="form-control" name="phone_number" placeholder="phone_number" required>
                        </div>
                        <span class="error text-danger d-none"></span> --}}
                        <div class="field">
                            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="current-password" id="signupshowpassword"  required>
                            
                        </div>

                        <input type="checkbox" id="signupcheckpasswordform">Show Password

                        <div class="field btn" id="signup-submit-btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Signup">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div style="background-color:rgb(238, 184, 37);">
            <img class="" src="{{ asset ('images/default.png') }}" alt="logo"
                style="width:100%; height:80vh; object-fit:contain;">
        </div>
    </div>
</div>
@endsection

@section('userauthscript')
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (()=>{
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (()=>{
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (()=>{
            signupBtn.click();
            return false;
        });

        //   show forgot password modal
        $(document).on('click','#forgot-password-btn',function()
        {
            $('#ForgotModal').modal('toggle');
        });

        // show password on clicking a checkbox in login modal
        $('#logincheckpasswordform').click(function(){
            if(document.getElementById('logincheckpasswordform').checked)
            {
                $('#loginshowpassword').get(0).type = 'text';
            } else {
                $('#loginshowpassword').get(0).type = 'password';
            }
        });

        // show password on clicking a checkbox in sign up modal
        $('#signupcheckpasswordform').click(function(){
            if(document.getElementById('signupcheckpasswordform').checked) 
            {
                $('#signupshowpassword').get(0).type = 'text';
            } else {
                $('#signupshowpassword').get(0).type = 'password';
            }
        });
        
        //submit the regster form for a user
        $("#sign-up-form").on("submit",function(e){
            e.preventDefault();
            var url = '{{ route("user.sign_up") }}';
            $('#signup-submit-btn').prop('disabled', true);

            $.ajax({
                url:url,
                type:"POST",
                data:$("#sign-up-form").serialize(),
                success:function(response){
                    console.log(response);
                    
                    if (response.status==200)
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

                        $('#signup-submit-btn').prop('disabled', false);
                        
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

                        $('#signup-submit-btn').prop('disabled', false);
                    }
                    else if (response.status==405)
                    {
                        $('.error').html(" ");
                        $('.error').removeClass('d-none');
                        $.each(response.message,function(key,err_value)
                        {
                            $('.error').append('<li>' + err_value + '</li>');
                        })

                        $('#signup-submit-btn').prop('disabled', false);
                    };
                }
                ,error: function(error)
                {
                    console.error(error)
                }
            });
        })

        //submit login form
        $("#login-form").on("submit",function(e){
            e.preventDefault();
            var url = '{{ route("user.log_in") }}';

            $('#login-submit-btn').prop('disabled', true);
            $.ajax({
                url:url,
                type:"POST",
                data:$("#login-form").serialize(),
                success:function(response){
                    console.log(response);
                    
                    if (response.status==201)
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

                        $('#login-submit-btn').prop('disabled', false);

                        var redirecturl = "{{ route('admin.dashboard') }}";
                            window.location.href = redirecturl;
                        
                    } 
                    else if (response.status==500)
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

                        $('#login-submit-btn').prop('disabled', false);
                    }
                    else if (response.status==405)
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

                        $('#login-submit-btn').prop('disabled', false);
                    }
                }
                ,error: function(error)
                {
                    console.error(error)
                }
            });
        })

        //submit forgot-password-form
        $("#forgot-password-form").on("submit",function(e){
            e.preventDefault();
            var url = '{{ route("user.forgotpassword") }}';

            $.ajax({
                url:url,
                type:"POST",
                data:$("#forgot-password-form").serialize(),
                success:function(response){
                    console.log(response);
                    
                    if (response.status==404)
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
                    else if (response.status==201)
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
                        
                        $('#ForgotModal').modal('hide');
                    }
                }
                ,error: function(error)
                {
                    console.error(error)
                }
            });
        })

    </script>
@stop