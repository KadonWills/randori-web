<?php

namespace Database\Seeders;

use DateInterval;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Converter\Time\PhpTimeConverter;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();


        //users
    	foreach (range(1,10) as $index) {
        $gender = $faker->randomElement(['male', 'female']);
        $role = $faker->randomElement(['admin', 'student', 'teacher' , 'tutor']);

            DB::table('users')->insert([
                'firstname' => $faker->firstname($gender),
                'lastname' => $faker->lastname($gender),
                'email' => $faker->email,
                'username' => $faker->username,
                'gender' => $gender,
                'phone' => $faker->phoneNumber,
                'password' => $faker->password,
                'role' => $role,
                'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'resetPasswordHash' => Hash::make('randori'),
                'verified' => true
            ]);
    }


    //Courses offered
    foreach (range(1,7) as $i) {
        DB::table('courses')->insert([
            'title' => $faker->word(),
            'description' => $faker->text,
            'is_available' => $faker->randomElement([True, False]),
        ]);
    }

    //Scheduled Courses
    foreach (range(1,20) as $i) {
        $start_date_space = $faker->randomElement(['24:0:0','72:0:3600','0:0:60','48:0:30', '0:0:1280']);
        $end_date_space =  $faker->randomElement(['72:0:0','0:0:3600','0:0:60','0:0:30', '0:0:0']);
        DB::table('course_events')->insert([
            'space' => $faker->numerify('##'),
            'capacity' => $faker->numerify('##'),
            'description' => $faker->jobTitle(),
            'course_offer_id' => $faker->randomElement(range(1,7)),
            'user_id' => $faker->randomElement(range(1,3)),
            'start_time' =>date('c', strtotime( $start_date_space)) ,
            'end_time' =>date('c' ,strtotime(  $faker->randomElement([ null, $end_date_space, $start_date_space ])) ) ,
        ]);
    }



}
}
