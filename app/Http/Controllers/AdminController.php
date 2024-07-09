<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::orderBy('created_at', 'desc')->get();
        return view('admin.category', compact('data'));
    }
    public function add_category(Request $request){

        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        // toastr()->timeOut(10000)->addSuccess('You have done it');
        // toastr()->persistent()->closeButton()->addWarning('You have done it');
        // toastr()->closeButton()->addSuccess('You have Successfully added new category');
        toastr()->timeOut(10000)->closeButton()->addSuccess('You have Successfully added new category');

        return redirect()->back();
    }

    public function delete_category($id){
        $data = Category::find($id);
        if ($data) {
            $data->delete();
            toastr()->timeOut(10000)->closeButton()->success('Category Successfully Deleted');
        } else {
            toastr()->timeOut(10000)->closeButton()->error('Category Not Found');
        }
        return redirect()->back();
    }

    public function edit_category($id){
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id){
        $data = Category::find($id);
        $data->category_name = $request->editCategory;
        $data->save();
        toastr()->persistent()->closeButton()->success('Category Successfully Updated');

        return redirect('/view_category');
    }

    public function add_product(){
        $category = Category::orderBy('category_name','asc')->get();
        return view('admin.add_product',compact('category'));
    }

    public function upload_product(Request $request){
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        //The code for image uploading
        // Ensure the form has enctype="multipart/form-data" attribute

            $image = $request->file('image'); // get the uploaded file instance

            if($image){
                $imagename = time() . '.' . $image->getClientOriginalExtension(); // generate unique name
                $image->move(public_path('products'), $imagename); // move the file to the 'products' folder in the 'public' directory
                $data->image = $imagename; // save the filename to the database
            }

            $data->save(); // save the data to the database

        toastr()->timeOut(10000)->closeButton()->addSuccess('New Product Added Successfully');

        return redirect()->back();
    }

    public function view_product(){
        $data = Product::paginate(3);
        return view('admin.view_product', compact('data'));
    }

    public function delete_product($id){
        $product = Product::find($id);
        $image_path = public_path('products/'.$product->image);  // getting image path and name
        if(file_exists($image_path)){   // checking if the image file exists
            unlink($image_path);   // Deleting the image from the Public folder
        }

        if($product){
            $product->delete();
            toastr()->timeOut(10000)->closeButton()->addSuccess('You Have Successfully Deleted one Product Data');
        }
        else{
            toastr()->timeOut(10000)->closeButton()->addSuccess('Category not found');

        }
        return redirect()->back();
    }

    public function edit_product($id){
        $category = Category::orderBy('category_name','asc')->get();

        $data = Product::find($id);
        return view('admin.edit_product',compact('data','category'));
    }

    public function update_product(Request $request, $id){

        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        //The code for image uploading for Updating 
        // Ensure the form has enctype="multipart/form-data" attribute

        $image = $request->file('image'); // get the uploaded file instance

        if($image){
            $imagename = time() . '.' . $image->getClientOriginalExtension(); // generate unique name
            $image->move(public_path('products'), $imagename); // move the file to the 'products' folder in the 'public' directory
            $data->image = $imagename; // save the filename to the database
        }

        $data->save(); // save the data to the database

    toastr()->timeOut(10000)->closeButton()->addSuccess('Product Data Updated Successfully');

    return redirect('/view_product');
    }

    public function product_search(Request $request){
        $search = $request->search;

        // Select the Product from the Database that Matches the title and category
        // $data = Product:: where('title','LIKE','%'. $search . '%')->paginate(3);  // only for the title
        $data = Product:: where('title','LIKE','%'. $search . '%')
                            ->orWhere('category','LIKE','%' . $search . '%')->paginate(3);  //  for the title and category
        if($data->isEmpty()) {
        toastr()->timeOut(10000)->closeButton()->addWarning('There is no such Title or Category');
            return redirect()->back();
        }         
        else{
            return view('admin.view_product', compact('data'));

        }
    }

    public function view_orders(){
        $data  = Order::orderBy('created_at')->get();
        return view('admin.view_orders',compact('data'));
    }

    public function on_the_way($id){
        $data = Order::find($id);
        $data->status="On the Way";

        $data->save();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Order Status Successfully Changed to On the Way');
        return redirect()->back();
    }

    public function delivered($id){
        $data = Order::find($id);
        $data->status="Delivered";

        $data->save();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Order Status Successfully Changed to Delivered');
        return redirect()->back();
    }

    public function print_pdf($id){
        $data = Order::find($id);
        $pdf_name = $data->name;

        $pdf = Pdf::loadView('admin.invoice',compact('data'));
        return $pdf->download($pdf_name . '.pdf');
    }
}
