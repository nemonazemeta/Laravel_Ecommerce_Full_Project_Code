<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\User;

use App\Models\Cart;

use App\Models\Order;

use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{

    public function home(){
        $product = Product::orderBy('created_at')->get();
        if(Auth:: id()){
            $user = Auth:: user();
            $user_id = $user->id;
            $count = Cart:: where('user_id',$user_id)->count();
        }
        else{
            $count = '';
        }
       
        return view('home.index',compact('product','count'));
    }

    public function login_home(){
        $product = Product::orderBy('created_at')->get();
        if(Auth:: id()){
            $user = Auth:: user();
            $user_id = $user->id;
            $count = Cart:: where('user_id',$user_id)->count();
        }
        else{
            $count = '';
        }
        return view('home.index',compact('product','count'));

    }

    public function index(){
        return view('admin.index');
    }
    
    public function product_details($id){
        $product = Product::find($id);
        if(Auth:: id()){
            $user = Auth:: user();
            $user_id = $user->id;
            $count = Cart:: where('user_id',$user_id)->count();
        }
        else{
            $count = '';
        }
        return view('home.product_details',compact('product','count'));
    }
    public function add_cart($id){
        $product_id = $id;
        $user = Auth:: user();
        $user_id = $user->id;

        $product = new Cart;
        $product->user_id = $user_id;
        $product->product_id = $product_id;
        $product->save();   

        toastr()->timeOut(10000)->closeButton()->addSuccess('New Product added to Cart Successfully');

        return redirect()->back();
    }

    public function mycart(){
        if(Auth::id()){
            $user = Auth:: user();
            $user_id = $user->id;
            $count = Cart:: where('user_id',$user_id)->count();
            $cart = Cart:: where('user_id',$user_id)->get();

        }
        return view('home.mycart',compact('count','cart'));
    }


    public function remove_cart($id){
        $data = Cart::find($id);
            $data->delete();
            toastr()->timeOut(10000)->closeButton()->addSuccess('Product Removed From Cart Successfully');
        return redirect()->back();
        
    }

//     public function confirm_order(Request $request){

//        $name = $request->name;
//        $address = $request->address;
//        $phone = $request->phone;
//        $user_id = Auth:: user()->id;
//         $cart = Cart:: where('user_id',$user_id)->get();
//         foreach($cart as $carts){
//             $order = new Order;
//             $order->name = $name;
//             $order->rec_address = $address;
//             $order->phone = $phone;
//             $order->user_id = $user_id;
//             $order->product_id = $carts->product_id;
//             $order->save();

//         }
//         toastr()->timeOut(10000)->closeButton()->addSuccess('Order Successfully Submitted.');
//         return redirect()->back();
//     }
// }

public function confirm_order(Request $request)
{
    // Validate the request data
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'address' => 'required|string|max:255',
    //     'phone' => 'required|string|max:15'
    // ]);

    $name = $request->name;
    $address = $request->address;
    $phone = $request->phone;
    $user_id = Auth::user()->id;

    $cart = Cart::where('user_id', $user_id)->get();

    // Check if the cart is empty
    if ($cart->isEmpty()) {
        toastr()->timeOut(10000)->closeButton()->addError('Your cart is empty.');
        return redirect()->back();
    }

    // Wrap the operation in a transaction
    // DB::beginTransaction();

    try {
        foreach ($cart as $cartItem) {
            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $user_id;
            $order->product_id = $cartItem->product_id;
            $order->save();
        }

        // Commit the transaction
        // DB::commit();

        // Clear the cart after the order is placed (optional)
        Cart::where('user_id', $user_id)->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Order Successfully Submitted.');
    } catch (\Exception $e) {
        // Rollback the transaction in case of error
        // DB::rollBack();
        toastr()->timeOut(10000)->closeButton()->addError('There was an error submitting your order. Please try again.');
    }

    return redirect()->back();
}

}