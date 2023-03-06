<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\Helpers\ImageStore;
use App\Models\Gallery;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        $data = ['products' => $products];
        return view('products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $data = ['users' => $users];
        return view('products.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'slug' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('products/create')
                ->withErrors($validator)
                ->withInput();
        }

        Product::create([
            "title"         => $request->get('title'),
            "slug"          => $request->get('slug'),
            "image"         => $request->get('image'),
            "category_id"   => $request->get('category_id'),
            "description"   => $request->get('description'),
            "user_id"       => $request->get('user_id')
        ]);

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::FindOrFail($id);
        $data = ['product' => $product];

        return view('products.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::FindOrFail($id);
        $users = User::all();
        $data = ['product' => $product, 'users' => $users];

        return view('products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'slug' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('products/'. $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }


        $product = Product::FindOrFail($id);
        $product->fill($request->all())->save();

        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::FindOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }

    public function gallery($id)
    {
        $product = Product::where('id', '=',  $id)->first();
        $data = ['product' => $product];

        return view('products.gallery')->with($data);
    }

    public function storeImage(Request $request, $id)
    {
        $image = new ImageStore($request, 'gallery');
        $image = $image->imageStore();
        Gallery::create([
            'product_id'     => $id,
            'image'          => $image
        ]);
        return redirect()->route('products.index');
    }


}
