<?php

namespace Tests\Feature\Admin\Rooms;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteRoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_user_can_delete_a_room(): void
    {
        // Given
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        $room = Room::factory()->create([
            'name' => 'Test Room',
            'description' => 'Test Description',
        ]);

        // When
        $response = $this->actingAs($user)->delete(route('admin.rooms.destroy', $room));

        // Then
        $response->assertRedirect(route('admin.rooms.index'));

        $response->assertSessionHas('success', __('Room deleted successfully.'));

        $this->assertDatabaseMissing('rooms', [
            'name' => 'Test Room',
            'description' => 'Test Description',
        ]);
    }
}
