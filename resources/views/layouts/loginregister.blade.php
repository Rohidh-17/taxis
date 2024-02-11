<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
        <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
        <script src="{{asset('assets/js/pace.min.js')}}"></script>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
        <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/dark-theme.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/semi-dark.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/header-colors.css')}}" />
        <title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
    </head>
<body class="" >
    <div class="wrapper" >
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{asset('assets/images/login-images/login-cover.svg')}}" class="img-fluid auth-img-cover-login" width="650" alt="" />
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="{{asset('assets/images/logo-icon.png')}}" width="60" alt="">
                                    </div>
                                    
                                        @yield('loginregister')
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('assets/plugins/notifications/js/lobibox.min.js')}}"></script>
	<script src="{{asset('assets/plugins/notifications/js/notifications.min.js')}}"></script>
	<script src="{{asset('assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
	<script src="{{asset('assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
</body>
</html>