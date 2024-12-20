<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        $products = Product::paginate(5);
        $reminders = Reminder::where('status', true)->get();
        $categories = Category::all();
        return view('admin.product', compact('products', 'reminders', 'categories'));
    }





    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->discount = $request->discount;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function productdelete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }



    public function search(Request $request)
    {
        $searchKeyword = $request->input('searchKeyword');

        // Search products based on the keyword (adjust query as needed)
        $products = Product::where('name', 'LIKE', '%' . $searchKeyword . '%')
            ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
            ->get();

        // Return the search results to a view
        return view('home.search-results', compact('products', 'searchKeyword'));
    }

    public function viewproduct()
    {
        $product = Product::all();
        return view('home.viewproduct', compact('product'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedItems = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id) // Exclude the current product
            ->take(5) // Limit to 5 related items
            ->get();
        return view('home.productdetails', compact('product', 'relatedItems'));
    }
}
