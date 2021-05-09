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
            'nisn' => $this->faker->numerify('###############'),
            'name' => $this->faker->name,
            // 'address' => $this->faker->address,
            'birth_place' => $this->faker->city,
            'birth_date' => $this->faker->date(),
            'religion' => $this->faker->randomElement($array = array('Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu')),
            'gender' => $this->faker->randomElement($array = array("L","P")),
            'father_name' => $this->faker->name,
            // 'father_phone' => $this->faker->numerify('###############'),
            // 'mother_name' => $this->faker->name,
            // 'mother_phone' => $this->faker->numerify('###############'),
            'school_id' => $this->faker->numberBetween(1,10),
            'school_year' => "2020/2021",
            // 'entry_year' => $this->faker->year(),
            'graduated_year' => $this->faker->year(),
        ];
    }
}
