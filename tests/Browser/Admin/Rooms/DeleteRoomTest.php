<?php

namespace Tests\Browser\Admin\Rooms;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_an_admin_user_can_delete_a_room(): void
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
                ->visitRoute('admin.rooms.index')
                ->press('#delete-button-'.$room->id)
                ->assertSee(__('Room deleted successfully.'))
                ->assertDontSee($room->name);
        });
    }
}
