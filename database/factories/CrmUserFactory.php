<?php

namespace Database\Factories;

use App\Models\CrmUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrmUserFactory extends Factory
{
    protected $model = CrmUser::class;

    public function definition()
    {
        $departments = ['IT', 'HR', 'Finance', 'Sales', 'Marketing'];
        $cities = ['Mumbai', 'Delhi', 'Pune', 'Belgaum', 'Bangalore'];

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(20, 60),
            'department' => $this->faker->randomElement($departments),
            'city' => $this->faker->randomElement($cities),
        ];
    }
}
