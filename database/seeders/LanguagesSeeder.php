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
        $codes = ['es', 'en'];

        foreach ($codes as $code) {
            Language::create([
                'code' => $code,
            ]);
        }
    }
}
