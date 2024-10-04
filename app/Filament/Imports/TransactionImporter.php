<?php


namespace App\Filament\Imports;

namespace App\Filament\Imports;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class TransactionImporter implements ToCollection, WithHeadingRow, WithCustomCsvSettings
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {

            $account = Account::updateOrCreate(
                ['iban' => $row['iban_zahlungsbeteiligter']],  // Match on IBAN
                [
                    'name' => $row['name_zahlungsbeteiligter'], 
                    'bic' => $row['bic_swift_code_zahlungsbeteiligter']
                ]
            );

            Transaction::create([
                'account_id' =>  $account->id,
                'booking_date' => $this->formatDate($row['buchungstag']),
                'value_date' => $this->formatDate($row['valutadatum']),
                'booking_text' => $row['buchungstext'],
                'purpose' => $row['verwendungszweck'],
                'amount' => $this->formatFloat($row['betrag']),
                'currency' => $row['waehrung'],
                'balance_after_booking' => $this->formatFloat($row['saldo_nach_buchung']),
                'remark' => $row['bemerkung'],
                'tax_relevant' => $row['steuerrelevant']?? false,
            ]);
        }
    }

    // Method to format the date from DD.MM.YYYY to YYYY-MM-DD
    private function formatDate($date)
    {
        // Check if date is already in YYYY-MM-DD format
        if (\DateTime::createFromFormat('Y-m-d', $date) !== false) {
            return $date;
        }

        // Convert DD.MM.YYYY to YYYY-MM-DD
        return \DateTime::createFromFormat('d.m.Y', $date)->format('Y-m-d');
    }

    // Method to cast a string to float and handle commas as decimal separators
    private function formatFloat($value)
    {
        // Replace comma with dot if necessary and cast to float
        return (float)str_replace(',', '.', $value);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }
}
