<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Post Info')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('excerpt'),
                        Forms\Components\TextInput::make('meta_title'),
                        Forms\Components\Textarea::make('meta_description')
                        ->autosize(),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('posts/images')
                            ->visibility('public'),

                        Forms\Components\FileUpload::make('video')
                            ->label('Upload Video')
                            ->directory('posts/videos')
                            ->visibility('public')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg']),

                        Forms\Components\TextInput::make('video_url')
                            ->label('External Video URL')
                            ->url(),

                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('tags')
                            ->multiple()
                            ->relationship('tags', 'name')
                            ->preload()
                            ->searchable(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->required(),

                        Forms\Components\DateTimePicker::make('published_at'),
                        Toggle::make('featured')
                ->label('Featured Post')
                ->onColor('success')
                ->offColor('secondary')
                ->reactive(),

            DateTimePicker::make('featured_until')
                ->label('Feature Until Date')
                ->nullable()
                ->hidden(fn (Get $get) => !$get('featured')),

                        Forms\Components\Hidden::make('user_id')
                            ->default(fn () => auth()->id()),
                    ]),

                Forms\Components\Section::make('Sections')
                    ->schema([
                        Forms\Components\Repeater::make('sections')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('title'),
                                Forms\Components\Textarea::make('content')->autosize(),
                                Forms\Components\TextInput::make('link')->url()->label('External Link'),

                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('posts/sections/images')
                                    ->visibility('public'),

                                Forms\Components\FileUpload::make('video')
                                    ->directory('posts/sections/videos')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg']),

                                Forms\Components\TextInput::make('video_url')
                                    ->url()
                                    ->label('Video URL'),

                                
                            ])
                            ->label('Post Sections')
                            ->defaultItems(1)
                            ->collapsible()
                            ->orderable('order')
                            ->grid(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\ImageColumn::make('image')
    ->label('Image')
    ->circular()
    ->disk('public')
    ,
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('published_at')->dateTime(),
                ToggleColumn::make('featured')
    ->label('Featured')
    ->onColor('warning')  // Color when true
    ->offColor('gray')    // Color when false
    ->onIcon('heroicon-o-star')
    ->offIcon('heroicon-o-star')
    ->updateStateUsing(function ($record, $state) {
        $record->featured = $state;
        $record->save();
    }),


TextColumn::make('featured_until')
    ->label('Featured Until')
    ->dateTime()
    ->sortable()
    ->toggleable()
    ->action(
        Action::make('setFeaturedUntil')
            ->form([
                \Filament\Forms\Components\DateTimePicker::make('featured_until')
                    ->label('Featured Until')
                    ->required()
                    ->minDate(now())
                    ->native(false)
                    ->displayFormat('M j, Y H:i')
            ])
            ->action(function ($record, array $data) {
                // Convert string to Carbon instance first
                $featuredUntil = Carbon::parse($data['featured_until']);

                $record->update([
                    'featured' => true,
                    'featured_until' => $featuredUntil
                ]);

                Notification::make()
                    ->title('Post Featured')
                    ->body("Post will be featured until " . $featuredUntil->format('M j, Y H:i'))
                    ->success()
                    ->send();
            })
    )
    ->placeholder('Not featured'),
            ])
            ->filters([])
            ->actions([
    ActionGroup::make([
        Action::make('updateStatus')
            ->label('Update Status')
            ->icon('heroicon-o-pencil-square')
            ->form([
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->required(),
            ])
            ->action(function (array $data, $record) {
                $record->update([
                    'status' => $data['status'],
                ]);
            }),

        DeleteAction::make(),
        EditAction::make()->modal(),
        ViewAction::make()->modal(),
    ])
])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            //'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
