@extends('layouts.master') 

@section('title', 'Profile') 

@section('content')

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Vertical Menu</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">Link
                                        <div class="ml-auto badge badge-success">New</div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">Another Link
                                        <div class="ml-auto badge badge-warning">512</div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a disabled="" href="javascript:void(0);" class="nav-link disabled">Disabled Link</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        <i class="nav-link-icon lnr-inbox"> </i>
                                        <span>Inbox</span>
                                        <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                    </a>
                                </li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon lnr-book"> </i><span>Book</span>
                                                        <div class="ml-auto badge badge-pill badge-danger">5</div>
                                                    </a></li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon lnr-picture"> </i><span>Picture</span></a></li>
                                <li class="nav-item"><a disabled="" href="javascript:void(0);" class="nav-link disabled"><i class="nav-link-icon lnr-file-empty"> </i><span>File Disabled</span></a></li>
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