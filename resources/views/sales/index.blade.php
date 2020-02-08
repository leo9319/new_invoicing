@extends('layouts.master') 

@section('title', 'Invoices') 

@section('header_scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#sales').DataTable();
 
        $('#sales tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        });
 
        $('#button').click( function () {
            if(table.rows('.selected').data().length > 0) {
                var rows = table.rows('.selected').data();
                var saleIds = [];

                for (i = 0; i < rows.length; i++) {
                    
                    saleIds.push(rows[i][0]);
                }

                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('update-handling-status')!!}',
                    data: {'sale_ids': saleIds},
                    success:function(data){
                        location.reload();
                    },
                    error:function(){
                        console.log('failure');
                    }
                });

            } else {
                console.log('does not exist');
            }
        });

        $('#delivery-submit').click( function () {

            if(table.rows('.selected').data().length > 0) {
                var rows = table.rows('.selected').data();
                var saleIds = [];

                for (i = 0; i < rows.length; i++) {
                    
                    saleIds.push(rows[i][0]);
                }

                var status = document.getElementById('delivery-status');
                var strUser = status.options[status.selectedIndex].value;

                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('update-delivery-status')!!}',
                    data: {
                        'sale_ids': saleIds,
                        'status': strUser,
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(){
                        console.log('failure');
                    }
                });

            } else {
                console.log('does not exist');
            }

            


        });
} );
</script>
@stop

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">Invoices
                    <div class="btn-actions-pane-right">
                        @can('sale-create')
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-success" href="{{ route('sales.create') }}"> Create Invoice</a>
                            <span class="p-1">|</span>
                            <button id="button" class="btn btn-alternate" href="#"> Handed Over</button>
                            <span class="p-1">|</span>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Delivered</button>
                        </div>
                        @endcan
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
                            <table id="sales" class="align-middle mb-0 table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="d-none"></th>
                                        <th>Invoice ID</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Handed Over?</th>
                                        <th>Delivered?</th>
                                        @if(auth()->user()->can('sale-edit') || auth()->user()->can('sale-delete')|| auth()->user()->can('sale-view'))
                                        <th>Actions</th>
                                        @endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $index => $sale)
                                    <tr>
                                        <td class="d-none">{{ $sale->id }}</td>
                                        <td class="text-muted">
                                            <a href="{{ route('sales.view_invoice', $sale->id) }}">{{ 'IN' . sprintf('%06d', ($sale->id)) }}</a>
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($sale->date)->format('d M y') }}</td>
                                        <td>{{ $sale->client_name }}</td>
                                        <td>{{ $sale->client_address }}</td>
                                        <td>{{ $sale->client_phone }}</td>
                                        <td>{{ ucfirst($sale->handed_over) }}</td>
                                        <td>{{ ucfirst($sale->delivered ?? 'N/A') }}</td>
                                        @if(auth()->user()->can('sale-edit') || auth()->user()->can('sale-delete')|| auth()->user()->can('sale-view'))
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('sales.show', $sale->id) }}">View</a>
                                            @can('sale-edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('sales.edit', $sale->id) }}">Edit</a>
                                            @endcan
                                            @can('sale-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['sales.destroy', $sale->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                        @endif
                                        <td>
                                            @if($sale->delivered == 'cancelled')
                                            <a class="btn btn-warning btn-sm" href="{{ route('sales.returned_products', $sale->id) }}">Returned Products</a>
                                            @else
                                            @endif
                                        </td>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delivery Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Orders delivered?</label>
                            <select class="form-control" id="delivery-status">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="delivery-submit" type="button" class="btn btn-primary">Update changes</button>
            </div>
        </div>
    </div>
</div>

@section('footer_scripts')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

@endsection