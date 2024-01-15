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
       
        <div style="background-image: url('assets/images/elephants-gf31d2c8c4_1920.jpg')">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-3 mr-5">
                     
                    </div>
                    <div class="col-lg-5">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9 card">
                                        <div>
                                            <div class="text-center mt-4">
                                                <div>
                                                    <a href="{{route('login')}}" class="logo"><img src="{{asset('assets/images/Logo AfriCRED.png')}}" height="60" alt="logo"></a>
                                                </div>
    
                                                <h4 class="font-size-18 mt-4">Réinitialiser mot de passe</h4>
                                                <p class="text-muted">Réinitialisez votre mot de passe AFRICRED.</p>
                                            </div>

                                            <div class="p-2 mt-5">
                                             
                                                <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                                    @csrf

                                                    <!-- Password Reset Token -->
                                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-mail-line auti-custom-input-icon"></i>
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" :value="old('email', $request->email)" placeholder="Entrez votre email">
                                                    </div>
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="password">Mot de passe</label>
                                                        <input type="password" class="form-control" name="password" id="password"  placeholder="Nouveau mot de passe">
                                                    </div>
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="password_confirmation">Confirmer mot de passe</label>
                                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                                    </div>
                                                    

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Réinitialiser</button>
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
