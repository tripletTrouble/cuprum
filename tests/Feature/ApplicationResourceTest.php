<?php

namespace Tests\Feature;

use App\Filament\Resources\ApplicationResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationResourceTest extends TestCase
{
    public function test_can_access_user_index_page(): void
    {
        $this->actingAs(User::find(1))->get(ApplicationResource::getUrl('index'))->assertSuccessful();
    }

    public function test_can_access_user_create_page(): void
    {
        $this->actingAs(User::find(1))->get(ApplicationResource::getUrl('create'))->assertSuccessful();
    }
}
