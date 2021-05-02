<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\Video;
use App\Tag;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/create' , function(){

    $post = Post::create(['name' => 'first post']);

    $tag1 = Tag::find(1);

    $post->tags()->save($tag1);

    $video = Video::create(['name'=>'my first video']);

    $tag2 = Tag::find(2);

    $video->tags()->save($tag2);

});

Route::get('/read',function(){

   
//here we are reading the tag name from the post 
//1.) firstly we have found the post by it's id
//2.) then in for loop it is searching for the taggable table and checking the respective tag_id for tags.
//3.) after that we are able to reach the tag table and return the tag name
    $post = Post::findOrFail(3);

    foreach($post->tags as $tag){

        echo $tag;

    }

});

Route::get('/update',function(){

        // $post = Post::findOrFail(3);
    
        // foreach($post->tags as $tag){
    
        //     return $tag->whereName('up php')->update(['name'=>'php']);
    
        // }


//playing with taggable table
        $post = Post::find(3);

        $tag = Tag::find(3);

        // $post->tags()->save($tag);

        // $post->tags()->attach($tag);

        $post->tags()->sync([1,2]);

    
    });


    Route::get('/delete',function(){

        $post = Post::find(3);//finding post

        foreach($post->tags as $tag){

            $tag->whereId(1)->delete();//finding tag from taggable table which is related to the above post no. and deleteing it from tag's table

        }

    });