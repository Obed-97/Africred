@if (auth()->user()->role_id == 4)
   <!-- ========== Left Sidebar Start ========== -->
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
                    <a href="{{route('depot_caisse.index')}}" class=" waves-effect">
                        <i class="ri-store-3-line"></i>
                        <span>Encaissement</span>
                    </a>
                </li>
                <li>
                    <a href="#" class=" waves-effect">
                        <i class="ri-file-list-3-fill"></i>
                        <span>Historique</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End --> 
@else
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        @if (auth()->user()->role_id == 5)
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

            </ul>
            
        </div>
        <!-- Sidebar --> 
        @else
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
                    <a href="{{route('recouvrement.index')}}" class=" waves-effect">
                        <i class="ri-calendar-check-fill"></i>
                        <span>Recouvrement</span>
                    </a>
                </li>
                {{-- @if (auth()->user()->role_id == 1)
                    <li>
                        <a href="{{route('depot_caisse.index')}}" class=" waves-effect">
                            <i class="ri-store-3-line"></i>
                            <span>Encaissement</span>
                        </a>
                    </li>
                @endif --}}
                <li>
                    <a href="{{route('historique.index')}}" class=" waves-effect">
                        <i class="ri-file-list-3-fill"></i>
                        <span>Historique</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('credit.index')}}" class=" waves-effect">
                        <i class="ri-hand-coin-fill"></i>
                        <span>Crédit</span>
                    </a>
                </li>

                @if (auth()->user()->role_id == 1)
                <li>
                    <a  href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-line-chart-fill"></i>
                        <span>Trésorerie</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('encaissement.index')}}"><i class="ri-arrow-down-fill text-success"></i> Encaissement</a></li> 
                        <li><a href="{{route('decaissement.index')}}"><i class="ri-arrow-up-fill text-danger"></i> Décaissement</a></li>
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
                        <i class="ri-team-fill"></i>
                        <span>Clientèle</span>
                    </a>
                
                </li>
                @if (auth()->user()->role_id == 1)
                <li>
                    <a href="{{route('role.index')}}" class="waves-effect">
                        <i class="ri-computer-fill"></i>
                        <span>Poste</span>
                    </a>
                
                </li>
                @endif

                

            </ul>
            
        </div>
        <!-- Sidebar --> 
        @endif
       
    </div>
</div>
<!-- Left Sidebar End -->
@endif