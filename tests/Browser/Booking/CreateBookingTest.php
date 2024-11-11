<?php

namespace Tests\Browser\Booking;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateBookingTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_a_customer_can_create_a_reservation(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
        ]);

        $room = Room::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $room) {
            $browser->loginAs($user)
                ->visit(route('bookings.create'))
                ->type('#reserved_for', '2024-11-11T13:40')
                ->select('#room', $room->id)
                ->press('Create')
                ->assertSee('Booking created successfully.');
        });
    }
}
