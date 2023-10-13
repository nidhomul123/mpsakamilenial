<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'user_id'       => 1,
            'favicon'       => null,
            'logo'          => null,
            'name'          => 'Media Pembelajaran Saka Milenial',
            'short_name'    => 'MP Saka Milenial',
            'Description'   => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora obcaecati, hic dolorem sed nihil nobis earum nemo. Ullam, explicabo eaque dolore ipsam excepturi non, qui mollitia, odio veritatis in eveniet!"
        ]);
    }
}
