<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Models\Client;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Filament\Resources\ClientResource;
use Filament\Resources\Pages\CreateRecord;
use Laravel\Passport\ClientRepository;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $client = (new ClientRepository)->create(
            auth()->user()->id, 
            $data['name'],
            $data['redirect'],
            'users'
        );

        $client->update(['application_id' => $data['application_id']]);

        return $client;
    }
}
