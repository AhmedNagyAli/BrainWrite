<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                        Forms\Components\Textarea::make('meta_description'),

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

                        Forms\Components\Hidden::make('user_id')
                            ->default(fn () => auth()->id()),
                    ]),

                Forms\Components\Section::make('Sections')
                    ->schema([
                        Forms\Components\Repeater::make('sections')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('title'),
                                Forms\Components\Textarea::make('content'),
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

                                Forms\Components\TextInput::make('order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Display Order'),
                            ])
                            ->label('Post Sections')
                            ->defaultItems(1)
                            ->collapsible()
                            ->orderable('order')
                            ->grid(2),
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
    ->url(fn ($record) => asset('posts/images' . $record->image)),
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('published_at')->dateTime(),
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
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
