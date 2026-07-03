<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Musik', 'icon_class' => 'music', 'description' => 'Belajar alat musik, vokal, dan teori musik'],
            ['name' => 'Fotografi', 'icon_class' => 'camera', 'description' => 'Teknik fotografi, editing, dan komposisi visual'],
            ['name' => 'Kuliner', 'icon_class' => 'utensils-crossed', 'description' => 'Memasak, baking, dan seni kuliner'],
            ['name' => 'Seni Rupa', 'icon_class' => 'palette', 'description' => 'Lukis, sketsa, kaligrafi, dan seni visual'],
            ['name' => 'IT & Teknologi', 'icon_class' => 'laptop', 'description' => 'Pemrograman, desain grafis, dan teknologi digital'],
            ['name' => 'Kerajinan Tangan', 'icon_class' => 'scissors', 'description' => 'Handmade, crafting, dan DIY projects'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
