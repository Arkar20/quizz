<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('12345'), // password
            'visible_password' => '1234', // password
            'occupation' => 'something', // password
            'address' => 'something something', // password
            'phone' => '0982398', 
            'is_admin' => 0, 
            'remember_password'=>null,
            'remember_token' => Str::random(10),
        ];
    }
}
