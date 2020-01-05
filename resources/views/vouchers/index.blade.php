@extends('layouts.master') 

@section('title', 'Test') 

@section('header_scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#vouchers').DataTable();
    } );
</script>
@stop

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">Voucher
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-success" href="{{ route('vouchers.create') }}"> Create Voucher</a>
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
                            <table id="vouchers" class="align-middle mb-0 table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Influencer Code</th>
                                        <th>Product Name</th>
                                        <th>Discount</th>
                                        @if(auth()->user()->can('voucher-edit') || auth()->user()->can('voucher-delete'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vouchers as $index => $test)
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
                                        <td>{{ $test->start_date }}</td>
                                        <td>{{ $test->end_date }}</td>
                                        <td>{{ $test->influencer_code }}</td>
                                        <td>{{ $test->product->name }}</td>
                                        <td>{{ $test->discount_percentage . '%' }}</td>
                                        @if(auth()->user()->can('voucher-edit') || auth()->user()->can('voucher-delete'))
                                        <td>
                                            @can('voucher-edit')
                                            <a class="btn btn-primary" href="{{ route('vouchers.edit', $test->id) }}">Edit</a>
                                            @endcan
                                            @can('voucher-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['vouchers.destroy', $test->id],'style'=>'display:inline']) !!}
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