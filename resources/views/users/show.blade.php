@extends('layouts.master') 

@section('title', 'Profile') 

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item m-2"><b>Name: </b>{{ $user->name }}</li>
                                <li class="nav-item m-2"><b>Email: </b>{{ $user->email }}</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item m-2">
                                    <b>Role: </b>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="divider"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection