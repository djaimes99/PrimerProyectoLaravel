<?php

namespace Database\Factories;

use App\Models\Gerencia;
use Illuminate\Database\Eloquent\Factories\Factory;


class GerenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gerencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(),//oracion una sola linea
            //'nombre2' => $this->faker->paragraph(),//parrafo mas de una linea
            //'categoria' => $this->faker->randomElement(['Desarrollo Web','Diseño Web']),
            'id_usuario_enc' => $this->faker->randomNumber(1)
        ];
    }
}