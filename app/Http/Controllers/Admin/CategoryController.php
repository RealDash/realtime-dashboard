<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function viewCategories(){
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function create(Request $request)
    {
        $validator = $this->validator($request->all())->validate();

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return back()->with('error', 'Something went wrong, try again.');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:categories',
        ]);
    }

}
