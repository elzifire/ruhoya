<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>Login | {{env("APP_NAME")}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <script src="{{asset('BE/js/layout.js')}}"></script>
    <link href="{{asset('BE/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('BE/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('BE/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

    <body class="auth-bg 100-vh">
        <div class="bg-overlay bg-light"></div>
    
        <div class="account-pages">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100 py-0 py-xl-4">
    
                                    <div class="text-center mb-5">
                                        <a href="index.html">
                                            <span class="logo-lg">
                                                <img src="{{asset('FE/images/ruhoya-logo.png')}}" alt="" height="50">
                                            </span>
                                        </a>
                                    </div>
    
                                    <div class="card my-auto overflow-hidden">
                                        <div class="row g-0">
                                            <div class="col-lg-12">
                                                <div class="p-lg-5 p-4">
                                                    <div class="text-center">
                                                        <h5 class="mb-0">Selamat Datang!</h5>
                                                        <p class="text-muted mt-2">Masuk untuk melanjutkan</p>
                                                    </div>
                                                
                                                    <div class="mt-4">
                                                        <form onsubmit="return false;" class="auth-input" data-login-form>
                                                            {{ csrf_field() }}
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukan email">
                                                            </div>
                                    
                                                            <div class="mb-2">
                                                                <label for="password-input" class="form-label">Password</label>
                                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                                    <input type="password" name="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="las la-eye align-middle fs-18"></i></button>
                                                                </div>
                                                            </div>
                
                                                            <div class="form-check form-check-primary fs-16 py-2">
                                                                <input class="form-check-input" type="checkbox" name="remember_me" id="remember-check">
                                                                <label class="form-check-label fs-14" for="remember-check">
                                                                    Remember me
                                                                </label>
                                                            </div>
                
                                                            <div class="mt-2">
                                                                <button class="btn btn-primary w-100" type="submit" data-submit-btn>Masuk</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-5 text-center">
                                        <p class="mb-0 text-muted">
                                            {{date("Y")}} © {{env("APP_NAME")}}.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('BE/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('BE/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('BE/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('BE/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('BE/js/alert.js')}}"></script>

    <!-- password-addon init -->
    <script src="{{asset('BE/js/pages/password-addon.init.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("[data-login-form]").submit(function(e) {
                $.ajax({
                    url: "{{ url('/login') }}",
                    type: "POST",
                    data: new FormData(this),
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        toastAlert("info", "Mencoba masuk");
                        $("[data-submit-btn]").attr("disabled", true);
                    },
                    success: function(response) {
                        $("[data-submit-btn]").attr("disabled", false);
                        
                        toastAlert("success", response.message);
                        setTimeout(function() {
                            window.location.replace(response.redirect_to);
                        }, 1500);
                    },
                    error: function(reject) {
                        const { message = "Terjadi kesalahan pada server" } = reject.responseJSON;

                        $("[data-submit-btn]").attr("disabled", false);
                        toastAlert("error", message);
                    }
                })    
            })
        });
    </script>
</body>
</html>