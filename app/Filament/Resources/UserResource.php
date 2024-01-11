<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Panel;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool {
        if (auth()->user()->roles == 'ADMIN') {
            return true;
        } else {
            return false;
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Name')
                ->required(),
                TextInput::make('email')
                ->label('User Email')
                ->required(),
                Select::make('roles')->multiple()->relationship('roles', 'name'),
                TextInput::make('password')
                ->label('Password')
                ->password()
                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                ->required(fn (Page $livewire):bool => $livewire instanceof CreateRecord)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('No. ')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('name')
                ->label('Name')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('email')
                ->label('Email')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('roles.name')
                ->label('Roles')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('password')
                ->label('Password')
                ->alignment(Alignment::Center)
                ->toggleable(true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
