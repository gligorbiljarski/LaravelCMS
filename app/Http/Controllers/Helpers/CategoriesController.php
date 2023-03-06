<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\ImageStore;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::getTree();
        $data = ['categories' => $categories];
        return view('categories.index')->with($data);
    }

    public function create()
    {
        $categories = Categories::getList();
        $data = ['categories' => $categories];
        return view('categories.create')->with($data);
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $parent_id = $request->get('parent_id');
        $image = $request->get('image');
        $desc = $request->get('desc');
        $slug = Str::slug($request->get('name'));


        $imageObj = new ImageStore($request, 'categories');
        $image = $imageObj->imageStore();


        if (!isset($parent_id)) {
            $data = [
                'name' => $name,
                'image' => $image,
                'desc' => $desc,
                'slug' => $slug
            ];
            Categories::create($data);
            Session::flash('flash_message', 'Category successfully added!');
            return redirect()->back();
        }

        $category = Categories::FindOrFail($parent_id);

        Categories::create(['name' => $name, 'image' => $image, 'desc' => $desc, 'slug' => $slug], $category);
        Session::flash('flash_message', 'Category successfully added!');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $category = Categories::FindOrFail($id);
        $categories = Categories::getList();
        $data = ['category' => $category, 'categories' => $categories];
        return view('categories.edit')->with($data);
    }

    public function update(Request $request, $id)
    {

        $category = Categories::FindOrFail($id);

        $input = $request->all();


        if ($request->hasFile('image')) {
            $imageObj = new ImageStore($request, 'categories');
            $image = $imageObj->imageStore();
            $input['image'] = $image;
        }

        if ($request->has('name')) {
            $input['slug'] = Str::slug($request->get('name'));
        }

        $category->fill($input)->save();
        Session::flash('flash_message', 'Category successfully edited.');

        $categories = Categories::getTree();
        $data = ['categories' => $categories];
        return view('categories.index')->with($data);
    }

    public function destroy($id)
    {

        Categories::fixTree();
        $category = Categories::FindOrFail($id);

        $category->delete();
        $categories = Categories::all();
        $data = ['categories' => $categories];
        return redirect('admin/categories')->with($data);
    }


}

