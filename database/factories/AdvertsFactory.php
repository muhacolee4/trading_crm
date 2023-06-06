<?php

namespace Database\Factories;

use App\Models\Adverts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adverts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'nickname' => $this->faker->userName,
            'min_limit' => 100,
            'max_limit' => 300,
            'rate' => 500,
            'base' => 'USD',
            'quote' => 'KES',
            //'payment_methods' => 'Bank Transfer',
            'completion_rate' => "50%",
            'type' => 'BUY',
            'status' => 'active',
        ];
    }
}
