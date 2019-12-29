@extends('layouts.master') 

@section('title', 'Delivery Company') 

@section('header_scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#company-names').DataTable();
    } );
</script>
@stop

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">company-names
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-success" href="{{ route('company-names.create') }}"> Add Delivery Company</a>
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
                            <table id="company-names" class="align-middle mb-0 table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($company_names as $index => $company_name)
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
                                        <td>{{ $company_name->name }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('company-names.edit', $company_name->id) }}">Edit</a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['company-names.destroy', $company_name->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
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

@section('footer_scripts')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

@endsection