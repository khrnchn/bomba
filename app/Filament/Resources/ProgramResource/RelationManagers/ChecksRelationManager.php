<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class ChecksRelationManager extends RelationManager
{
    protected static string $relationship = 'checks';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('counter_id')
                    ->rules(['exists:counters,id'])
                    ->relationship('counter', 'name')
                    ->searchable()
                    ->placeholder('Counter')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('staff_id')
                    ->rules(['exists:staff,id'])
                    ->relationship('staff', 'referral_code')
                    ->searchable()
                    ->placeholder('Staff')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('participant_id')
                    ->rules(['exists:participants,id'])
                    ->relationship('participant', 'id')
                    ->searchable()
                    ->placeholder('Participant')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Toggle::make('isCheckIn')
                    ->rules(['boolean'])
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program.name')->limit(50),
                Tables\Columns\TextColumn::make('counter.name')->limit(50),
                Tables\Columns\TextColumn::make('staff.referral_code')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('participant.id')->limit(50),
                Tables\Columns\IconColumn::make('isCheckIn'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('program_id')->relationship(
                    'program',
                    'name'
                ),

                MultiSelectFilter::make('counter_id')->relationship(
                    'counter',
                    'name'
                ),

                MultiSelectFilter::make('staff_id')->relationship(
                    'staff',
                    'referral_code'
                ),

                MultiSelectFilter::make('participant_id')->relationship(
                    'participant',
                    'id'
                ),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
