<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        # Je génère un faux titre
        $name = $this->faker->unique()->sentence;

        return [
            'name' => $name,
            'alias' => Str::slug($name) # Génération de l'alias à partir du titre
        ];
    }
}
