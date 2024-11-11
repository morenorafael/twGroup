<?php

namespace Tests\Browser\Admin\Rooms;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_an_admin_user_can_edit_a_room(): void
    {
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        $room = Room::factory()->create([
            'name' => 'Test Room',
            'description' => 'Test Description',
        ]);

        $this->browse(function (Browser $browser) use ($user, $room) {
            $browser->loginAs($user)
                ->visitRoute('admin.rooms.edit', $room)
                ->waitForText(__('Edit Room'))
                ->type('#name', 'Test Room Updated')
                ->type('#description', 'Test Description Updated')
                ->press('#update-room-button')
                ->waitForText('Test Room Updated')
                ->assertSee(__('Room updated successfully.'));
        });
    }
}
