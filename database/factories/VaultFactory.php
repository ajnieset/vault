<?php

namespace Database\Factories;

use App\Models\Vault;
use Illuminate\Support\Str;
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
        $name = $this->faker->name;
        list($first, $last) = explode(' ', $name);
        $username = Str::lower($first[0].$last);

        return [
            'owner' => $name,
            'username' => $username,
            'totalValue' => $cash + $digital,
            'cashValue' => $cash,
            'digitalValue' => $digital,
            'currentCurrency' => 'US Dollars',
            'currencyCode' => 'USD',
        ];
    }
}
