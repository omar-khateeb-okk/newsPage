<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index($categoryId = null)
    {
        $categories = Category::whereNull('deleted_at')->where('navbar', '1')->get();

        if($categoryId == null){
            $categoryId =  Category::whereNull('deleted_at')->where('navbar', '1')->first()->id;
        }

      $posts = Post::where('category_id',$categoryId)
            ->whereNull('deleted_at')
            ->with(['category', 'tag'])
            ->get();
        return view('frontend.main', ['categories' => $categories,'posts'=>$posts]);
    }

    public function getPostByTag($tagId)
    {
        $categories = Category::whereNull('deleted_at')->where('navbar', '1')->get();

         $posts = Post::whereHas('tags', function ($query) use ($tagId) {
                $query->where('tag_id', $tagId);
            })
           ->with(['tag','category'])
            ->get();

        return view('frontend.main', ['categories' => $categories,'posts'=>$posts]);
    }

    public function logout(){
    Auth::logout();
    return redirect('/');
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('frontend.show',compact('post'));
    }

}
