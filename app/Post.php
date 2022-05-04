<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
  protected $fillable=[
    'title',
    'slug',
    'content',
    'published_at'
  ];

  public static function getUniqueSlug($title){
    $slug = Str::slug($title);
    $slugTmp = $slug; //variabile temporanea 
    $counter = 1; //contatore
    $dbSlug = Post::where('slug',$slug)->first();//cerco se presente slug creato
    
    while( $dbSlug ){ //cicla se trovi slug nel db
        $slug = $slugTmp .'-' .$counter;
        $counter++;    
        $dbSlug = Post::where('slug',$slug)->first();
    }

    return $slug;
  }

  public function category(){
    return $this->belongsTo('App\Category');
  }
}
