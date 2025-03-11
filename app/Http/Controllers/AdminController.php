<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $categorycount = Category::all();
        $categories = Category::paginate(4);
        $reminders = Reminder::where('status', true)->get();

        return view('admin.category', compact('categories', 'reminders', 'categorycount'));
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

        // Check if a category with the same name already exists
        $existingCategory = Category::where('name', $request->name)->first();

        if ($existingCategory) {
            return redirect()->back()->with('error', 'Category already exists.');
        }

        $data = new Category();
        $data->name = $request->name;
        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('categories', $imagename);
            $data->image = $imagename;
        }

        if ($data->save()) {
            return redirect()->back()->with('success', 'Category created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
    }



    public function categorydelete($id)
    {
        $category = Category::find($id);

        if ($category) {
            // Delete the image file if it exists
            if (File::exists(public_path('categories/' . $category->image))) {
                File::delete(public_path('categories/' . $category->image));
            }

            // Delete the category
            $category->delete();

            return redirect()->back()->with('success', 'Category deleted successfully.');
        }

        return redirect()->back()->with('error', 'Category not found.');
    }

    public function update_category(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the category by ID
        $category = Category::find($id);

        // Check if the category exists
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        // Update the category's name
        $category->name = $request->name;

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

        // Save the updated category
        $category->save();

        // Redirect with success message
        return redirect('/category')->with('success', 'Category updated successfully!');
    }


    public function update($id)
    {
        $category = Category::find($id);
        $reminders = Reminder::where('status', true)->get();
        return view('editoption.updatecategory', compact('category', 'reminders'));
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


    public function OrderView()
    {
        $reminders = Reminder::where('status', true)->get();
        $orders = Order::paginate(5);
        $countorders = Order::all();
        $uniqueOrderCount = \App\Models\Order::whereDate('created_at', today())
            ->groupBy('order_number')
            ->selectRaw('count(*) as count')
            ->get()
            ->count();

        return view('admin.order', compact('reminders', 'orders', 'countorders', 'uniqueOrderCount'));
    }

    public function ads()
    {
        $ads = Ad::all();
        $reminders = Reminder::where('status', true)->get();
        return view('admin.ads', compact('ads', 'reminders'));
    }



    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $previousStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // Assuming you have a Product model and a relationship with Order
        $product = $order->product; // Adjust based on your actual relationship

        if ($product) {
            if ($request->status == 'success' && $previousStatus != 'success') {
                // Reduce stock by 1 and increase quantity_sold
                if ($product->stock > 0) {
                    $product->stock -= 1;
                }
                $product->quantity_sold += 1;
            } elseif ($request->status == 'canceled' && $previousStatus == 'success') {
                // Restore stock by 1 and decrease quantity_sold
                $product->stock += 1;

                // Ensure quantity_sold doesn't go negative
                if ($product->quantity_sold > 0) {
                    $product->quantity_sold -= 1;
                }
            }

            $product->save();
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
