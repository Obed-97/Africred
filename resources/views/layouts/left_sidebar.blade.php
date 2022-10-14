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
                    <a href="{{route('recouvrement.index')}}" class=" waves-effect">
                        <i class="ri-calendar-check-fill"></i>
                        <span>Recouvrement</span>
                    </a>
                </li>
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
                <li>
                    <a href="#" class=" waves-effect">
                        <i class="ri-line-chart-fill"></i>
                        <span>Tresorerie</span>
                    </a>
                </li>


                <li class="menu-title">Administration</li>

                <li>
                    <a href="{{route('personnel.index')}}" class="waves-effect">
                        <i class="ri-team-fill"></i>
                        <span>Personnel</span>
                    </a>
                
                </li>
                
                <li>
                    <a href="{{route('client.index')}}" class="waves-effect">
                        <i class="ri-team-fill"></i>
                        <span>Clientèle</span>
                    </a>
                
                </li>
                <li>
                    <a href="{{route('role.index')}}" class="waves-effect">
                        <i class="ri-computer-fill"></i>
                        <span>Poste</span>
                    </a>
                
                </li>

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->