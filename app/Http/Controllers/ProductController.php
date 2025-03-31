<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
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
            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('products/' . $product->image))) {
                unlink(public_path('products/' . $product->image));
            }

            // Save the new image
            $image = $request->image;
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imagename);

            // Update the category's image path
            $product->image = $imagename;
        }
        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function productdelete($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Delete the image file if it exists
            if (File::exists(public_path('products/' . $product->image))) {
                File::delete(public_path('products/' . $product->image));
            }

            // Delete the category
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully.');
        }

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }



    public function search(Request $request)
    {
        $searchKeyword = $request->input('searchKeyword');

        // Search products based on the keyword (adjust query as needed)
        $products = Product::where('name', 'LIKE', '%' . $searchKeyword . '%')
            ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
            ->paginate(4);

        // Return the search results to a view
        return view('home.search-results', compact('products', 'searchKeyword'));
    }





    public function showByCategory($name)
    {
        $selectedCategory = Category::where('name', $name)->first();
        $categories = Category::all();


        if ($selectedCategory) {
            // Corrected the method chain and placement of paginate
            $products = Product::where('category_id', $selectedCategory->id)->paginate(4);
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
            $products = Product::paginate(4);
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






    public function edit($id)
    {
        $reminders = Reminder::where('status', true)->get();
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('editoption.product_edit', compact('product', 'categories', 'reminders'));
    }

    public function productupdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->discount = $request->discount;
        $product->save();
        return redirect('/product')->with('success', 'Product updated successfully!');
    }





    // product search

    public function searchproduct(Request $request)
    {
        $searchKeyword = $request->input('searchKeyword');

        // Paginate the orders based on the search keyword
        // $orders = Order::where('name', 'LIKE', '%' . $searchKeyword . '%')
        //     ->orWhere('order_number', 'LIKE', '%' . $searchKeyword . '%')
        //     ->paginate(10); // You can adjust the number (10) to control how many results per page
        $products = Product::where('name', 'LIKE', '%' . $searchKeyword . '%')->paginate(10);
        $reminders = Reminder::where('status', true)->get();
        $categories = Category::all();
        return view('admin.productsearch', compact('products', 'searchKeyword', 'categories', 'reminders'));
    }
}
