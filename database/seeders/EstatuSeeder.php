<?php

namespace Database\Seeders;

use App\Models\Estatu;
use Illuminate\Database\Seeder;
//use Spatie\Permission\Models\Role;

class EstatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estatu::create([
            'nombre_estatus' => 'No Iniciado'  
        ]);

        Estatu::create([
            'nombre_estatus' => 'En Proceso'  
        ]);

        Estatu::create([
            'nombre_estatus' => 'Culminado'  
        ]);

        

        
        
    }
}