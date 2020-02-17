<?php

namespace Emeka\Database;

use Faker\Factory;
use Emeka\Http\Models\Customer;

class Seeder
{
    /**
     * This method create users schema.
     */
    public function handel($size)
    {
        $faker = Factory::create();

        $new_record = [];

        for ($i=0; $i < $size; $i++) {
            Customer::create([
                'email' => $faker->email,
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'phone_number' => $faker->phoneNumber,
                'image' => $faker->imageUrl,
                'location' => $faker->streetAddress,
                'sex' => rand(0, 1) ? "Male" : "Female",
            ]);
        }

        return $size . " new Record created in the database";
    }
}