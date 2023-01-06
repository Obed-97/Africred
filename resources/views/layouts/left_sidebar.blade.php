<!-- Left Sidebar End --> 
@if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">
            <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" >
                <li class="menu-title">Gestion</li>

                <li >
                    <a href="/" class="waves-effect">
                        <i class="ri-dashboard-fill"></i>
                        <span >Tableau de bord</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('etat_recouvrement.index')}}" class=" waves-effect">
                        <i class="ri-calendar-check-fill"></i>
                        <span>Recouvrements</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('historique.index')}}" class=" waves-effect">
                        <i class="ri-file-list-3-fill"></i>
                        <span>Historiques</span>
                    </a>
                </li>
                <li>
                    <a  href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-wallet-fill"></i>
                        <span>Crédit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('attente.index')}}"><i class="ri-stack-fill"></i> Liste d'attente <div class="badge badge-soft-warning font-size-12">{{$attentes->count()}}</div></a></li> 
                        <li><a href="{{route('credit.index')}}"><i class="ri-hand-coin-fill"></i> Déblocages <div class="badge badge-soft-success font-size-12">{{$deblocages->count()}}</div></a></li> 
                    </ul>
                </li>
                @if (auth()->user()->role_id == 2)
                <li>
                    <a href="{{route('journalier.index')}}" class=" waves-effect">
                        <i class="ri-funds-box-fill"></i>
                        <span>Dûs Journaliers </span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role_id == 1)
                <li>
                    <a  href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-line-chart-fill"></i>
                        <span>Trésorerie</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('journalier.index')}}"><i class="ri-funds-box-fill"></i> Dûs Journaliers</a></li> 
                        <li><a href="{{route('encaissement.index')}}"><i class="ri-arrow-down-fill text-success"></i> Encaissement</a></li> 
                        <li><a href="{{route('decaissement.index')}}"><i class="ri-arrow-up-fill text-danger"></i> Décaissement</a></li>
                        <li><a href="{{route('banque.index')}}"><i class="ri-bank-fill "></i> Banque</a></li>
                    </ul>
                </li>
                @endif
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-store-2-fill"></i>
                        <span>Autres</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('etat_encours_global.index')}}"><i class="ri-pushpin-fill"></i> Encours Global SI</a></li> 
                    
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('etat_actualise.index')}}"><i class="ri-pushpin-fill"></i> Encours Global</a></li> 
                    
                    </ul>
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('depot.index')}}"><i class="ri-database-2-fill "></i> Liste des dépôts</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('historique_depot.index')}}"><i class="ri-file-list-3-fill"></i> Historique dépôts</a></li>
                    </ul>
                </li>
                

                <li class="menu-title">Administration</li>
                @if (auth()->user()->role_id == 1)
                    <li>
                        <a href="{{route('personnel.index')}}" class="waves-effect">
                            <i class="ri-team-fill"></i>
                            <span>Personnel</span>
                        </a>
                    
                    </li> 
                @endif
               
                
                <li>
                    <a href="{{route('client.index')}}" class="waves-effect">
                        <i class="ri-bank-card-fill"></i>
                        <span>Comptes <div class="badge badge-soft-success font-size-12">{{$comptes->count()}}</div></span>
                    </a>
                
                </li> 
                @if (auth()->user()->role_id == 1)
                <li>
                    <a href="{{route('role.index')}}" class="waves-effect">
                        <i class="ri-computer-fill"></i>
                        <span>Postes</span>
                    </a>
                
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar --> 
    </div>
</div>

@endif

@if (auth()->user()->role_id == 5)
<div class="vertical-menu">
    <div data-simplebar class="h-100">
                <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Gestion</li>

                <li>
                    <a href="/index.php" class="waves-effect">
                        <i class="ri-dashboard-fill"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('encaissement.index')}}">
                        <i class="ri-arrow-down-fill text-success"></i> 
                        <span>Encaissement</span> 
                    </a>
                </li> 
                <li>
                    <a href="{{route('decaissement.index')}}">
                        <i class="ri-arrow-up-fill text-danger"></i>
                         Décaissement
                    </a>
                </li>
                <li><a href="{{route('banque.index')}}"><i class="ri-bank-fill text-primary"></i> Banque</a></li>

            </ul>
            
        </div>
    </div>
</div>

@endif

@if (auth()->user()->role_id == 6)
<div class="vertical-menu">
    <div data-simplebar class="h-100">
                <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Gestion</li>

                <li>
                    <a href="/" class="waves-effect">
                        <i class="ri-dashboard-fill"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('controle.index')}}">
                        <i class="ri-calendar-check-fill"></i> 
                        <span>Recouvrement</span> 
                    </a>
                </li> 
                <li>
                    <a href="{{route('journalier.index')}}" class=" waves-effect">
                        <i class="ri-funds-box-fill"></i>
                        <span>Dûs Journaliers </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('attente.index')}}" class=" waves-effect">
                        <i class="ri-stack-fill"></i>
                        <span>Liste d'attente <div class="badge badge-soft-warning font-size-12">{{$attentes->count()}}</div></span>
                    </a>
                </li>
        
            </ul>
            
        </div>
    </div>
</div>

@endif
