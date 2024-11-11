<?php

namespace Tests\Feature\Admin\Rooms;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditRoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_user_can_edit_a_room(): void
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
        $response = $this->actingAs($user)->put(route('admin.rooms.update', $room), [
            'name' => 'Test Room Updated',
            'description' => 'Test Description Updated',
        ]);

        // Then
        $response->assertRedirect(route('admin.rooms.index'));

        $response->assertSessionHas('success', __('Room updated successfully.'));

        $this->assertDatabaseHas('rooms', [
            'name' => 'Test Room Updated',
            'description' => 'Test Description Updated',
        ]);
    }
}
