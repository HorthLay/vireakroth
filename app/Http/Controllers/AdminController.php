<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function userview()
    {
        $users = User::paginate(5);
        $reminders = Reminder::where('status', true)->get();
        return view('admin.userview', compact('users', 'reminders'));
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Create the reminder
        Reminder::create([
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => true, // Default value for active reminder
        ]);

        return redirect()->back()->with('success', 'Reminder added successfully!');
    }


    public function category()
    {
        $categories = Category::paginate(4);
        $reminders = Reminder::where('status', true)->get();

        return view('admin.category', compact('categories', 'reminders'));
    }

    // add Ads


    public function adsadd(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cta_url' => 'required|string',
        ]);

        $data = new Ad();
        $data->title = $request->title;
        $data->description = $request->description;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('ads', $imagename);
            $data->image = $imagename;
        }
        $data->cta_url = $request->cta_url;
        $data->save();

        return redirect()->back()->with('success', 'Ad created successfully!');
    }


    public function categoryadd(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new Category();
        $data->name = $request->name;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('categories', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function categorydelete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image && file_exists(public_path('categories/' . $category->image))) {
                unlink(public_path('categories/' . $category->image));
            }

            // Save the new image
            $image = $request->image;
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('categories'), $imagename);

            // Update the category's image path
            $category->image = $imagename;
        }

        // Update the category's name
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully!');
    }


    public function prosuctstore(Request $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->discount = $request->discount;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('products', $imagename);
            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product created successfully!');
    }



    public function ads()
    {
        $ads = Ad::all();
        $reminders = Reminder::where('status', true)->get();
        return view('admin.ads', compact('ads', 'reminders'));
    }
}
