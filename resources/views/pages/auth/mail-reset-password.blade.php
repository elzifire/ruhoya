<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('assets/BE/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <title>template email lupa password</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Lupa Password</h4>
                    </div>
                    <div class="card-body">
                        <p>Klik link dibawah ini untuk mereset password anda</p>
                        <a href="{{ route('reset', ['token' => $token]) }}" class="btn btn-primary">Reset Password</a>
                    </div>
                    <div class="card-footer">
                        <p>Terima kasih</p>
                    </div>
                </div>
            </div>
        </div>        
    </div>    

</body>
</html>