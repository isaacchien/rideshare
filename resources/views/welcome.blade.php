@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="image" align="center">
                   <a href="{{ url('/home') }}">
                    <img src="{{ URL::to('/') }}/img/carpool.gif" class="thumb" alt="a picture" style:>
                    </a>
                </div>
                <div class="panel-body">
                    RideShare allows you to easily carpool with others. As a passenger, you can join other rides. As a driver, you can setup rides that others may join. 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
