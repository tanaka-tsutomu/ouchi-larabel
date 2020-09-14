<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        return view('front.user.index',
            compact('categories','productCategory', 'name', 'price', 'priceCompare', 'sort', 'pageUnit'));
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $inputs = $request->all();

        $rules = [
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'password_confirmation' => 'same:password'
        ];

        $message = [
            'name.required' => 'nameは、必ず指定してください。',
            'email.required' => 'emailは、必ず指定してください。',
            'email.email' => 'emailは、有効なメールアドレス形式で指定してください。',
            'password.required' => 'passwordは、必ず指定してください。',
            'password_confirmation.same' => 'passwordとpassword確認が一致しません。'
        ];

        $validation = \Validator::make($inputs, $rules, $message);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation->errors())
                ->withInput();
        }

        if ($request->delete_image == "1") {
            $user->image_path = null;
        } elseif ($request->image_path != null) {
            $user->image_path = $request->file('image_path')->store('');
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect("http://localhost/admin/users/$user->id");
    }
    
}