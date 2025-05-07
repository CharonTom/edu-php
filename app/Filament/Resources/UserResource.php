<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\Action;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Élèves';
    protected static ?string $pluralModelLabel = 'Élèves';
    protected static ?string $modelLabel = 'Élève';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Détails de l’élève')
                    ->tabs([
                        Tabs\Tab::make('Infos')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nom')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('password')
                                    ->label('Mot de passe')
                                    ->password()
                                    ->required()
                                    ->maxLength(255),
                                Toggle::make('signed_in')
                                    ->label('Présent ?')
                                    ->required(),
                            ]),
                        Tabs\Tab::make('QR Code')
                            ->schema([
                                Placeholder::make('qr')
                                    ->label('QR Code de connexion')
                                    ->content(fn ($record) => QrCode::size(200)
                                        ->generate(route('user.signIn'))),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('showQr')
                    ->label('QR Global')
                    ->icon('heroicon-o-qr-code')
                    ->modalHeading('QR Code de connexion')
                    ->modalContent(fn () => QrCode::size(400)
                        ->generate(route('user.signIn'))
                    )
                    ->color('primary'),
            ])
            ->columns([
                TextColumn::make('name')->label('Nom')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                ToggleColumn::make('signed_in')->label('Présent ?')->sortable(),
                TextColumn::make('created_at')->label('Créé le')->dateTime()->sortable(),
                TextColumn::make('updated_at')->label('Mis à jour le')->dateTime()->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
