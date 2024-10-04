<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AccountResource\Pages;
use App\Models\Account;
use App\Models\Category;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('iban'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('bic'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category'),
                Tables\Columns\ColorColumn::make('category.color')
                    ->label('Color'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name'),

            ])
            ->actions([
                Tables\Actions\EditAction::make()->tooltip('Edit Account'),
                Action::make('Category')
                    ->tooltip('Select Category')    
                    ->icon('heroicon-m-squares-2x2')
                    ->modalWidth('sm')
                    ->modalHeading('Select Category')
                    ->modalSubmitActionLabel('Save')
                    ->form([
                        Select::make('category_id')
                            ->label('Category')
                            ->options(Category::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                ColorPicker::make('color')
                                    ->required()
                            ])
                            ->createOptionUsing(function (array $data) {
                                return Category::create($data)->getKey();
                            })
                            ->required(),
                    ])
                    ->action(function (array $data, $record): void {
                        $record->update($data);
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
