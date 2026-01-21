<?php

namespace App\Services;

use Carbon\Carbon;

class InstallmentContractService
{

    public function calculateAmounts(array $data): array
    {
        $price = (float) str_replace(',', '', $data['product_price']);
        $down = (float) str_replace(',', '', $data['down_payment'] ?? 0);
        $rate = (float) str_replace(',', '', $data['interest_rate'] ?? 0);

        $data['remaining_amount'] = $price - $down;
        $data['interest_amount'] = ($data['remaining_amount'] * $rate) / 100;
        $data['total_amount'] = $data['remaining_amount'] + $data['interest_amount'];
        $data['installment_amount'] = $data['installment_count'] > 0 ? $data['total_amount'] / $data['installment_count'] : 0;

        return $data;
    }


    public function generateInstallments($data):void
    {
        $startDate = Carbon::parse($data['start_date']);
        $installmentCount = (int) $data['installment_count'];

        for ($i = 1; $i <= $installmentCount; $i++) {
            $data->installments()->create([
                'due_date' => $startDate->copy()->addMonths($i),
                'required_amount' => $data['installment_amount'],
                'paid_amount' => 0,
                'status' => 'pending',
                'created_by' => $data['created_by'] ?? auth()->id(),
            ]);
        }
    }

    public function updateClientDebt($client, $amount, $action = 'increment')
    {
        if (!$client) return;

        if ($action === 'increment') $client->increment('debt', $amount);
        else $client->decrement('debt', $amount);
    }

    public function decrementProductStock($product)
    {
        if ($product) $product->decrement('stock', 1);
    }
}
