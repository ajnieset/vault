<?php

namespace Database\Factories;

use App\Models\Vault;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vault::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner' => $this->faker->name,
            'totalValue' => 0.0,
            'cash' => 0.0,
            'digital' => 0.0,
            'currentCurrency' => 'US Dollars',
            'currencyCode' => 'USD',
        ];
    }
}
