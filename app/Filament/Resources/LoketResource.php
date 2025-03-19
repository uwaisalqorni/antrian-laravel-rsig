<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoketResource\Pages;
use App\Filament\Resources\LoketResource\RelationManagers;
use App\Models\Loket;
use App\Models\Jadwal;
use App\Services\QueueService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Summarizers\Count;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoketResource extends Resource
{
    protected static ?string $model = Loket::class;
    protected static ?string $label = 'Loket';
    protected static ?string $navigationIcon = 'heroicon-o-hashtag';
    protected static ?string $navigationGroup = 'Administrasi';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('poli_id')
                    ->required()
                    ->relationship('poli','name'),
                Forms\Components\Select::make('jadwal_id')
                    ->required()
                    ->relationship('jadwal','name'),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('poli.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jadwal.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('activeQueue.number')
                    ->label('Nomor Antrian Saat ini')
                    ->searchable(),
                Tables\Columns\TextColumn::make('activeQueue.status')
                    ->label('Status Antrian')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active'),
                    // ->label('Status Aktif')
                    // ->boolean(),
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
                self::getCallNextQueueAction(),
                self::getServeQueueAction(),
                self::getFinishQueueAction(),
                self::getCancelQueueAction()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->poll('5s');

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLokets::route('/'),
        ];
    }

    private static function getCallNextQueueAction()
    {
        return Action::make('callNextQueue')
            ->button()
            ->visible(fn(Loket $record) => $record->hasNextQueue)
            ->action(function (Loket $record, $livewire) {
                $nextQueue = app(QueueService::class)->callNextQueue($record->id);

                if (!$nextQueue) {
                    Notification::make()
                        ->title('No queue available')
                        ->danger()
                        ->send();

                    return;
                }

                $livewire->dispatch("queue-called", "Nomor Antrian " . $nextQueue->number . " segera ke " . $record->name);
            })
            ->label("Panggil")
            ->icon("heroicon-o-speaker-wave");
    }

    private static function getServeQueueAction()
    {
        return Action::make('serve')
            ->label('Layani')
            ->button()
            ->color('success')
            ->icon('heroicon-o-check-circle')
            ->action(function (Loket $record) {
                app(QueueService::class)->serveQueue($record->activeQueue);
            })
            ->requiresConfirmation()
            ->visible(fn(Loket $record) => $record->is_available && $record->activeQueue);
    }

    private static function getFinishQueueAction()
    {
        return Action::make('finishQueue')
            ->label('Selesai')
            ->button()
            ->icon('heroicon-o-check')
            ->action(function (Loket $record) {
                app(QueueService::class)->finishQueue($record->activeQueue);
            })
            ->requiresConfirmation()
            ->visible(fn(Loket $record) => $record->activeQueue?->status === 'serving');
    }

    private static function getCancelQueueAction()
    {
        return Action::make('cancelQueue')
            ->label('Batalkan')
            ->button()
            ->color('danger')
            ->icon('heroicon-o-x-circle')
            ->action(function (Loket $record) {
                app(QueueService::class)->cancelQueue($record->activeQueue);
            })
            ->requiresConfirmation()
            ->visible(fn(Loket $record) => $record->is_available && $record->activeQueue);
    }
}
