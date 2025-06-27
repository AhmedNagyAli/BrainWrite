<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('username')->required(),
            TextInput::make('email')->email()->required(),
            Select::make('role')
                ->options(collect(UserRole::cases())->mapWithKeys(fn($role) => [$role->value => ucfirst(str_replace('_', ' ', $role->value))]))
                ->required(),
            Toggle::make('active')->label('Active'),
            Toggle::make('banned')->label('Banned'),
            TextInput::make('phone'),
            TextInput::make('country'),
            TextInput::make('language'),
            TextInput::make('bio')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('role')->badge(),
                BooleanColumn::make('active'),
                BooleanColumn::make('banned'),
            ])
            ->filters([
                //
            ])
            ->actions([
    ActionGroup::make([
        Action::make('updateRole')
            ->label('Update Role')
            ->form([
                Select::make('role')
                    ->label('New Role')
                    ->options(
                        collect(UserRole::cases())
                            ->mapWithKeys(fn ($role) => [$role->value => ucfirst(str_replace('_', ' ', $role->value))])
                            ->toArray()
                    )
                    ->required(),
            ])
            ->action(fn (array $data, $record) =>
                $record->update(['role' => $data['role']])
            )
            ->icon('heroicon-o-user-group'),

        Action::make('updateActive')
            ->label('Toggle Active')
            ->form([
                Toggle::make('active')->label('Active')->default(true),
            ])
            ->action(fn (array $data, $record) =>
                $record->update(['active' => $data['active']])
            )
            ->icon('heroicon-o-check-circle'),

        Action::make('updateBanned')
            ->label('Toggle Banned')
            ->form([
                Toggle::make('banned')->label('Banned')->default(false),
            ])
            ->action(fn (array $data, $record) =>
                $record->update(['banned' => $data['banned']])
            )
            ->icon('heroicon-o-shield-exclamation'),

        Action::make('updatePassword')
            ->label('Update Password')
            ->form([
                TextInput::make('password')
                    ->label('New Password')
                    ->password()
                    ->required()
                    ->minLength(6),
            ])
            ->action(fn (array $data, $record) =>
                $record->update(['password' => Hash::make($data['password'])])
            )
            ->icon('heroicon-o-lock-closed'),
    ])->label('Manage')->icon('heroicon-o-cog'),
])
;
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
