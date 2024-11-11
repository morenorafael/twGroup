<?php

namespace Tests\Feature\Admin\Booking;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_user_can_change_the_status_of_a_reservation(): void
    {
        // Given
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        $booking = Booking::factory()->create([
            'status' => 1,
        ]);

        // When
        $response = $this->actingAs($user)->put(route('admin.bookings.update', $booking), [
            'status' => 2,
        ]);

        // Then
        $response->assertRedirect(route('admin.bookings.index'));

        $response->assertSessionHas('success', __('Booking updated successfully.'));

        $this->assertDatabaseHas('bookings', [
            'status' => 2,
        ]);
    }
}
