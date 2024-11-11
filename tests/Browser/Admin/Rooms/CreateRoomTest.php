<?php

namespace Tests\Browser\Admin\Rooms;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_an_admin_user_can_create_a_room(): void
    {
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visitRoute('admin.rooms.create')
                ->waitForText(__('Create Room'))
                ->type('#name', 'Test Room')
                ->type('#description', 'Test Description')
                ->press('#create-room-button')
                ->waitForText('Test Room')
                ->assertSee(__('Room created successfully.'));
        });
    }

    public function test_name_is_required(): void
    {
        $user = User::factory([
            'role' => 'admin',
        ])->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visitRoute('admin.rooms.create')
                ->waitForText(__('Create Room'))
                ->press('#create-room-button')
                ->waitForText(__('The name field is required.'));
        });
    }
}
