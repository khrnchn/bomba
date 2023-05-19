<?php

namespace App\Filament\Resources;

use App\Models\Feedback;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Participant;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationGroup = 'Program';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'comment';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
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

                Select::make('participant_id')
                    ->rules(['exists:participants,id'])
                    ->required()
                    ->relationship('participant', 'id')
                    ->searchable()
                    ->placeholder('Participant')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Textarea::make('comment')
                    ->rules(['max:255', 'string'])
                    ->required()
                    ->placeholder('Comment')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('rating')
                    ->required()
                    ->placeholder('Rating')
                    ->options([
                        'very satisfied' => 'Very Satisfied',
                        'satisfied' => 'Satisfied',
                        'neutral' => 'Neutral',
                        'dissatisfied' => 'Dissatisfied',
                        'very dissatisfied' => 'Very Dissatisfied',
                    ])
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                FileUpload::make('feedback_photo_path')
                    ->label('Feedback Image')
                    ->placeholder('Feedback image (If any)')
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
                Tables\Columns\TextColumn::make('participant.id')
                ->sortable()
                    ->limit(50)
                    ->getStateUsing(function (Model $record) {
                        $participantId = $record->participant_id;
                        $userId = Participant::where('id', $participantId)->value('user_id');
                        $name = User::where('id', $userId)->value('name');

                        return $name;
                    }),
                Tables\Columns\TextColumn::make('rating')
                ->sortable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('program_id')
                    ->relationship('program', 'name')
                    ->indicator('Program')
                    ->multiple()
                    ->label('Program'),

                SelectFilter::make('participant_id')
                    ->relationship('participant', 'id')
                    ->indicator('Participant')
                    ->multiple()
                    ->label('Participant'),
            ])
            ->bulkActions([
                
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedbacks::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            // 'view' => Pages\ViewFeedback::route('/{record}'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
