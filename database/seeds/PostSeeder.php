<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for( $i=0; $i<100; $i++ ){
            $post = new Post;
            $post->title = $faker->words(5,true);
            $post->slug = Str::slug($post->title); //metodo statico della classe stringa per concatenare '-' tra le parole
            $post->content = $faker->paragraphs(10, true);
            $post->published_at = $faker->randomElement([ null, $faker->dateTime() ]);
            $post->save();
        }
    }
}
