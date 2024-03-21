<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking App || Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .register-wrapper{
            display: flex;
            flex-direction: column;
            gap: 13px;
            justify-content: center;
            height: 100vh;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-wrapper">
            <div class="card">
                <div class="card-header">
                    <h1>Login</h1>
                </div>
            <div class="fields card-body">
                <form action="{{route('login.submit')}}" method="post">
                    @csrf
               
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                        @if($errors->any() && $errors->has('email'))
                            <label class="text-danger">{{$errors->first('email')}}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password"  required>
                        @if($errors->any() && $errors->has('password'))
                            <label class="text-danger">{{$errors->first('password')}}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <input type="submit" value="submit" class="btn btn-primary">
                </div>
                </form>
                @if(Session::has('error'))
                    <label for="" class="text-danger">{{Session::get('error')}}</label>
                @endif
            </div>
            </div>
            
            <p class="text-muted">Dont have account yet? <a class="text-primary" href="{{url('register')}}">Signup</a></p>
           
        </div>
    </div>
</body>
</html>