<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake = Fake::create("pt_BR");
        foreach(range(1,5) as $index){
            BD::table('aluno')->insert(
                ['nome'=>$fake->name,
                'data_nascimento'=>$fake->date,
                'email'=>$fake->email,
                'cpf'=>$fake->name,
                'telefone'=>$fake->phoneNumber,
            ]);
        }
    }
}
