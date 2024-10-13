<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="{{asset('assets/BE/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <title>Lupa Password</title>
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
                        <form action="{{ route('forgot.send') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary">Kirim Link Reset Password</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{asset('assets/BE/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
</body>
</html>