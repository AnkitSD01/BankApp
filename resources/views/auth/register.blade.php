<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            text-align: center;
            font-size: 25px;
            padding: 20px;
        }

        .customcontainer {
            max-width: 650px;
            margin: 0 auto;
        }

        .card-body {
            padding: 35px;
        }
        .signup{
            text-align: center;
            margin-top: 15px;
        }
        body{
            background-color: #f6f6fb;
        }
    </style>
</head>

<body>
    <div class="customcontainer">

        <div class="row justify-content-center mt-5">
            <div class="card-header">{{ config('app.name', 'Laravel') }}</div>

            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <big>Create new Account</big><br><br>

                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms_and_condition') is-invalid @enderror" type="checkbox" name="terms_and_condition" id="terms_and_condition" {{ old('terms_and_condition') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="terms_and_condition">
                                    {!! __('I agree to the <a href=":terms_link">terms and policy</a>', ['terms_link' => "#"]) !!}
                                    </label>

                                    @error('terms_and_condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message?"Please Accept Terms and Policy":"" }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>



                        <div class="row mb-0">
                            <div class="row">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="signup">Already Have A Account ? <a href="{{route('login')}}">Login</a></div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>




