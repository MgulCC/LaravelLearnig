<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //se va a llamar al fatory de user creando 10 elementos
        //User::factory(10)->create();

        

        $this->call([
            AlumnoSeeder::class,
            PostSeeder::class,
        ]);
    }
}
