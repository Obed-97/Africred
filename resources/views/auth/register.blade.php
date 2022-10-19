<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Bienvenue à AFRICRED</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
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
        <div class="home-btn d-none d-sm-block">
            <a href="{{route('register')}}"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div>
        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                       
                    </div>
                    <div class="col-lg-4 ">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center ">
                                   
                                    <div class="col-lg-9 card border-secondary">
                                        <div>
                                            <div class="text-center mt-4">
                                                <div>
                                                    <a href="{{route('register')}}" class="logo mt-5"><img src="{{asset('assets/images/Logo AfriCRED.png')}}" height="60" alt="logo"></a>
                                                </div>
    
                                                <h4 class="font-size-18 mt-4">Créez votre compte</h4>
                                                <p class="text-muted">Pour accéder au tableau de bord AFRICRED.</p>
                                            </div>

                                            <div class="p-2 mt-5">
                                                <form class="form-horizontal " method="POST" action="{{ route('register') }}" >
                                                    @csrf

                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-computer-line auti-custom-input-icon"></i>
                                                        <label for="poste">Poste</label>
                                                        <div>
                                                            <select class="form-control" name="role_id" >
                                                                <option>Attribuer un poste</option>
                                                                @foreach ($roles as $item)
                                                                <i class="ri-user-3-line auti-custom-input-icon"></i>
                                                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-user-3-line auti-custom-input-icon"></i>
                                                        <label for="nom">Nom complet</label>
                                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom complet">
                                                            
                                                    </div>

                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-mail-line auti-custom-input-icon"></i>
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail">
                                                    </div>

                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class=" ri-phone-line auti-custom-input-icon"></i>
                                                        <label for="telephone">Téléphone</label>
                                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Entrez votre numéro">
                                                    </div>
                            
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="password">Mot de passe</label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe">
                                                    </div>

                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="password_confirmation">Répeter mot de passe</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe">
                                                    </div>
                            

                                                    <div class="text-center">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Créer mon compte</button>
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
