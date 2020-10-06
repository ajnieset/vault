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
        $cash = mt_rand(1, 10000) + (mt_rand() / mt_getrandmax());
        $digital = mt_rand(1, 10000) + (mt_rand() / mt_getrandmax());

        return [
            'owner' => $this->faker->name,
            'totalValue' => $cash + $digital,
            'cashValue' => $cash,
            'digitalValue' => $digital,
            'currentCurrency' => 'US Dollars',
            'currencyCode' => 'USD',
        ];
    }
}
