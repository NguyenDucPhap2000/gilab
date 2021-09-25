<?php

namespace Database\Seeders;

use App\Models\article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'dateofbirth' => Date('2000/12/12'),
        //     'account' => Str::random(10),
        //     'password' => Hash::make('password'),
        //     'email' => Str::random(10).'@gmail.com',
        //     'email_verified_at' => Date('2000/12/12'),
        // ]);
        for($i=0; $i < 200; $i++){
            $article = new article();
            $article->UserName = "Nguyen " .$i;
            $article->title = "Title " .$i;
            $article->userID = $i;
            $article->content = "Content " .$i;
            $article->save(); 
        }
    }
}
