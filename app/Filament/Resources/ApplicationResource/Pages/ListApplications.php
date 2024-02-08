<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Models\Application;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create_app')->form([
                TextInput::make('name')
            ])
            ->modalWidth(MaxWidth::Medium)
            ->action(function (array $data): void {
                $app = new Application;
                $app->name = $data['name'];
                $app->save();
            }),
        ];
    }
}
