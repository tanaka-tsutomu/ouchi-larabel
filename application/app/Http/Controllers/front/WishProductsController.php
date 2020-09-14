<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Hash;

class WishProductsController extends Controller
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

        return view('front.products.wish',
            compact('categories','products','productCategory', 'name', 'price', 'priceCompare', 'sort', 'pageUnit'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show(Product $product, Request $request)
    {
        $categories = ProductCategory::all();
        $query = Product::query();
        $productCategory = $request->get('product_category', 'all');
        $name = $request->get('name', null);
        $price = $request->get('price', null);
        $priceCompare = $request->get('price_compare', 'gteq');
        $sort = $request->get('sort', 'id-asc');
        $pageUnit = $request->get('page_unit', 10);

        return view('front.products.show', ['product' => $product],
            compact('categories','productCategory', 'name', 'price', 'priceCompare', 'sort', 'pageUnit'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('front.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return redirect("http://localhost/products/$product->id");
    }
}