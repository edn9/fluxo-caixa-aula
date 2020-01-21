<?php

use Illuminate\Database\Seeder;

use App\Caixa;

class CaixasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'cod' => 1,
                'description' => 'Venda',
                'user_id' => 1
            ],
        ];

        foreach ($data as $caixa) {
            Caixa::create($caixa);
            echo "Caixa " . $caixa['description'] . " adicionado! \n";
        }
    }
}
