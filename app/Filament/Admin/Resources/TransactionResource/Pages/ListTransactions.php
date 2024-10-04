<?php

namespace App\Filament\Admin\Resources\TransactionResource\Pages;

use App\Filament\Admin\Resources\TransactionResource;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Imports\TransactionImporter;

use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
         Action::make('import')
    ->form([
        FileUpload::make('file')
            ->storeFiles(false)
            ->required()
    ])
    ->action(function (array $data) {
        Excel::import(new TransactionImporter, $data['file']);
    }) 

        ];
    }
    
}
