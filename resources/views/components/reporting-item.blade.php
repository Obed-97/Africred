<div>
    <div class="row">
        <div class="col-xl-12">

            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Element du rapport</p>
                                                @foreach ($errors as $error)
                                                    <ul>
                                                        <li>{{ $error }}</li>
                                                    </ul>
                                                @endforeach
                                            <form action="{{ route('add.item.reporting') }}" method="post">
                                                @csrf
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <input type="text" placeholder="titre" name="name" class="form-control" required>
                                                </div>
                                                <div class="col-xl-6">
                                                    <select name="type" id="" class="form-control" required>
                                                        <option value="">choisir une categorie</option>
                                                        @foreach (\App\Models\ReportingItem::type() as $item)
                                                            <option value="{{ $item['type'] }}">{{ $item['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                                <button type="submit" class="btn btn-primary  waves-effect waves-light">
                                                    Ajouter
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Données</p>
                                           <form action="{{ route('data.item.reporting') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-3">
                                                    <select name="reporting_items_id" id="" class="form-control" required>
                                                        <option value="">choisir un élement</option>
                                                        @foreach ($reportingItems as $item)
                                                            <option value="{{ $item->id }}"> <strong>{{ $item->name }}</strong> / {{ $item->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3">
                                                    <input type="text" placeholder="prevision jour" name="pre" class="form-control">
                                                </div>
                                                <div class="col-xl-3">
                                                    <input type="text" placeholder="realisation jour" name="rea" class="form-control" required>
                                                </div>
                                                <div class="col-xl-3">
                                                    <input type="date" placeholder="date" name="date" class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary  waves-effect waves-light">
                                                Ajouter
                                            </button>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Elément</th>
                                            <th>Prévision</th>
                                            <th>Réalisation</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($reportingDataItems as $item)
                                            <tr>
                                                <td style = "text-transform:uppercase;">{{ $item->id }}</td>
                                                <td style = "text-transform:uppercase;">{{$item->getElementName() .' / '. $item->getElementType()}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->pre()}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->rea()}}</td>
                                                <td style = "text-transform:uppercase;">{{$item->getDate()}}</td>
                                                <td class="d-flex">
                                                    <form action="{{ route('del.item.data') }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" id="" value="{{ $item->id }}">
                                                        <button class="btn bg-transparent mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete"><i class="mdi mdi-trash-can-outline font-size-18"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
