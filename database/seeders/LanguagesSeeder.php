<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codes = ['en' => 'English', 'es' => 'Spanish', ];

        foreach ($codes as $key => $value) {
            Language::create([
                'code' => $key,
                'name' => $value
            ]);
        }
    }
}
