<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'discount' => $product->discount,
                'stock' => $product->stock,
                'category_id' => $product->category_id,
                'name_cate' => $product->category ? $product->category->name : null,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
                'image' => str_replace('localhost', '10.0.2.2', url('products/' . $product->image)),
                'quantity_sold' => $product->quantity_sold,
                'status' => $product->status,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }


    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function getCategories()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $category->image_url = asset('categories/' . $category->image);
        }

        return response()->json($categories);
    }

    public function showByCategoryApi($id)
    {
        $products = Product::with('category')  // assumes Product model has category() relation
            ->where('category_id', $id)
            ->get()
            ->map(function ($product) {
                $product->image = str_replace('localhost', '10.0.2.2', url('products/' . $product->image));
                // Optionally add category name directly on product:
                $product->category_name = $product->category ? $product->category->name : null;
                unset($product->category);  // remove full category object if you only want name
                return $product;
            });

        // Optionally, get category name separately
        $category = Category::find($id);

        return response()->json([
            'success' => true,
            'category' => $category ? $category->name : null,
            'data' => $products,
        ]);
    }
}
