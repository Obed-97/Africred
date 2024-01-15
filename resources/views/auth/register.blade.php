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
        
        <div style="background-image: url('assets/images/stones-1372677_1920.jpg')">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-3 mr-5">
                       
                    </div>
                    <div class="col-lg-5">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center ">
                                   
                                    <div class="col-lg-9 card  Larger shadow">
                                        <div>
                                            <div class="text-center mt-4">
                                                <div>
                                                    <a href="{{route('register')}}" class="logo mt-5"><img src="{{asset('assets/images/Logo AfriCRED.png')}}" height="60" alt="logo"></a>
                                                </div>
    
                                                <h4 class="font-size-18 mt-4">Créez votre compte</h4>
                                                <p class="text-muted">Pour accéder au tableau de bord AFRICRED</p>
                                            </div>

                                            <div class="p-2 mt-5">
                                                <form class="form-horizontal " method="POST" action="{{ route('register') }}" >
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
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
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group auth-form-group-custom mb-4">
                                                                <i class="ri-bookmark-line auti-custom-input-icon"></i>
                                                                <label for="pays">Pays</label>
                                                                <div>
                                                                    <select class="form-control" name="pays_id" >
                                                                        <option>Attribuer un pays</option>
                                                                        @foreach ($pays as $item)
                                                                        <i class="ri-user-3-line auti-custom-input-icon"></i>
                                                                            <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                    
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
                                                    
                                                    <div class="mt-4 text-center">
                                                        
                                                        <a href="{{ route('login') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Se connecter</a>
                                                       
                                                    </div>
                                                    
                                                </form>
                                            </div>

                                            <div class="mt-5 text-center">
                                               
                                                <p><b>   <script>document.write(new Date().getFullYear())</script> © AFRICRED </b></p>
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
