<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = date('Y-m-d H:i:s');
        Marca::insert(
            [
                [ 'mkNombre'=>'Nikon', 'created_at'=>$time ],
                [ 'mkNombre'=>'Apple', 'created_at'=>$time ],
                [ 'mkNombre'=>'Audiotechnica', 'created_at'=>$time ],
                [ 'mkNombre'=>'Marshall', 'created_at'=>$time ],
                [ 'mkNombre'=>'Samsung', 'created_at'=>$time ],
                [ 'mkNombre'=>'Huawei', 'created_at'=>$time ]
            ]
        );
    }
}
