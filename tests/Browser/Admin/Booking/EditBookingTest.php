<?php

namespace Tests\Browser\Admin\Booking;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditBookingTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_an_admin_user_can_change_the_status_of_a_reservation(): void
    {
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        $booking = Booking::factory()->create([
            'status' => 1,
        ]);

        $this->browse(function (Browser $browser) use ($user, $booking) {
            $browser->loginAs($user)
                ->visit(route('admin.bookings.edit', $booking))
                ->assertSee('Edit Booking')
                ->assertSee(__('Status'))
                ->assertSee(__('Reserved for'))
                ->assertSee(__('Room'))
                ->assertSee(__('Customer Name'))
                ->select('status', '2')
                ->press('Update')
                ->assertSee('Booking updated successfully.');
        });
    }
}
