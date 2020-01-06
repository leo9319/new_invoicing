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
                <div class="card-header mb-3">All Users
                    <div class="btn-actions-pane-right">

                        @can('user-create')
                            <div role="group" class="btn-group-sm btn-group">
                                <a class="btn btn-success" href="{{ route('users.create') }}"> Add New User</a>
                            </div>
                        @endcan

                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                      <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="table-responsive">
                    <div class="container">
                        <table id="users" class="align-middle table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    @if(auth()->user()->can('user-edit') || auth()->user()->can('user-delete')|| auth()->user()->can('user-show'))
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="text-muted">{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames())) 
                                            @foreach($user->getRoleNames() as $role)
                                                <label class="badge badge-success">{{ $role }}</label>
                                            @endforeach 
                                        @endif
                                    </td>
                                    <td>
                                        @can('user-show')
                                        <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
                                        @endcan
                                        @can('user-edit')
                                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                        @endcan
                                        @can('user-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!} 
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!} 
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
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