<?php

namespace Tests\Feature;

use App\Filament\Resources\ClientResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientResourceTest extends TestCase
{
    public function test_can_access_user_index_page(): void
    {
        $this->actingAs(User::find(1))->get(ClientResource::getUrl('index'))->assertSuccessful();
    }

    public function test_can_access_user_create_page(): void
    {
        $this->actingAs(User::find(1))->get(ClientResource::getUrl('create'))->assertSuccessful();
    }
}
