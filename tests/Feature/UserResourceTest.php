<?php

namespace Tests\Feature;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_access_user_index_page(): void
    {
        $this->actingAs(User::find(1))->get(UserResource::getUrl('index'))->assertSuccessful();
    }

    public function test_can_access_user_create_page(): void
    {
        $this->actingAs(User::find(1))->get(UserResource::getUrl('create'))->assertSuccessful();
    }
}
