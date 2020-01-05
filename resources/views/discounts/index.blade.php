@extends('layouts.master') 

@section('title', 'Discount') 

@section('header_scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#discounts').DataTable();
    } );
</script>
@stop

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">Discounts
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-success" href="{{ route('discounts.create') }}">Add Discount</a>
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
                            <table id="discounts" class="align-middle mb-0 table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Starts</th>
                                        <th>Ends</th>
                                        <th>Name</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Percentage</th>
                                        @if(auth()->user()->can('discount-edit') || auth()->user()->can('discount-delete'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($discounts as $index => $discount)
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
                                        <td>{{ $discount->start_date }}</td>
                                        <td>{{ $discount->end_date }}</td>
                                        <td>{{ $discount->name }}</td>
                                        <td>{{ $discount->product->name }}</td>
                                        <td>{{ $discount->amount ?? 'N/A' }}</td>
                                        <td>{{ $discount->percentage ?? 'N/A' }}</td>
                                        @if(auth()->user()->can('discount-edit') || auth()->user()->can('discount-delete'))
                                        <td>
                                            @can('discount-edit')
                                            <a class="btn btn-primary" href="{{ route('discounts.edit', $discount->id) }}">Edit</a>
                                            @endcan
                                            @can('discount-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['discounts.destroy', $discount->id],'style'=>'display:inline']) !!}
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