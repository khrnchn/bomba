<?php

namespace App\Filament\Resources;

use App\Models\Program;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Organizer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Khsing\World\Models\Division;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationGroup = 'Program';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make()->schema([
                Section::make('General')->schema([
                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Program name'),

                    Select::make('organizer_id')
                        ->label('Organizer')
                        ->options(Organizer::pluck('name', 'id'))
                        ->required(),

                    Textarea::make('description')
                        ->placeholder('Program description')
                        ->required(),

                    TextInput::make('Capacity')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->placeholder('Set maximum participant'),

                    TextInput::make('address')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Program address'),

                    Select::make('world_division_id')
                        ->label('State')
                        ->options(Division::where('country_id', 87)->pluck('name', 'id'))
                        ->required(),
                ]),
            ])->columnSpan(['lg' => 2]),

            Group::make()->schema([
                Section::make('Poster')->schema([
                    FileUpload::make('poster_path')
                        ->label(''),
                ])->collapsible(),

                Section::make('Date')->schema([
                    DatePicker::make('start_date')
                        ->placeholder('Program start date')
                        ->required(),

                    DatePicker::make('end_date')
                        ->placeholder('Program end date')
                        ->required(),

                    DatePicker::make('registration_start_date')
                        ->placeholder('Program registration start date')
                        ->required(),

                    DatePicker::make('registration_end_date')
                        ->placeholder('Program registration end date')
                        ->required(),
                ]),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('organizer.name')
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('start_date')
                    ->toggleable()
                    ->dateTime(),

                Tables\Columns\TextColumn::make('end_date')
                    ->toggleable()
                    ->dateTime(),

            ])
            ->filters([DateRangeFilter::make('created_at')]);
    }

    public static function getRelations(): array
    {
        return [
            ProgramResource\RelationManagers\FeedbacksRelationManager::class,
            ProgramResource\RelationManagers\CountersRelationManager::class,
            ProgramResource\RelationManagers\ChecksRelationManager::class,
            ProgramResource\RelationManagers\ParticipantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'view' => Pages\ViewProgram::route('/{record}'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
