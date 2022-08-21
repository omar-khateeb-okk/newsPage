<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\CheckTagRequest;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tag = tag::all();
        return view('admin.tag.index', compact('tag'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(CreateTagRequest $request)
    {
        $data = $request->validated();

        if ($request->validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'error name');
        }

        $created = Tag::create($data);
        if (empty($created)) {
            return 'Operation Fail';
        }

        return redirect('admin/tag')->with('message', 'tag Added Successfully');
    }

    public function edit($tag_id, Request $request)
    {
        if (empty($tag_id)) {
            return redirect()
                ->back()
                ->with('error', 'error id');
        }
        $tag = Tag::where('id', $tag_id)->first();
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, $tag_id)
    {
        $data = $request->validated();
        unset($data['tag_id']);

        if ($request->validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'error name');
        }

        Tag::where('id', $tag_id)->update($data);
        return redirect('admin/tag')->with(
            'message',
            'tag updated Successfully'
        );
    }

    public function destroy(CheckTagRequest $request)
    {
        $data = $request->validated();
        $tag = tag::find($data['tag_id']);
        if ($tag) {
            $tag->delete();
            return redirect('admin/tag')->with(
                'message',
                'tag Deleted Successfully'
            );
        } else {
            return redirect('admin/category')->with(
                'message',
                'No Category Id Found'
            );
        }
    }
}
