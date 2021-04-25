<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nis' => $this->faker->numerify('###############'),
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'birth_place' => $this->faker->city,
            'birth_date' => $this->faker->date(),
            'religion' => $this->faker->randomElement($array = array('Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu')),
            'gender' => $this->faker->randomElement($array = array("Laki-laki","Perempuan")),
            'level' => $this->faker->randomElement($array = array("sd","smp")),
            'father_name' => $this->faker->name,
            'father_phone' => $this->faker->numerify('###############'),
            'mother_name' => $this->faker->name,
            'mother_phone' => $this->faker->numerify('###############'),
            'school' => $this->faker->word,
            'entry_year' => $this->faker->year(),
            'graduated_year' => $this->faker->year(),
        ];
    }
}
