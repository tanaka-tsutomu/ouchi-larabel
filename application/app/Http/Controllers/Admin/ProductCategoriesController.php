<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductCategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ProductCategory::query();
        $name = $request->get('name', null);
        $sort = $request->get('sort', 'id-asc');
        $pageUnit = $request->get('page_unit', 10);

        switch ($sort) {
            case 'id-asc':
                $query = $query->orderBy('id', 'ASC');
                break;
            case 'id-desc':
                $query = $query->orderBy('id', 'DESC');
                break;
            case 'name-asc':
                $query = $query->orderBy('name', 'ASC');
                break;
            case 'name-desc':
                $query = $query->orderBy('name', 'DESC');
                break;
            case 'order-no-asc':
                $query = $query->orderBy('order_no', 'ASC');
                break;
            case 'order-no-desc':
                $query = $query->orderBy('order_no', 'DESC');
                break;
        }

        if ($name != null) {
            $query->where('name', 'like', "%$name%");
        }

        if ($pageUnit != null) {
            $ProductCategories = $query->paginate($pageUnit);
        }

        return view('admin.product_categories.index', compact('ProductCategories', 'name', 'sort', 'pageUnit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $rules = [
            'name' => 'required',
            'order_no' => 'required'
        ];

        $message = [
            'name.required' => 'nameは、必ず指定してください。',
            'order_no.required' => 'order noは、必ず指定してください。'
        ];

        $validation = \Validator::make($inputs, $rules, $message);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation->errors())
                ->withInput();
        }

        $productCategory = new ProductCategory();
        $productCategory->name = $request->name;
        $productCategory->order_no = $request->order_no;
        $productCategory->save();

        return redirect("http://localhost/admin/product_categories/$productCategory->id");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productCategory = ProductCategory::find($id);
        $products = Product::all();
        return view('admin.product_categories.show', [
            'productCategory' => $productCategory,
            compact('products')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product_categories.edit', [
            'productCategory' => $productCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $inputs = $request->all();
        $rules = [
            'name' => 'required',
            'order_no' => 'required'
        ];
        $message = [
            'name.required' => 'nameは、必ず指定してください。',
            'order_no.required' => 'order noは、必ず指定してください。'
        ];
        $validation = \Validator::make($inputs, $rules, $message);
        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation->errors())
                ->withInput();
        }
        $productCategory->name=$request->name;
        $productCategory->order_no=$request->order_no;
        $productCategory->update();
        return redirect("http://localhost/admin/product_categories/$productCategory->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::find($id)->delete();
        return redirect("http://localhost/admin/product_categories");
    }
}