<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transfer_bank_name' => fake()->randomElement(['BCA', 'Mandiri', 'BNI', 'BRI']),
            'account_holder_name' => fake()->name(),
            'proof_file_path' => 'payments/test-proof.jpg',
        ];
    }
}
