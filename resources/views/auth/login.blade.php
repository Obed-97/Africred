<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Bienvenue à AFRICRED</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
    
        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    
    </head>

    <body class="auth-body-bg">
       
        <div style="background-image: url('assets/images/sea-3052592_1920.jpg')">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                       
                    </div>
                    <div class="col-lg-4">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9 card">
                                        <div>
                                            <div class="text-center mt-4">
                                                <div>
                                                    <a href="{{route('login')}}" class="logo"><img src="{{asset('assets/images/Logo AfriCRED.png')}}" height="60" alt="logo"></a>
                                                </div>
    
                                                <h4 class="font-size-18 mt-4">Bienvenue à AFRICRED !</h4>
                                                <p class="text-muted">Connectez-vous pour commencer.</p>
                                            </div>
                                            @if($errors)
                                                @foreach($errors->all() as $errors)
                                                    <div class="alert alert-danger">
                                                         <li> {{$errors}}</li>
                                                    </div>
                                                @endforeach
                                            @endif
                                           

                                            <div class="p-2 mt-5">
                                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                                    @csrf
                    
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-mail-line auti-custom-input-icon"></i>
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" required  placeholder="Entrez votre email">
                                                    </div>
                            
                                                    <div class="form-group auth-form-group-custom mb-4" >
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="password">Mot de passe</label>
                                                        <input type="password" class="form-control" id="password" required autocomplete="current-password" name="password" placeholder="Enter password">
                                                    </div>
                            
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                        <label class="custom-control-label" for="customControlInline">Se souvenir</label>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Se connecter</button>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Mot de passe oublié ?</a>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="mt-5 text-center">
                                                
                                                <p><b> ©  <script>document.write(new Date().getFullYear())</script> AFRICRED. </b></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
