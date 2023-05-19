<?php

namespace App\Filament\Resources;

use App\Models\Station;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\StationResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Khsing\World\Models\City;
use Khsing\World\Models\Division;

class StationResource extends Resource
{
    protected static ?string $model = Station::class;

    protected static ?string $navigationGroup = 'Organization';

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('division_id')
                        ->label('State')
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->options(Division::where('country_id', 87)->pluck('name', 'id')->toArray())
                        ->afterStateUpdated(fn (callable $set) => $set('city_id', null))
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('city_id')
                        ->label('City')
                        ->searchable()
                        ->required()
                        ->options(function (callable $get) {
                            $division = Division::find($get('division_id'));

                            if (!$division) {
                                return City::where('country_id', 87)->pluck('name', 'id')->toArray();
                            }

                            return $division->cities->pluck('name', 'id');
                        })
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
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->limit(50),

                TextColumn::make('world_division_id')
                    ->label('State')
                    ->limit(50)
                    ->getStateUsing(function (Model $record) {
                        $divisionId = $record->world_division_id;
                        $name = Division::where('id', $divisionId)->value('name');

                        return $name;
                    }),

                TextColumn::make('world_city_id')
                    ->label('City')
                    ->limit(50)
                    ->getStateUsing(function (Model $record) {
                        $cityId = $record->world_city_id;
                        $name = City::where('id', $cityId)->value('name');

                        return $name;
                    }),


            ])
            ->filters([DateRangeFilter::make('created_at')]);
    }

    public static function getRelations(): array
    {
        return [
            StationResource\RelationManagers\AllStaffRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStations::route('/'),
            'create' => Pages\CreateStation::route('/create'),
            'view' => Pages\ViewStation::route('/{record}'),
            'edit' => Pages\EditStation::route('/{record}/edit'),
        ];
    }
}
