<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create()
            ->each(function ($user) {
                // Also create galleries for each user created
                Gallery::factory(rand(8, 10))->create([
                    'user_id' => $user->id
                ])
                    ->each(function ($gallery) {
                        $tags = Tag::all();
                        $tagIds = [];
                        foreach ($tags as $tag) {
                            array_push($tagIds, intval($tag->id));
                        }
                        shuffle($tagIds);
                        $tagIdsToAssign = array_slice($tagIds, 0, rand(0, count($tagIds)));

                        foreach ($tagIdsToAssign as $tagId) {
                            DB::table('gallery_tag')->insert(
                                [
                                    'gallery_id' => intval($gallery->id),
                                    'tag_id' => intval($tagId),
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]
                            );
                        }
                    });
            });
    }
}
