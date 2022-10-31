@section('title', 'Bienvenue à AFRICRED')

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
                                <h4 class="mb-0 text-success">{{(new DateTime($date1))->format('d-M-Y')}} ---> {{(new DateTime($date2))->format('d-M-Y')}} </h4>


                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Décaissement</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4" >
                        <div class="col-xl-4" id="web">
                           <form  method="POST" action="{{route('etat_decaissement.date')}}" class="d-flex mb-4">
                               @csrf
                               <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                               <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
                           </form>
                        </div>
                          <div class="col-xl-6" id="web">
                               <form  method="POST" action="{{route('etat_encaissement.store')}}" class="d-flex mb-4">
                                   @csrf
                                   <div class="col-xl-3"><input type="date" name="fdate" class="form-control"></div>
                                   <div class="col-xl-3"><input type="date" name="sdate"  class="form-control"></div>
                                   <div class="col-xl-3"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                               </form>
                           </div> 
                           <div class="col-xl-2"><a href="{{route('etat_decaissement.index')}}" class="btn btn-success btn-block  waves-effect waves-light"> ÉTAT DU JOUR</a></div>
                       </div>
                    <!-- end page title -->
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 5)
                                            <button type="button" class="btn btn-danger  waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop"><i class="  ri-arrow-up-line"></i> Décaissement</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('decaissement.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Décaissement</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                   
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Micro-finance</label>
                                                            <select class="form-control " name="micro_finance_id" required>
                                                                @foreach ($micros as $item)
                                                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date"  id="date" required >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Motif</label>
                                                            <select class="form-control " name="motif" required>
                                                                    <option value="Déblocage">Déblocage</option>
                                                                    <option value="Frais financier">Frais financier</option>
                                                                    <option value="Frais déplacement">Frais déplacement</option>
                                                                    <option value="Frais personnel">Frais personnel</option>
                                                                    <option value="Retraits clients">Retraits clients</option>
                                                                    <option value="Autres charges">Autres charges externes</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Montant</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="montant"  id="montant" required >
                                                            </div>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Observation (Facultatif)</label>
                                                            <div>
                                                                <textarea name="observation" id="" cols="30" rows="5" class="form-control" placeholder="Donner plus de détails sur le décaissement.."></textarea>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-danger waves-effect waves-light" type="submit"><i class="  ri-arrow-up-line"></i> Décaisser</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div> 
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Motif</th>
                                            <th>Montant</th>
                                            <th>Micro-finance</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($decaissements as $item)
                                                <tr>
                                                    <td>{{(new DateTime($item->date))->format('d-m-Y')}}</td>
                                                    <td>{{$item->motif}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{$item->Micro_finance['libelle']}}</td>
                                                    <td class="d-flex">
                                                        <a href="{{route('decaissement.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Voir plus"><i class="mdi mdi-eye font-size-20"></i></a>
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
            <!-- End Page-content -->


@endsection
