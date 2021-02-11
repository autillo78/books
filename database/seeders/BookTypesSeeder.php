<?php

namespace Database\Seeders;

use App\Models\BookType;
use Illuminate\Database\Seeder;

class BookTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['computing', 'novel', 'history', 'science', 'psychology'];

        foreach ($types as $type) {
            BookType::create([
                'type' => $type,
            ]);
        }
    }
}
