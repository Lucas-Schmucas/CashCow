<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Category;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static bool $shouldSkipAuthorization = true;
       
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {   
       
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account.iban'),
                Tables\Columns\TextColumn::make('booking_date'),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->money('EUR'),
                Tables\Columns\TextColumn::make('balance_after_booking')
                    ->numeric()
                    ->money('EUR'),
                Tables\Columns\ColorColumn::make('account.category.color')
                    ->label('Category'),
           ])                


            ->filters([

                SelectFilter::make('category_id')
                    ->relationship('account.category', 'name')
            ])
            ->actions([
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
    
   
}
