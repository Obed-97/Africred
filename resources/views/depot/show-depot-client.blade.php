@section('title', 'Dépôt')

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
                        <h4 class="mb-0 text-success">{{$depots->first()->Client['nom_prenom'] ?? ''}} dépôts détails</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" id="web">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                <li class="breadcrumb-item active">{{$depots->first()->Client['nom_prenom'] ?? ''}} dépôts détails</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-4 col-xl-4">
                                    <a href="{{ route('depot.index') }}"
                                        class="btn btn-success btn-sm waves-effect waves-light mr-2"><i
                                            class=""></i> Retour</a>
                                </div>
                            </div>

                            <table id="datatable-buttons" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>N° Compte</th>
                                        <th>Nom complet</th>
                                        <th>Marché</th>
                                        <th>Téléphone</th>
                                        <th>Dépôt</th>
                                        <th>Rétrait</th>
                                        <th>Solde</th>
                                        <th>Statut</th>
                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                            <th>Opérateur</th>
                                        @endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($depots as $item)
                                    <tr>
                                        <td><img src="/assets/images/users/{{$item->Client['image']}}" alt="" class="rounded-circle avatar-sm"></td>
                                        <td>ABE-{{$item->Client['id']}}</td>
                                        <td>{{$item->Client['nom_prenom']}}</td>
                                        <td>{{$item->Client->Marche['libelle'] ?? '-'}}</td>
                                        <td>{{$item->Client['telephone']}}</td>
                                        <td>{{number_format($item->depot, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format(intval($item->depot) - intval($item->retrait), 0, ',', ' ')}} CFA</td>
                                        <td>
                                            @if ((intval($item->depot) - intval($item->retrait)) > 0)
                                                <div class="badge badge-soft-success font-size-14">Solde positif</div>
                                            @else
                                                <div class="badge badge-soft-danger font-size-14">Solde nul</div>
                                            @endif
                                        </td>
                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                            <td>{{$item->Client->User['nom']}}</td>
                                        @endif
                                        <td>
                                            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8)
                                            <form action="{{route('depot.destroy', $item->id)}}" method="POST" onsubmit="return confirmDeletion()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                            @endif
                                        </td>
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
    <script>
        function confirmDeletion() {
            return confirm('Êtes-vous sûr de vouloir supprimer ce dépôt ?');
        }
    </script>
    <!-- End Page-content -->


    @endsection
