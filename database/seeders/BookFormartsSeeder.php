<?php

namespace Database\Seeders;

use App\Models\Books\BookFormat;
use Illuminate\Database\Seeder;

class BookFormartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formats = ['Paper', 'eBook', 'Magazine', 'Other'];

        foreach ($formats as $format) {
            
            BookFormat::create([
                'type' => $format
            ]);
        }
    }
}
