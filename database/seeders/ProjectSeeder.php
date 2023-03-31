<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Importazione Models:
use App\Models\Project;
use App\Models\Type;

//Importazione Helpers:
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 25; $i++) {
            $title = $faker->unique()->sentence(4);

            $typeId = null;
            if (rand(0, 1) == 1) {
                $typeId = Type::inRandomOrder()->first()->id; //associamo in modo random una tipologia ai progetti soltanto se il numero random è = ad 1, altrimenti viene riempita con NULL; (tanto ci serve per riempire la table)
            }

            Project::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $faker->paragraph(5),
                'link' => $faker->url(),
                'image' => $faker->image('public/storage', 640, 480, null, true), //genera img casuale e la salva nel percorso specificato, il primo valore(640) indica larghezza, il secondo l'altezza, il terzo la categoria(in questo caso casuale) e il quarto specifica se si vuole generare una miniatura
                'type_id' => $typeId 
            ]);
        }
    }
}
