<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Application;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientResource\RelationManagers;
use Filament\Infolists;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-m-key';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('application_id')
                    ->relationship('application', 'name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->live()
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('name', Application::find($state)?->name)),
                TextInput::make('name')
                    ->label('Application Name')
                    ->readOnly()
                    ->required()
                    ->live(),
                TextInput::make('redirect')
                    ->label('URL Redirection')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Client ID'),
                TextColumn::make('application.name')->searchable(),
                TextColumn::make('redirect'),
                TextColumn::make('secret')
            ])
            ->recordUrl(null)
            ->filters([
                SelectFilter::make('application_id')
                    ->options(Application::all()->pluck('name', 'id')->toArray())
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
