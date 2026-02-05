<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ module_lang('Auth', 'login.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/themes/custom.css') }}">
    <style>
        @charset "UTF-8";
        *{margin:0;padding:0;outline:0!important}
        html{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
        body,html{background:#ededed;color:#000;height:100%;-webkit-font-smoothing:antialiased;margin:0;padding:0}
        body.login{font-size:1rem}
        .login .brand{width:90px;height:90px;overflow:hidden;border-radius:50%;margin:40px auto;box-shadow:0 4px 8px rgba(0,0,0,.05);position:relative;z-index:1}
        .login .brand img{width:100%}
        .login .card-wrapper{width:460px}
        .login .card{border-color:transparent;box-shadow:0 4px 8px rgba(0,0,0,.05)}
        .login .card.fat{padding:15px}
        .login .card .card-title{margin-bottom:30px}
        .login .form-control{border-width:2.3px;border:1px solid #d3d3d3}
        .login .form-group label{width:100%}
        .login .btn.btn-block{padding:12px 10px}
        .login .footer{margin:40px 0;color:#373737;text-align:center;font-weight:400}
        .login label{margin-bottom:.5rem}
        .login .card-body{padding:1.25rem!important}
        .login .btn-block{display:block;width:100%}
        .login .btn-primary{color:#fff;background-color: #535453;border-color: #404040;}
        .login .form-control:focus{color:#212529;background-color:#fff;border-color:#acd7b5;outline:0;box-shadow:0 0 0 .25rem rgb(107 141 100 / 25%)}
        .login .card-body{ box-shadow: none !important;}
        @media screen and (max-width:425px){
        .login .card-wrapper{width:90%;margin:0 auto}
        }
    </style>
</head>
<body class="login">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ asset('images/logo.webp') }}" alt="logo" onerror="this.style.display='none'">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">{{ module_lang('Auth', 'login.heading') }}</h4>
                            <form method="POST" action="{{ route('login') }}" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ module_lang('Auth', 'login.email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="off">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">{{ module_lang('Auth', 'login.password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">{{ module_lang('Auth', 'login.remember') }}</label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ module_lang('Auth', 'login.submit') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; {{ date('Y') }} {{ module_lang('Auth', 'login.copyright') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
