@extends('layouts.master') 

@section('title', 'Inventories') 

@section('header_scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#inventories').DataTable();
    } );
</script>
@stop

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">Inventory
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-success" href="{{ route('inventories.create') }}"> Add To Inventory</a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="container">
                            <table id="inventories" class="align-middle mb-0 table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>MRP</th>
                                        @if(auth()->user()->can('inventory-edit') || auth()->user()->can('inventory-delete'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inventories as $index => $inventory)
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
                                        <td>{{ $inventory->product->code }}</td>
                                        <td>{{ $inventory->product->name }}</td>
                                        <td>{{ $inventory->product->brand->name }}</td>
                                        <td>{{ $inventory->quantity }}</td>
                                        <td>{{ $inventory->mrp }}</td>
                                        @if(auth()->user()->can('inventory-edit') || auth()->user()->can('inventory-delete'))
                                        <td>
                                            @can('inventory-edit')
                                            <a class="btn btn-primary" href="{{ route('inventories.edit', $inventory->id) }}">Edit</a>
                                            @endcan
                                            @can('inventory-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['inventories.destroy', $inventory->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="d-block text-center card-footer">
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

@endsection