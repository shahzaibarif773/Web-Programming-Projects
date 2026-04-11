<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class CustomerInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()
            ->count(250)
            ->create()
            ->each(function (Customer $customer): void {
                Invoice::factory()
                    ->count(random_int(1, 5))
                    ->for($customer)
                    ->create();
            });
    }
}
