<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Transaction;
use App\Filament\Resources\TransactionResource\Pages\ListTransactions; // Assuming you use this class for importing
use Filament\Actions\ImportAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CsvImportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_import_processes_jobs_and_saves_data_to_database()
    {
        // Prepare
        Queue::fake(); // To mock the queue and assert that jobs are pushed
        
        // Mock the storage for the test CSV
        Storage::fake('local');
        $filePath = 'test-csv/transactions.csv';

        // Upload your testing CSV into the mock storage
        Storage::put($filePath, file_get_contents(base_path('tests/Fixtures/transactions.csv')));

        // Create an account for the import (since your import needs an account ID)
        $account = Account::factory()->create();

        // Act
        // Here we simulate triggering the Filament import action (this might need adjustment based on your exact Filament setup)
        $importAction = ImportAction::make()
            ->importer(TransactionImporter::class) // Adjust this class name to match your importer
            ->csvDelimiter(';')
            ->handleUploadedFile($filePath, 'local');

        // Process the queue to make sure jobs run (in case jobs are queued by the importer)
        $this->artisan('queue:work --once');

        // Assert that the jobs have been dispatched
        Queue::assertPushed(\App\Jobs\ProcessTransactionJob::class);

        // Assert that the transactions were saved to the database
        $this->assertDatabaseHas('transactions', [
            'booking_text' => 'Sample Booking Text', // Adjust these to your CSV's contents
            'purpose' => 'Sample Purpose',
            'tax_relevant' => true,
            'amount' => 1234.56,
            'currency' => 'EUR',
            'balance_after_booking' => 9876.54,
            'remark' => 'Sample Remark',
            'category' => 'Sample Category',
            'mandate_reference' => 'Sample Mandate',
            'account_id' => $account->id,
        ]);
    }
}
