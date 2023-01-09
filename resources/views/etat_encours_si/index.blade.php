@section('title', 'Encours Global S.I')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">État Encours Global S.I </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">État Encours Global S.I</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-4 col-xl-8">
                                            <h4 class="text-success mb-2"> Total = {{number_format(($credits->sum('montant') - $total->sum('recouvrement_jrs')), 0, ',', ' ')}} CFA </h4>
                                            
                                        </div>
                                    </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Marché</th>
                                            <th>Capital encours</th>
                                            <th>Capital recouvré</th>
                                            <th>Solde</th>
                                            <th>Délai</th>
                                            <th>Jours de retard</th>
                                            <th>Statut de payement</th>
                                            @if(auth()->user()->role_id == 1)
                                            <th>Agent</th>
                                            @endif

                                        </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td>{{$item->Client['nom_prenom']}}</td>
                                                    <td>{{$item->Marche['libelle']}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->totalRecouv(), 0, ',', ' ')}} CFA</td>
                                                    @if(($item->solde($item->montant)) < 0)
                                                    <td class="text-danger">{{number_format(($item->solde($item->montant)), 0, ',', ' ')}} CFA (Erreur)</td>
                                                    @elseif(($item->solde($item->montant)) == 0)
                                                    <td class="text-success">{{number_format(($item->solde($item->montant)), 0, ',', ' ')}} CFA -- Terminé</td>
                                                    @else
                                                    <td >{{number_format(($item->solde($item->montant)), 0, ',', ' ')}} CFA</td>
                                                    @endif
                                                    
                                                    @if ((\Carbon\Carbon::now() < $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0))
                                                        <td class="text-success font-size-15">Dans {{\Carbon\Carbon::now()->diffInDays($item->date_fin)}} jrs</td>
                                                    @elseif(\Carbon\Carbon::now()->diffInDays($item->date_fin) == 0)
                                                        <td class="text-primary font-size-15">Aujourd'hui </td>
                                                    @else
                                                        <td class="text-danger font-size-15">Expiré </td>
                                                    @endif

                                                    @if ((\Carbon\Carbon::now() > $item->date_fin) && (\Carbon\Carbon::now()->diffInDays($item->date_fin) != 0) && ($item->solde($item->montant)) != 0)
                                                     <td class="text-danger font-size-15"> {{\Carbon\Carbon::createMidnightDate($item->date_fin)->diffInDays(\Carbon\Carbon::now())}} jrs</td>
                                                    @elseif(\Carbon\Carbon::now()->diffInDays($item->date_fin) == 0)
                                                     <td class="text-primary font-size-15">Aujourd'hui </td>
                                                    @else
                                                     <td class="text-success font-size-15">Pas de retard </td>
                                                    @endif


                                                    @if (($item->solde($item->montant)) == 0 || ($item->solde($item->montant)) < 0)
                                                    <td>
                                                        <div class="badge badge-soft-success font-size-12">Soldé</div>
                                                        </td>  
                                                    @else
                                                        <td>
                                                            <div class="badge badge-soft-warning font-size-12">Encours</div>
                                                        </td>
                                                    @endif
                                                    @if(auth()->user()->role_id == 1)
                                                        <td>{{$item->User['nom']}}</td>
                                                    @endif
                                                </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection
