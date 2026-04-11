<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement([
            Invoice::STATUS_BILLED,
            Invoice::STATUS_PAID,
            Invoice::STATUS_VOID,
        ]);

        $billedDate = fake()->dateTimeBetween('-1 year', 'now');
        $paidDate = null;

        if ($status === Invoice::STATUS_PAID) {
            $paidDate = fake()->dateTimeBetween($billedDate, 'now');
        }

        return [
            'customer_id' => Customer::factory(),
            'amount' => fake()->numberBetween(100, 150000),
            'status' => $status,
            'billed_date' => $billedDate->format('Y-m-d'),
            'paid_date' => $paidDate?->format('Y-m-d'),
        ];
    }
}
