<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Filament\Resources\StoreResource\RelationManagers;
use App\Forms\Components\Review;
use App\Models\Caeegory;
use App\Models\Category;
use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),

                TextInput::make('description'),
                FileUpload::make('image'),
                TextInput::make('lowest_price'),
                TextInput::make('highest_price'),
                TextInput::make('postal_code'),
                TextInput::make('Address'),
                TextInput::make('opening_time'),
                TextInput::make('closing_time'),

                Select::make('category_id')->options(function (): array {
                    return Category::all()->pluck('name', 'id')->all();
                })->native(false)
                    ->beforeStateDehydrated(function ($state) {
                        return $state;
                    })->label('Category Name')->searchable()
                // TextInput::make('seating_capacity')
                ,
                TextInput::make('seat')->label('Left Seat')
                    ->afterStateHydrated(function (TextInput $component, $record) {

                        $component->state($record->leftSeat());
                    })
                    ->readOnly(),

                ViewField::make('reviews')->view('filament.forms.components.review')
                    // Review::make('reviews')
                    //     ->Getstore($record)
                    // ->viewData([
                    //     'data' => function ($record) {
                    //         // Logic to fetch and pass data if needed

                    //         return $record->reviews->all();
                    //     },
                    // ])
                    ->viewData([
                        'reviews' => $form->model->reviews

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),

                TextColumn::make('description'),
                ImageColumn::make('image'),
                TextColumn::make('lowest_price'),
                TextColumn::make('highest_price'),
                TextColumn::make('postal_code'),
                TextColumn::make('Address'),
                TextColumn::make('opening_time'),
                TextColumn::make('closing_time'),
                TextColumn::make('category.name')->searchable(),
                TextColumn::make('seating_capacity'),
                TextColumn::make('seat')->label('Left Seat')
                    ->getStateUsing(function ($record) {
                        return $record->leftSeat();
                    }),



            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'view' => Pages\ViewStore::route('/{record}'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }
}
