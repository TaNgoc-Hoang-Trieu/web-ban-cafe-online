<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Category;
use Session;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Support\Facades\DB;
use Stripe;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = User::where('usertype','user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status','delivered')->get()->count();
        return view('admin.index',compact('user','product','order','delivered'));
    }
    public function contact(){
        if(Auth::id()){
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.contactpage',compact('count'));
    }
    public function shop(){
        $product = Product::all();
        $category = Category::all();
        $name = "Tất cả";
        $sortby = "Phổ biến";
        if(Auth::id()){
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        
        return view('home.shop',compact('product','count','category','name','sortby'));
    }
    public function home(){
        $product = Product::paginate(8);
        if(Auth::id()){
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        
        return view('home.index',compact('product','count'));
    }

    public function login_home(){
        $product = Product::paginate(8);
        $user = Auth::user();

        $userid = $user->id;

        $count = Cart::where('user_id',$userid)->count();
        
        return view('home.index',compact('product','count'));
    }
    public function product_details($id){
        $data = Product::find($id);

        if(Auth::id()){
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.product_details',compact('data','count'));
    }
    public function add_cart($id){
        $tong = 1;
        $product_id = $id;

        $user = Auth::user();

        $user_id = $user->id;

        $data = new Cart;
        $cart = Cart::where('user_id',$user_id)->get();
        $data->user_id = $user_id;
        foreach($cart as $carts){
            if($carts->product_id == $id){
                $tong = 0;
                $tong = $carts->quantity + 1;
                $cart = Cart::where('product_id',$id)->delete();
            }
        }
        $data->product_id = $product_id;
        $data->quantity = $tong;

        $data->save();

        toastr()->timeOut(5000)->closeButton()->success('Thêm vào giỏ hàng thành công');

        return redirect()->back();
    }

    public function mycart(){
        if(Auth::id()){
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        
            $cart = Cart::where('user_id',$userid)->get();
        }
       
        return view('home.mycart',compact('count','cart'));
    }

    public function delete_cart($id){
        $data = Cart::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->success('Xóa thành công');
        return redirect()->back();
    }
    public function minus_cart($id){
        $data = Cart::find($id);
        $data->quantity = $data->quantity - 1;
        $data->save();
        return redirect('/mycart');
    }
    public function plus_cart($id){
        $data = Cart::find($id);
        $data->quantity = $data->quantity + 1;
        $data->save();
        return redirect('/mycart');
    }
    public function comfirm_order(Request $request){
        $data = array();
        $userid = Auth::user()->id;
        $data['name'] = $request->name;
        $data['rec_address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['user_id'] = $userid;
        $order_id = DB::table('orders')->insertGetId($data);
        $cart = Cart::where('user_id',$userid)->get();
        foreach($cart as $carts){
        $order_data = array();
        $order_data['order_id'] =  $order_id;
        $order_data['product_id'] = $carts->product_id;
        $order_data['quantity'] = $carts->quantity;
        DB::table('order_details')->insert($order_data);
        }
        $cart_remove = Cart::where('user_id',$userid)->get();

            foreach($cart_remove as $remove){
                $data = Cart::find($remove->id);
                $data->delete();
            }
            toastr()->timeOut(5000)->closeButton()->success('Đặt hàng thành công');
            return redirect()->back();

    }
    // public function myorders(){
        
    //         $user = Auth::user();

    //         $userid = $user->id;

    //         $count = Cart::where('user_id',$userid)->get()->count();

    //         $order = Order::where('user_id', $userid)->get();
    //     return view('home.order',compact('count','order'));
    // }
    public function myorders(){
        
        $user = Auth::user();

        $userid = $user->id;
        $data = Order::where('user_id',$userid)->orderByDesc('id')->get();
        $count = Cart::where('user_id',$userid)->get()->count();
        return view('home.order',compact('data','count')); 
    }
    public function my_detail_order($id){
        $order = Order::where('id',$id)->first();
        $data = Order_detail::where('order_id',$id)->get();
        $user = Auth::user();

        $userid = $user->id;

        $count = Cart::where('user_id',$userid)->get()->count();
        return view('home.detail_order',compact('order','data','count')); 
    }
    public function delete_order($id){
        $data = Order_detail::where('order_id',$id)->delete();
        $data = Order::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->success('Hủy đơn hàng thành công');
        return redirect()->back();
    }
    public function stripe($value)

    {

        return view('home.stripe',compact('value'));

    }
    public function stripePost(Request $request,$value)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $value * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from complete" 

        ]);

      

        $data = array();
        $userid = Auth::user()->id;
        $data['name'] = Auth::user()->name;
        $data['rec_address'] = Auth::user()->address;
        $data['phone'] = Auth::user()->phone;
        $data['user_id'] = $userid;
        $data['payment_status'] = 'paid';
        $order_id = DB::table('orders')->insertGetId($data);
        $cart = Cart::where('user_id',$userid)->get();
        foreach($cart as $carts){
        $order_data = array();
        $order_data['order_id'] =  $order_id;
        $order_data['product_id'] = $carts->product_id;
        $order_data['quantity'] = $carts->quantity;
        DB::table('order_details')->insert($order_data);
        }
        $cart_remove = Cart::where('user_id',$userid)->get();

            foreach($cart_remove as $remove){
                $data = Cart::find($remove->id);
                $data->delete();
            }
            toastr()->timeOut(5000)->closeButton()->success('Đặt hàng thành công');
            return redirect('/mycart');

    }
    public function search_product_home(Request $request){
        $search = $request->search;
        $product = Product::where('title','LIKE','%'.$search.'%')->get();
                if(Auth::id()){
                    $user = Auth::user();
        
                    $userid = $user->id;
        
                    $count = Cart::where('user_id',$userid)->count();
                }
                else{
                    $count = '';
                }
        return view('home.shop_search',compact('product','count','search'));
    }
    public function edit_user($id){
        $data = User::find($id);
        if(Auth::id()){
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.update_user',compact('data','count'));
    }
    public function update_user(Request $request,$id){
        $data = User::find($id);

        $data->name = $request->name;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->save();

        toastr()->timeOut(10000)->closeButton()->success('Cập Nhật thông tin thành công');

        return redirect('/shop');
    }
}
