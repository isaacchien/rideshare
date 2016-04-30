@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
					<form class="form-horizontal" action="{{ url('/admin/store') }}" method="post">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Origin</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="origin" value="{{ old('origin') }}">

                                @if ($errors->has('origin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('origin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('destination') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Destination</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="destination">

                                @if ($errors->has('destination'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('destination') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date">

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Time</label>

                            <div class="col-md-6">
                                <input type="time" class="form-control" name="time">

                                @if ($errors->has('time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
