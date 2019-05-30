<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UsersTableSeeder::class);
      // $userId = DB::table('users')->insert([
      //   'name' => 'admin',
      //   'last_name' => 'admin',
      //   'civilite' => 'Mr',
      //   'email' => "admin@admin.com",
      //   'password' => bcrypt('abc123'),
      //   'created_at' => date('Y-m-d H:i'),
      // ]);
      $faker = Faker::create();
      for ($i = 1; $i<=50; $i++) {
          $userId = DB::table('role_user')->insert([
            'user_id' => $i,
            'role_id' => 2,
          ]);
      //   $userId = DB::table('users')->insert([
      //     'name' => $faker->name,
      //     'last_name' => $faker->name,
      //     'civilite' => 'Mr',
      //     'email' => $faker->email,
      //     'password' => bcrypt('abc123'),
      //     'created_at' => date('Y-m-d H:i'),
      //   ]);
      //   $coursId = DB::table('cours')->insert([
      //     'titre'            => $faker->name,
      //     'user_id'          => $userId,
      //     'devise'           => 'DH',
      //     'prix'             => $faker->numberBetween(1000, 10000),
      //     'duree'            => $faker->numberBetween(10, 30),
      //     'photo'            => $faker->imageUrl(400, 480)
      //   ]);
      //   $prestataireId = DB::table('prestataires')->insert([
      //     'nom'            => $faker->name,
      //     'type'           => $faker->word,
      //     'specialite'      => $faker->word,
      //     'tel'             => $faker->phoneNumber,
      //     'fax'             => $faker->phoneNumber,
      //     'email'           => $faker->email,
      //   ]);
      //   $formateurId = DB::table('formateurs')->insert([
      //     'nom'            => $faker->name,
      //     'type'           => 'Interne',
      //     'email'          => $faker->email,
      //   ]);
      //   $salleId = DB::table('salles')->insert([
      //     'numero'         => $faker->numberBetween(1, 30),
      //     'capacite'       => $faker->numberBetween(10, 50),
      //   ]);


      //   // $sessionId = DB::table('sessions')->insert([
      //   //   'nom'            => $faker->name,
      //   //   'cour_id'           => $coursId,
      //   //   'formateur_id'      => $formateurId,
      //   //   'lieu'           => $faker->city,
      //   //   'start'          => $faker->dateTimeBetween("now", "30 days"),
      //   //   'end'            => $faker->dateTimeBetween("now", "30 days"),
      //   //   'methode'        => 'Salle de classe',
      //   //   'statut'         => 'Programmé',
      //   //   'salle_id'          => $salleId,
      //   // ]);

      }
    }
}
