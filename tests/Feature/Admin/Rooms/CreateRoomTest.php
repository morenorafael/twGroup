<?php

namespace Tests\Feature\Admin\Rooms;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_user_can_create_a_room(): void
    {
        // Given
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        // When
        $response = $this->actingAs($user)->post(route('admin.rooms.store'), [
            'name' => 'Test Room',
            'description' => 'Test Description',
        ]);

        // Then
        $response->assertRedirect(route('admin.rooms.index'));

        $response->assertSessionHas('success', __('Room created successfully.'));

        $this->assertDatabaseHas('rooms', [
            'name' => 'Test Room',
            'description' => 'Test Description',
        ]);
    }

    public function test_name_is_required(): void
    {
        // Given
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        // When
        $response = $this->actingAs($user)->post(route('admin.rooms.store'), [
            'description' => 'Test Description',
        ]);

        // Then
        $response->assertSessionHasErrors('name');
    }

    public function test_description_is_optional(): void
    {
        // Given
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        // When
        $response = $this->actingAs($user)->post(route('admin.rooms.store'), [
            'name' => 'Test Room',
        ]);

        // Then
        $response->assertRedirect(route('admin.rooms.index'));

        $response->assertSessionHas('success', __('Room created successfully.'));

        $this->assertDatabaseHas('rooms', [
            'name' => 'Test Room',
            'description' => null,
        ]);
    }

    public function test_a_customer_user_cannot_create_a_room(): void
    {
        // Given
        $user = User::factory([
            'role' => 'customer',
        ])->create();

        // When
        $response = $this->actingAs($user)->post(route('admin.rooms.store'), [
            'name' => 'Test Room',
            'description' => 'Test Description',
        ]);

        // Then
        $response->assertForbidden();
    }
}
