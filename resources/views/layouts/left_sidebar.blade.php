<!-- Left Sidebar End -->
@php
    use App\Services\Tool;
    $tool = new Tool();
@endphp
@if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 6)
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
                    <a  href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-wallet-fill"></i>
                        <span>Crédits <div class="badge badge-soft-success font-size-12">{{$tool->getNum()['deblocages']}}</div></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('attente.index')}}"><i class="ri-stack-fill"></i> Liste d'attente <div class="badge badge-soft-warning font-size-12">{{$tool->getNum()['attentes']}}</div></a></li>
                        <li><a href="{{route('credit.index')}}"><i class="ri-hand-coin-fill"></i> Crédits encours </a></li>
                        <li><a href="{{route('credit_solde.index')}}"><i class="ri-medal-fill"></i> Crédits soldés </a></li>
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
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-anchor-fill"></i>
                        <span>Encours</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('etat_encours_global.index')}}"><i class="ri-pushpin-fill"></i> Enc. Sans Intérêt</a></li>

                        <li><a href="{{route('etat_actualise.index')}}"><i class="ri-pushpin-fill"></i> Encours Global</a></li>
                        <li><a href="{{route('encours')}}"><i class="ri-pushpin-fill"></i>Encours des clients</a></li>

                    </ul>

                </li>

                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
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
                    <a href="{{route('depot.index')}}" class=" waves-effect">
                        <i class="ri-arrow-up-down-fill"></i>
                        <span>Dépôt - Retrait</span>
                    </a>
                </li>

                <li class="menu-title">Administration</li>
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                    <li>
                        <a href="{{route('personnel.index')}}" class="waves-effect">
                            <i class="ri-team-fill"></i>
                            <span>Personnel</span>
                        </a>

                    </li>
                @endif
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-bank-card-fill"></i>
                        <span>Comptes <div class="badge badge-soft-success font-size-12">{{$tool->getNum()['comptes']}}</div></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('client.index')}}"><i class="ri-team-fill"></i> Clients</a></li>

                        <li><a href="{{route('entreprise.index')}}"><i class="ri-building-fill"></i> Entreprises</a></li>

                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-fill"></i>
                        <span>Rapports <div class="badge badge-soft-success font-size-12"></div></span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('reporting.create')}}"><i class="ri-task-fill"></i>élément du rapport</a></li>
                        <li><a href="{{route('reporting.index')}}"><i class="ri-task-fill"></i>Rapport d'activité</a></li>
                    </ul>

                </li>

                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
                <li>
                    <a href="{{route('role.index')}}" class="waves-effect">
                        <i class="ri-computer-fill"></i>
                        <span>Postes</span>
                    </a>

                </li>
                @endif


                @if (auth()->user()->role_id == 1)
                <li class="menu-title">Extra</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-repeat-fill"></i>
                        <span>Transferts <div class="badge badge-soft-success font-size-12">{{$tool->getNum()['transferts']}}</div></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('transfert.index')}}"><i class="ri-stack-fill"></i> Les transactions</a></li>

                        <li><a href="{{route('taux.index')}}"><i class="ri-fingerprint-fill"></i> Les taux </a></li>

                    </ul>

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

@if (auth()->user()->role_id == 7)
<div class="vertical-menu">
    <div data-simplebar class="h-100">
                <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Gestion</li>

               <li>
                    <a href="{{route('transfert.index')}}" class="waves-effect">
                        <i class="ri-inbox-fill"></i>
                        <span>Réceptions  <div class="badge badge-soft-success font-size-12">{{$transferts->count()}}</div></span></span>
                    </a>

                </li>
                <li>
                    <a href="{{route('transfert.envois')}}" class="waves-effect">
                        <i class=" ri-send-plane-fill"></i>
                        <span>Envois</span>
                    </a>

                </li>

            </ul>

        </div>
    </div>
</div>

@endif










