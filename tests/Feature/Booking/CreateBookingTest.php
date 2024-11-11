<?php

namespace Tests\Feature\Booking;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_customer_can_create_a_reservation(): void
    {
        // Given
        $user = User::factory()->create([
            'role' => 'customer',
        ]);

        $room = Room::factory()->create();

        // When
        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'reserved_for' => '2024-11-11T13:40',
            'room_id' => $room->id,
        ]);

        // Then
        $response->assertRedirect(route('dashboard'));

        $response->assertSessionHas('success', __('Booking created successfully.'));

        $this->assertDatabaseHas('bookings', [
            'status' => 1,
            'reserved_for' => '2024-11-11 13:40:00',
            'user_id' => $user->id,
            'room_id' => $room->id,
        ]);
    }

    public function test_cannot_create_a_reservation_at_the_same_time_as_another_one(): void
    {
        // Given
        $user = User::factory()->create([
            'role' => 'customer',
        ]);

        $room = Room::factory()->create();

        Booking::factory()->create([
            'reserved_for' => '2024-11-11 13:40:00',
            'user_id' => $user->id,
            'room_id' => $room->id,
        ]);

        // When
        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'reserved_for' => '2024-11-11T13:40',
            'room_id' => $room->id,
        ]);

        // Then
        $response->assertSessionHasErrors('reserved_for');
    }
}
