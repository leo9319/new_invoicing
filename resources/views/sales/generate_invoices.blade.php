@extends('layouts.master') 

@section('title', 'Create Invoice') 

@section('content')

<div class="app-main__inner">
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                           @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                      </div>
                    @endif
                    <h5 class="card-title">Please provide the necessary information</h5>
                    {{ Form::open() }}

                        <div id="app">
                            <div class="form-row">
                        
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('start_date') }}
                                        {!! Form::input('datetime-local', 'start_date', Carbon\Carbon::now(new DateTimeZone('Asia/Dhaka'))->subDays(1)->format('Y-m-d\TH:i'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('end_date') }}
                                        {!! Form::input('datetime-local', 'end_date', Carbon\Carbon::now(new DateTimeZone('Asia/Dhaka'))->format('Y-m-d\TH:i'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
    
                            </div>

                            {{ Form::submit('Generate', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}

                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection