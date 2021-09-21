<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(50),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'units' => $this->faker->randomFloat(0, 10, 100),
            'category_id' => $this->faker->randomElement(\DB::table('categories')->pluck('id'))
        ];
    }
}
