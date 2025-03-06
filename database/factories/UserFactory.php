<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;


class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'login_id' => $this->faker->unique()->ean8,
            'username' => $this->faker->userName,
            'password' => Hash::make('12345678'),
            'email' => $this->faker->unique()->safeEmail,
            'role_id' => Role::inRandomOrder()->first()?->id,

        ];
    }
}

// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
//  */
// class UserFactory extends Factory
// {
//     /**
//      * The current password being used by the factory.
//      */
//     //     protected static ?string $password;

//     //     /**
//     //      * Define the model's default state.
//     //      *
//     //      * @return array<string, mixed>
//     //      */
//     //     public function definition(): array
//     //     {
//     //         return [
//     //             'name' => fake()->name(),
//     //             'email' => fake()->unique()->safeEmail(),
//     //             'email_verified_at' => now(),
//     //             'password' => static::$password ??= Hash::make('password'),
//     //             'remember_token' => Str::random(10),
//     //         ];
//     //     }

//     //     /**
//     //      * Indicate that the model's email address should be unverified.
//     //      */
//     //     public function unverified(): static
//     //     {
//     //         return $this->state(fn (array $attributes) => [
//     //             'email_verified_at' => null,
//     //         ]);
//     //     }
// }
