<?php

namespace App\Filament\Resources;

use App\Models\Participant;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\ParticipantResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Model;
use Khsing\World\Models\Country;
use Khsing\World\Models\Division;

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationGroup = 'Program';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Toggle::make('isMalaysian')
                    ->required()
                    ->label('Is Malaysian')
                    ->inline(false),

                Select::make('user_id')
                    ->label('User')
                    ->searchable()
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),

                Select::make('country_id')
                    ->default(87)
                    ->label('Country')
                    ->searchable()
                    ->options(Country::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('division_id', null)),

                Select::make('division_id')
                    ->label('Division')
                    ->searchable()
                    ->options(function (callable $get) {
                        $country = Country::find($get('country_id'));

                        if (!$country) {
                            return Division::all()->pluck('name', 'id')->toArray();
                        }

                        return $country->divisions->pluck('name', 'id');
                    })
                    ->required(),

            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Name')
                    ->limit(50),

                TextColumn::make('world_country_id')
                    ->label('Country')
                    ->limit(50)
                    ->getStateUsing(function (Model $record) {
                        $countryId = $record->world_country_id;
                        $name = Country::where('id', $countryId)->value('name');

                        return $name;
                    }),

                BadgeColumn::make('is_malaysian_name')
                    ->label('Malaysian')
                    ->colors([
                        'success' => static fn ($state): bool => $state === 'Yes',
                        'primary' => static fn ($state): bool => $state === 'No',
                    ]),

                TextColumn::make('world_division_id')
                    ->label('Division')
                    ->limit(50)
                    ->getStateUsing(function (Model $record) {
                        $divisionId = $record->world_division_id;
                        $name = Division::where('id', $divisionId)->value('name');

                        return $name;
                    }),
            ])
            ->filters([DateRangeFilter::make('created_at')]);
    }

    public static function getRelations(): array
    {
        return [
            ParticipantResource\RelationManagers\FeedbacksRelationManager::class,
            ParticipantResource\RelationManagers\ChecksRelationManager::class,
            ParticipantResource\RelationManagers\ProgramsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'view' => Pages\ViewParticipant::route('/{record}'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
        ];
    }
}
