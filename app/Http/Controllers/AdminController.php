<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reminder;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function userview()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5);
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


    public function adsupdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'cta_url' => 'required|string',
        ]);

        $data = Ad::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $image = $request->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('ads', $imagename);
            $data->image = $imagename;
        }
        $data->cta_url = $request->cta_url;
        $data->save();

        return redirect('/adsy')->with('success', 'Ad updated successfully!');
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
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);
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
        $ads = Ad::paginate(5);
        $reminders = Reminder::where('status', true)->get();
        return view('admin.ads', compact('ads', 'reminders'));
    }



    public function adsedit($id)
    {
        $reminders = Reminder::where('status', true)->get();
        $ads = Ad::findOrFail($id);
        return view('editoption.editads', compact('ads', 'reminders'));
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


    public function report(Request $request)
    {
        // Fetch orders grouped by date with distinct order_number count and total price
        $orders = Order::select(
            DB::raw('DATE(created_at) as order_date'),
            DB::raw('sale_type'),
            DB::raw('COUNT(DISTINCT order_number) as total_orders'), // Count distinct order_number
            DB::raw('SUM(total_price) as total_sales') // Summing the total price
        )

            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end_date);
            })
            ->groupBy('order_date', 'sale_type')
            ->orderBy('order_date', 'desc')
            ->paginate(5);

        $reminders = Reminder::where('status', true)->get();

        return view('admin.report', compact('reminders', 'orders'));
    }





    public function downloadPdf(Request $request)
    {
        $orders = Order::select(
            DB::raw('DATE(created_at) as order_date'),
            DB::raw('sale_type'),
            DB::raw('COUNT(DISTINCT order_number) as unique_orders'),
            DB::raw('SUM(total_price) as total_sales'),
            DB::raw('SUM(quantity) as total_items') // Include total items
        )
            ->where('status', 'success') // Filter by status
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end_date);
            })
            ->groupBy('order_date', 'sale_type')
            ->orderBy('order_date', 'desc')
            ->get();

        $grandTotalSales = $orders->sum('total_sales');
        // Uncomment these lines to generate the PDF
        // $pdf = Pdf::loadView('admin.order_report', compact('orders'));
        // return $pdf->download('order-report.pdf');

        return view('admin.order_report', compact('orders', 'grandTotalSales'));
    }


    public function orderDetails(Request $request)
    {
        $order_date = $request->input('order_date');

        if (!$order_date) {
            return redirect()->route('order.reports')->with('error', 'Order date is required.');
        }

        // Retrieve orders for the selected date
        $orders = Order::whereDate('created_at', $order_date)->with('items.product')->get();  // Ensure related items and products are loaded

        if ($orders->isEmpty()) {
            $orders = collect();  // Make sure $orders is an empty collection
        }

        return view('admin.orderviewdetails', compact('orders', 'order_date'));
    }


    public function Statusorders(Request $request, $order_number)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|string|in:success,pending,canceled',
        ]);

        $status = $request->input('status');

        // Find all orders with the same order_number
        $orders = Order::where('order_number', $order_number)->get();

        foreach ($orders as $order) {
            // Get the associated product
            $product = Product::find($order->product_id);

            if ($product) {
                if ($status == 'success' && $order->status == 'pending') {
                    // From pending to success: Reduce stock, increase quantity sold
                    $product->stock -= $order->quantity;
                    $product->quantity_sold += $order->quantity;
                } elseif ($status == 'pending' && $order->status == 'success') {
                    // From success to pending: Restore stock, decrease quantity sold
                    $product->stock += $order->quantity;
                    $product->quantity_sold -= $order->quantity;
                } elseif ($status == 'canceled' && $order->status == 'success') {
                    // From success to canceled: Restore stock, decrease quantity sold
                    $product->stock += $order->quantity;
                    $product->quantity_sold -= $order->quantity;
                } elseif ($status == 'success' && $order->status == 'canceled') {
                    // From canceled to success: Reduce stock, increase quantity sold
                    $product->stock -= $order->quantity;
                    $product->quantity_sold += $order->quantity;
                }
            
                $product->save();
            }
            

            // Update order status
            $order->status = $status;
            $order->save();
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }


    public function editRole($id)
    {
        $user = User::find($id);
        $reminders = Reminder::where('status', true)->get();
        return view('admin.edit_role', compact('user', 'reminders'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::find($id);
        $user->user_type = $request->user_type;
        $user->save();
        return redirect('/user')->with('success', 'Role updated successfully.');
    }


    public function searchUser(Request $request)
    {
        $searchKeyword = $request->input('searchKeyword');
        $users = User::where('name', 'LIKE', '%' . $searchKeyword . '%')->orWhere('phone', 'LIKE', '%' . $searchKeyword . '%')->paginate(10);
        $reminders = Reminder::where('status', true)->get();
        return view('admin.userviewsearch', compact('users', 'reminders'));
    }
}
