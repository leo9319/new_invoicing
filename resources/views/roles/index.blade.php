@extends('layouts.master') 

@section('title', 'All Users') 

@section('header_scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#users').DataTable();
    } );
</script>
@stop

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Roles
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <div class="container">
                        <table id="users" class="align-middle mb-0 table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    @can('role-edit')
                                    <th>Actions</th>
                                    @endcan
                                    @can('role-delete')
                                    <th>Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $index => $role)
                                <tr>
                                    <td class="text-muted">{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <label class="badge badge-info">{{ $permission->name }}</label>
                                        @endforeach
                                    </td>
                                    @can('role-edit')
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                        </td>
                                    @endcan
                                    @can('role-delete')
                                        <td>
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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