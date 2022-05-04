<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Antipasto','Primo','Secondo','Dolce'];

        foreach($categories as $name){
            $category = new Category();
            $category->name = $name;
            $category->slug = Str::slug($name);
            $category->save();

        }

    }
}
