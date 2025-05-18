<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Booking;

class BookingTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_seat_can_be_booked()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();
        $seat = Seat::factory()->create(['movie_id' => $movie->id]);

        $booking = Booking::create([
            'user_id' => $user->id,
            'seat_id' => $seat->id
        ]);

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'seat_id' => $seat->id,
        ]);
    }
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }
}
