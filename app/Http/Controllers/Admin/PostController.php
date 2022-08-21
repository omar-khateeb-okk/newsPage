<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CheckPostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with('category')->get();
//        dd($posts);
        return view('admin.post.index', ['posts' => $posts]);
    }

    public function getPostByTag($tagId)
    {
        $posts = (new Post())
            ->whereHas('tags', function ($query) use ($tagId) {
                $query->where('tag_id', $tagId);
            })
            ->get();
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        $tags = Tag::all();
        $category = Category::where('is_active', '1')->get();
        return view('admin.post.create', compact('category', 'tags'));
    }

    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'error name');
        }

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/', $filename);
            $data['img'] = $filename;
        }

        $post = Post::create($data);

        $this->insertPostTag($post->id, $request->get('tags_ids'));
        return redirect('admin/posts')->with(
            'message',
            'Post Added Successfully'
        );
    }

    public function insertPostTag($postId, $tagIds)
    {
        $postTag = [];
        foreach (explode(' ', $tagIds) as $t) {
            $temp['tag_id'] = (int) $t;
            $temp['post_id'] = $postId;
            $temp['created_at'] = Carbon::now();
            $temp['updated_at'] = Carbon::now();
            array_push($postTag, $temp);
        }
        PostTag::insert($postTag);
        return true;
    }

    public function edit($postId)
    {
        $tags = Tag::all();
        $category = Category::where('is_active', '1')->get();
        $post = Post::find($postId);
        return view('admin.post.edit', compact('post', 'category', 'tags'));
    }

    public function update(UpdatePostRequest $request, $postId)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        unset($data['post_id']);
        unset($data['img']);

        if ($request->validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'error name');
        }

        $post = Post::find($postId);
        if ($request->hasfile('img')) {
            if (!empty($post)) {
                $destination = 'uploads/post/'.$post->img;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/', $filename);
            $data['img'] = $filename;
        }

        $updated = Post::where('id', $postId)->update($data);

        return redirect('admin/posts')->with(
            'message',
            'Post Updated Successfully'
        );
    }
    public function destroy(CheckPostRequest $request)
    {
        $data = $request->validated();
        $post = Post::find($data['post_id']);
        $post->delete();
        return redirect('admin/posts')->with(
            'message',
            'Post Deleted Successfully'
        );
    }


}
