<<<<<<< HEAD
=======
<!-- Begin page -->
@php
    use App\Services\Tool;
    $tool = new Tool();
@endphp
<div id="layout-wrapper" >

>>>>>>> filter
    <header id="page-topbar" >
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="/" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/favicon.png')}}" alt="" height="32">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/Logo AfriCRED.png')}}" alt="" height="50">
                        </span>
                    </a>

                    <a href="/" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/favicon.png')}}" alt="" height="32">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/Logo AfriCRED1.png')}}" alt="" height="50">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                {{-- <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Recherche ...">
                        <span class="ri-search-line"></span>
                    </div>
                </form> --}}


            </div>

            <div class="d-flex" >
                <div id="push-permission"></div>
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="ri-fullscreen-line"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-notification-3-line"></i>
                       @if($tool->getNum()['attentes']->count() == 0)

                       @else
                         <span class="noti-dot"></span>
                       @endif

                    </button>
                    @if(auth()->user()->role_id != 7 )
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('attente.index')}}" class="small"> Tout</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                           @forelse ($tool->getNum()['attentes'] as $item)
                            <a href="" class="text-reset notification-item">
                                <div class="media">
                                    <img src="/assets/images/users/{{$item->Client['image']}}"
                                        class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">{{$item->Client['nom_prenom']}}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">Demande un prêt de {{number_format($item->montant, 0, ',', ' ')}} CFA</p>
                                            <p class="mb-0 text-warning"><i class="mdi mdi-clock-outline text-warning"></i> {{$item->statut}}..</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                           @empty
                               <a href="" class="text-reset notification-item">
                                    <div class="media">

                                        <div class="media-body">

                                            <div class="font-size-12 text-muted">
                                                <p class="mb-2"><i class="mdi mdi-clock-outline text-warning"></i> Aucune notification.. </p>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                           @endforelse

                        </div>
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{route('attente.index')}}">
                                <i class="mdi mdi-arrow-right-circle mr-1"></i> Voir plus..
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="dropdown d-inline-block user-dropdown">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="/assets/images/users/{{auth()->user()->image}}"
                           >
                        <span class="d-none d-xl-inline-block ml-1">{{ auth()->user()->nom }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{route('profile.index')}}"><i class="ri-user-line align-middle mr-1"></i> Mon profile</a>
                        <div class="dropdown-divider"></div>
                                <!-- item-->
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="ri-shut-down-line align-middle mr-1 text-danger"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </header>
