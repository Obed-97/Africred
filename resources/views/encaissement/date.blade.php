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
                                <h4 class="mb-0 text-success">Le &nbsp; {{(new DateTime($date))->format('d-M-Y')}}  </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Encaissement</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-4" >
                        <div class="col-xl-4" id="web">
                           <form  method="POST" action="{{route('etat_encaissement.date')}}" class="d-flex mb-4">
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
                           <div class="col-xl-2"><a href="{{route('etat_encaissement.index')}}" class="btn btn-success btn-block  waves-effect waves-light"> ÉTAT DU JOUR</a></div>
                       </div>
                    <!-- end page title -->
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 5)
                                            <button type="button" class="btn btn-success  waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop"><i class="  ri-arrow-down-line"></i> Encaissement</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('encaissement.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Encaissement</h5>
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
                                                            <label class="control-label">Nature</label>
                                                            <select class="form-control " name="nature" required>
                                                                    <option value="Recouvrement journalier">Recouvrement journalier</option>
                                                                    <option value="Injection capital">Injection capital</option>
                                                                    <option value="Autres">Autres</option>
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
                                                                <textarea name="observation" id="" cols="30" rows="5" class="form-control" placeholder="Donner plus de déatils sur l'encaissement"></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-success waves-effect waves-light" type="submit"><i class="  ri-arrow-down-line"></i> Encaisser</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div> 
                                    
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Nature</th>
                                            <th>Montant</th>
                                            <th>Micro-finance</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
    
    
                                        <tbody>
                                            @foreach ($encaissements as $item)
                                                <tr>
                                                    <td>{{(new DateTime($item->date))->format('d-m-Y')}}</td>
                                                    <td>{{$item->nature}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{$item->Micro_finance['libelle']}}</td>
                                                    <td class="d-flex">
                                                        <a href="{{route('encaissement.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Voir plus"><i class="mdi mdi-eye font-size-20"></i></a>
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
