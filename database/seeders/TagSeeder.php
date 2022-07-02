<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Szeged' => 'A napfény városa',
            'Pozsony' => 'Magyar koronázó város, magyar országgyűlés itt ülésezett egykor.',
            'Budapest' => 'Magyarország fővárosa',
            'Trakostyán' => 'horvátországi várkastély',
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'name' => $key,
                    'description' => $value
                ]
            );
            $tag->save();
        }
    }
}
