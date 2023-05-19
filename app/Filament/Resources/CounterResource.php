<?php

namespace App\Filament\Resources;

use App\Models\Counter;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\CounterResource\Pages;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use stdClass;

class CounterResource extends Resource
{
    protected static ?string $model = Counter::class;

    protected static ?string $navigationGroup = 'Program';

    protected static ?string $navigationIcon = 'heroicon-o-desktop-computer';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('program_id')
                        ->rules(['exists:programs,id'])
                        ->required()
                        ->relationship('program', 'name')
                        ->searchable()
                        ->placeholder('Program')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('isCheckIn')
                        ->helperText('Set whether it is a check in counter.')
                        ->rules(['boolean'])
                        ->required()
                        ->inline(false)
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('no')->getStateUsing(
                    static function (stdClass $rowLoop, HasTable $livewire): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * ($livewire->page - 1
                            ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('program.name')
                ->sortable()
                ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('name')
                ->sortable()
                    
                    ->limit(50),
                Tables\Columns\IconColumn::make('isCheckIn')
                ->sortable()
                    ->boolean(),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('program_id')
                    ->relationship('program', 'name')
                    ->indicator('Program')
                    ->multiple()
                    ->label('Program'),
            ])->bulkActions([
                
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CounterResource\RelationManagers\ChecksRelationManager::class,
            CounterResource\RelationManagers\AllStaffRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCounters::route('/'),
            'create' => Pages\CreateCounter::route('/create'),
            // 'view' => Pages\ViewCounter::route('/{record}'),
            'edit' => Pages\EditCounter::route('/{record}/edit'),
        ];
    }
}
