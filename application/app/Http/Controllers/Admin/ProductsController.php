<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = ProductCategory::all();
        $query = Product::query();
        $productCategory = $request->get('product_category', 'all');
        $name = $request->get('name', null);
        $price = $request->get('price', null);
        $priceCompare = $request->get('price_compare', 'gteq');
        $sort = $request->get('sort', 'id-asc');
        $pageUnit = $request->get('page_unit', 10);

        switch ($sort){
            case 'id-asc':
                $query = $query->orderBy('id', 'ASC');
                break;
            case 'id-desc':
                $query = $query->orderBy('id', 'DESC');
                break;
            case 'product-category-asc':
                $query = $query
                    ->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                    ->select('products.*')
                    ->orderBy('product_categories.name', 'ASC');
                break;
            case 'product-category-desc':
                $query = $query
                    ->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                    ->select('products.*')
                    ->orderBy('product_categories.name', 'DESC');
                break;
            case 'name-asc':
                $query = $query->orderBy('name', 'ASC');
                break;
            case 'name-desc':
                $query = $query->orderBy('name', 'DESC');
                break;
            case 'price-asc':
                $query = $query->orderBy('price', 'ASC');
                break;
            case 'price-desc':
                $query = $query->orderBy('price', 'DESC');
                break;
        }

        if ($name != null) {
            $query->where('name','like',"%$name%");
        }

        if ($productCategory != "all") {
            $query = $query->where('product_category_id', $productCategory);
        }

        if ($price != null) {
            if ($priceCompare == 'gteq') {
                $query->where('price', '>=', $price);
            } elseif ($priceCompare == 'lteq'){
                $query->where('price', '<=', $price);
            }
        }

        $products = $query->paginate($pageUnit);

        return view('admin.products.index',
            compact('categories','products','productCategory', 'name', 'price', 'priceCompare', 'sort', 'pageUnit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];

        $message = [
            'name.required' => 'nameは、必ず指定してください。',
            'price.required' => 'priceは、必ず指定してください。'
        ];

        $validation = \Validator::make($inputs, $rules, $message);

        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $product = new Product();
        $product->product_category_id = $request->product_category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->file('image_path')!=NULL) {
            $product->image_path = $request->file('image_path')->store(''); 
        } else {
            $product->image_path = NULL;
        }
        $product->save();
        return redirect("http://localhost/admin/products/$product->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.products.edit',
            compact('product', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $inputs = $request->all();

        $rules = [
            'name' => 'required',
            'price' => 'required'
        ];

        $message = [
            'name.required' => 'nameは、必ず指定してください。',
            'price.required' => 'priceは、必ず指定してください。'
        ];

        $validation = \Validator::make($inputs, $rules, $message);

        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $product->product_category_id = $request->product_category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->delete_image == "1") {
            $product->image_path = null;
        } elseif ($request->image_path != null) {
            $product->image_path = $request->file('image_path')->store('');
        }
        $product->update();
        return redirect("http://localhost/admin/products/$product->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect("http://localhost/admin/products");
    }
}