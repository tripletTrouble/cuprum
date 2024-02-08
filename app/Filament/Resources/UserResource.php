<?php

namespace App\Filament\Resources;

use App\Models\Role;
use Filament\Forms;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use App\Models\Application;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->required(),
                TextInput::make('password')->required()
                    ->password()
                    ->confirmed()
                    ->revealable(),
                TextInput::make('password_confirmation')
                    ->required()
                    ->password()
                    ->revealable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Action::make('assign_role')
                        ->icon('heroicon-m-user-group')
                        ->form([
                            Select::make('application_id')
                                ->options(Application::all()->pluck('name', 'id'))
                                ->searchable()
                                ->disablePlaceholderSelection()
                                ->live()
                                ->default('1'),
                            CheckboxList::make('roles')
                                ->relationship('roles', 'name')
                                ->options(function (Get $get) {
                                    return Role::where('application_id', $get('application_id'))
                                        ->get()->pluck('name', 'id');
                                })
                        ])
                        ->fillForm(fn (User $user) => ['roles' => $user->roles->toArray()])
                        ->action(function (User $user, array $data) {
                            Notification::make('role_assigned')
                                ->title("Success")
                                ->body("Role has been assigned")
                                ->success()
                                ->send();
                        })
                ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
