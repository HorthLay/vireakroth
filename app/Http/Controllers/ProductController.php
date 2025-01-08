<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

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




    public function showByCategory($name)
    {
        $selectedCategory = Category::where('name', $name)->first();
        $categories = Category::all();


        if ($selectedCategory) {
            // Corrected the method chain and placement of paginate
            $products = Product::where('category_id', $selectedCategory->id)->paginate(5);
        } else {
            $products = collect(); // Empty collection
        }

        return view('products.categoryview', compact('products', 'selectedCategory', 'categories', 'name'));
    }






    public function index(Request $request)
    {
        // Get all categories (for the filter)
        $categories = Category::all();

        // If a category is selected, filter products by that category
        if ($request->has('category') && $request->category != null) {
            $categoryFilter = $request->category;
            $products = Product::where('category_id', $categoryFilter)->paginate(12);
        } else {
            // If no category is selected, display all products
            $categoryFilter = null;
            $products = Product::paginate(10);
        }

        return view('home.viewproduct', compact('products', 'categories', 'categoryFilter'));
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
