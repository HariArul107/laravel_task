<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use App\Models\loginuser;
use App\Models\category;
use App\Models\item;
use App\Models\Purchase;

class ListController extends Controller
{
    public function showcategory()
    {
        $categories = category::where('user_id', session('user_id'))->get();
        return view('categories', compact('categories'));
    }

    public function showaddcategory()
    {
        return view('categoryform');
    }

    public function addcategory(Request $request)
    {

        $userId = session('user_id');
        $request->validate([
            'category_name' => [
                'required',
                Rule::unique('categories')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                })
            ],
            'description' => 'required'
        ]);

        category::create([
            'category_name' => $request->category_name,
            'category_description' => $request->description,
            'user_id' => session('user_id')  // taking from session
        ]);

        return redirect('/category')->with('success', 'Category Added Successfully!');
    }

    public function showpage()
    {
        $items = item::where('user_id', session('user_id'))->get();
        return view('list_item', compact('items'));
    }

    public function additem()
    {
        $userId = session('user_id');
        $categories = category::where('user_id', $userId)->get();
        return view('additem', compact('categories'));
    }

    public function adddata(Request $request)
    {

        $categoryname = $request->input('c_name');
        $category = category::where('category_name', $categoryname)->first();
        $categoryid = $category->category_id;

        $userId = session('user_id');
        $request->validate([
            'c_name' => ['required', 'not_in:disabled'],
            'item_name' => [
                'required',
                Rule::unique('items')->where(function ($query) use ($categoryname, $userId) {
                    return $query->where('category_name', $categoryname)
                        ->where('user_id', $userId);
                })
            ],
            'prize' => 'required|numeric',
        ], [
            'c_name.not_in' => 'Please select a valid category.',
        ]);


        item::create([
            'item_name' => $request->item_name,
            'category_name' => $request->c_name,
            'prize' => $request->prize,
            'user_id' => $userId,
            'category_id' => $categoryid
        ]);
        return redirect('/item')->with('success', 'Category Added Successfully!');
    }

    public function editcategory(Request $request, $id)
    {

        $userId = session('user_id');
        $category = category::where('category_id', $id)
            ->where('user_id', $userId)   // security check
            ->firstOrFail();

        $editable = $request->has('edit');

        return view('edit_category', compact('category', 'editable'));
    }

    public function updatecategory(Request $request, $id)
    {
        $userId = session('user_id');

        $request->validate([
            'category_name' => [
                'required',
                Rule::unique('categories')
                    ->where(function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })->ignore($id, 'category_id'),
            ],
            'description' => 'required'
        ]);

        category::where('category_id', $id)
            ->where('user_id', $userId)
            ->update([
                'category_name' => $request->category_name,
                'category_description' => $request->description
            ]);

        return redirect('/category')->with('success', 'Category Updated Successfully!');
    }

    public function deletecategory($id)
    {
        $userId = session('user_id');

        // Ensure user can delete only their own categories
        $category = category::where('category_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $itemCount = item::where('category_id', $id)->count();

        if ($itemCount > 0) {
            return redirect()->back()
                ->with('success', 'Cannot delete this category because items are associated with it.');
        }

        $category->delete();

        return redirect('/category')->with('success', 'Category Deleted Successfully!');
    }

    public function edititem(Request $request, $id)
    {
        $userId = session('user_id');

        $categories = category::where('user_id', $userId)->get();


        $item = item::where('item_id', $id)
            ->where('user_id', $userId)   // security check
            ->firstOrFail();
        $editable = $request->has('edit');


        return view('edit_item', compact('item'), compact('categories','editable'));
    }
    //updateitem

    public function updateitem(Request $request, $id)
    {
        $categoryname = $request->input('c_name');
        $category = category::where('category_name', $categoryname)->first();
        $categoryid = $category->category_id;

        $userId = session('user_id');
        $request->validate([
            'c_name' => ['required', 'not_in:disabled'],
            'item_name' => [
                'required',
                Rule::unique('items')->where(function ($query) use ($categoryname, $userId) {
                    return $query->where('category_name', $categoryname)
                        ->where('user_id', $userId);
                })->ignore($id, 'item_id')
            ],
            'prize' => 'required|numeric',
        ], [
            'c_name.not_in' => 'Please select a valid category.',
        ]);

        item::where('item_id', $id)
            ->where('user_id', $userId)
            ->update([
                'item_name' => $request->item_name,
                'category_name' => $request->c_name,
                'prize' => $request->prize,
                'user_id' => $userId,
                'category_id' => $categoryid
            ]);

        return redirect('/item')->with('success', 'Category Updated Successfully!');
    }

    public function deleteitem($id)
    {
        $userId = session('user_id');
        $items = item::where('item_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();


        $purchaseCount = Purchase::where('item_id', $id)->count();

        if ($purchaseCount > 0) {
            return redirect()->back()
                ->with('success', 'Cannot delete this item because purchase are associated with it.');
        }

        $items->delete();
        return redirect('/item')->with('success', 'item Deleted Successfully!');
    }
}
