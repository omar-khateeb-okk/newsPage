<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CheckCategoryRequest;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }
    //    public function post_category(category_id)
    //    {
    //        $category =Category::all()
    //        return view('admin.category.index',compact('category'));
    //
    //    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->validator && $request->validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'error name');
        }

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $data['img'] = $filename;
        }
        $created = Category::create($data);
        if (empty($created)) {
            return 'Operation Fail';
        }

        return redirect('admin/category')->with(
            'message',
            'category Added Successfully'
        );
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $category_id)
    {
        $data = $request->validated();
        unset($data['category_id']);

        if ($request->validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'error name');
        }

        $category = Category::find($category_id);

        if ($request->hasFile('img')) {
            if (!empty($category)) {
                $destination = 'uploads/category/' . $category->img;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $data['img'] = $filename;
        }

        $updated = Category::where('id', $category_id)->update($data);

        return redirect('admin/category')->with(
            'message',
            'category updated Successfully'
        );
    }
    public function destroy(CheckCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'error name');
        }

        $category = Category::find($data['category_id']);
        if (!empty($category)) {
            $category->delete();
            return redirect('admin/category')->with(
                'message',
                'category Deleted Successfully'
            );
        } else {
            return redirect('admin/category')->with(
                'message',
                'No Category Id Found'
            );
        }
    }
}
