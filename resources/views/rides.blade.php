@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">

				<div class="panel-heading">Add a Trip</div>

				<div class="panel-body">

@if (session('success')) : ?>
	<p>Review was successfully added.</p>
@endif
 <?php //echo count($errors) ?>
<?php if (count($errors) > 0) : ?>
    <ul>
        <?php foreach ($errors->all() as $error) : ?>
            <li>
                <?php echo $error ?>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
<div class="row">

	<form action="{{ url('/trips/search') }}" method="get">
	  <div class="col-md-6">

	    <div class="input-group">
	      <input name="origin" type="text" class="form-control" placeholder="Origin...">
	    </div><!-- /input-group -->
	  </div>
	    <div class="col-md-6">

	    <div class="input-group">
	      <input name="destination" type="text" class="form-control" placeholder="Destination...">

	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit">Go!</button>
	      </span>
	    </div><!-- /input-group -->
	  </div>

	</form>
</div>
					<form action="{{ url('/trips/join') }}" method="post">
                        {!! csrf_field() !!}

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Join Ride</th>
										<th>Origin</th>
										<th>Destination</th>
										<th>Date & Time</th>

									</tr>
								</thead>
								<tbody>
									<?php foreach($trips as $trip) : ?>

										<tr>
											<td><button type="submit" name="id" class="btn btn-primary" value=<?php echo $trip->id?>>Add</button></td>
											<td>{{ $trip->origin }}</td>
											<td>{{ $trip->destination }}</td>
											<td>{{ $trip->datetime }}</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>


						</form>


				</div>
			</div>
		</div>
	</div>
@endsection
