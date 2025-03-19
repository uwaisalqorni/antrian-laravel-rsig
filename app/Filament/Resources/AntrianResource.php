<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AntrianResource\Pages;
use App\Filament\Resources\AntrianResource\RelationManagers;
// use App\Filament\Resources\AntrianResource;
use App\Models\Antrian;
use App\Models\Loket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AntrianResource extends Resource
{
    protected static ?string $model = Antrian::class;
    protected static ?string $label = 'Antrian';
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $navigationGroup = 'Administrasi';

    public static function canCreate(): bool
    {
        return false;
    }
    public static function canEdit(Model $record): bool
    {
        return false;
    }
    public static function canUpdate(Model $record): bool
    {
        return false;
    }
    public static function canDeleteAny(): bool
    {
        return false;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('poli_id')
                    ->required()
                    //->relationship('poli','name')
                    ->numeric(),
                Forms\Components\TextInput::make('loket_id')
                    ->numeric()
                    //->relationship('loket','name')
                    ->default(null),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('waiting'),
                Forms\Components\DateTimePicker::make('called_at'),
                Forms\Components\DateTimePicker::make('served_at'),
                Forms\Components\DateTimePicker::make('canceled_at'),
                Forms\Components\DateTimePicker::make('finished_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('poli.name')
                    ->label('Nama Poli')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loket_id')
                    ->label('Nama Loket')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('called_at')
                    ->label('Waktu panggil')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('served_at')
                    ->label('Waktu Dilayani')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('canceled_at')
                    ->label('Batal')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('finished_at')
                    ->label('Waktu Selesai')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAntrians::route('/'),
        ];
    }
}
