<?php

namespace Database\Factories;

use App\Models\Parameter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parameter>
 */
class ParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Parameter::class;

    public function definition(): array
    {
        return [
            'title' => \Illuminate\Support\Str::random(5),
            'type' => rand(1,2)
        ];
    }
}
