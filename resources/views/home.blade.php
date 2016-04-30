@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h5>Hi, {{ $user->name }}! Here are the trips you have scheduled.</h5>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Delete</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Date & Time</th>
                                    <th>Map</th>
                                </tr>

                                @foreach($user->trips as $trip)
                                    <tr>
                                        <form action="{{ url('/trips/delete') }}" method="post">
                                            {!! csrf_field() !!}

                                            <td>
                                            <button type="submit" class="btn btn-default btn-danger" name="trip_id" value="{{ $trip->id }}" >
                                              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </button>
                                            </td>
                                        </form>

                                        <td>{{ $trip->origin }}</td>
                                        <td>{{ $trip->destination }}</td>
                                        <td>{{ $trip->datetime }}</td>
                                        <form action="{{ url('/directions') }}" method="get">
                                            <td><button type="submit" name="id" class="btn btn-primary" value="{{ $trip->id }}">Route</button></td>
                                        </form>

                                    </tr>
                                @endforeach
                            </table>
                        <form action="{{ url('/trips') }}">
                            <button type="submit" class="btn btn-primary">Join Ride</button>
                        </form>
                    </br>
                    @if ($user->admin === 1)
                        <form action="{{ url('/admin/create') }}">
                            <button type="submit" class="btn btn-success">Create Ride</button>
                        </form>

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection