<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projetos')->insert([
            'matriz_tcc' => 'Arquivo',
            'tema'=> 'TCC',
            'descricao'=> 'trabalho',
            'termo_compromisso'=> 'xxxx',
            'statusProjeto'=> 'Concluido',
            'data_termino'=> '2024-04-06',
            
        ]);
    }
}
