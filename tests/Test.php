<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class Test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCreate()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
		     ->withSession(['user' => $user])
             ->visit('/home')
             ->see($user->name);
    
    }

    public function testCreateRide()
    {

        $user = factory(App\User::class)->create();

	    $this->actingAs($user)
	    	 ->withSession(['foo' => 'bar'])

	    	 ->visit('/admin/create')
	         ->type('Los Angeles', 'origin')
	         ->type('San Francisco', 'destination')
	         ->type('11/21/2016', 'date')
	         ->type('12:00 PM', 'time')
	         ->press('Create')
	         ->seePageIs('/home');

    }
    public function testLogout()
    {
    	$user = factory(App\User::class)->create();
    	
    	$this->actingAs($user)
	    	 ->withSession(['foo' => 'bar'])
	    	 ->visit('/logout')
             ->see("Register");

    }
    public function testSearch()
    {

    	$user = factory(App\User::class)->create();
    	$trip = new \App\Trip;

		$trip->origin = "Los Angeles";
		$trip->destination = "San Francisco";
		$trip->driver_id = $user->id;
		$trip->datetime = "2016-04-24 08:00:00";
		$trip->save();

    	$this->actingAs($user)
	    	 ->withSession(['foo' => 'bar'])
	    	 ->visit('/trips')
	    	 ->type('Los Angeles', 'origin')
	    	 ->type('San Francisco', 'destination')
             ->see('Los Angeles')
             ->see('San Francisco');

    }
    public function testRoute()
    {

    	$user = factory(App\User::class)->create();
    	$trip = new \App\Trip;

		$trip->origin = "Los Angeles";
		$trip->destination = "San Francisco";
		$trip->driver_id = $user->id;
		$trip->datetime = "2016-04-24 08:00:00";
		$trip->save();
    	$trip->users()->attach($user);

    	$this->actingAs($user)
	    	 ->withSession(['foo' => 'bar'])
	    	 ->visit('/home')
	         ->press('Route')
	         ->see('Map');

    }
}
