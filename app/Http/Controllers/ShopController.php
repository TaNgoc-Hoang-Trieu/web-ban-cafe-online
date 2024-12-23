<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Session;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Support\Facades\DB;
use Stripe;
use Illuminate\Support\Facades\Auth;
class ShopController extends Controller
{
    public function category_search(Request $request){
        $sortby = $request->sortby;
        if($sortby == "Giá cao-thấp"){
            $product = Product::where('category',$request->category)->orderBy('price','DESC')->get();
        }
        elseif($sortby == "Giá thấp-cao"){
            $product = Product::where('category',$request->category)->orderBy('price','ASC')->get();
        }else{
            $product = Product::where('category',$request->category)->get();
        }
        $name = $request->category;
        $category = Category::all();
        if($name == 'Tất cả'){
            if($sortby == "Giá cao-thấp"){
                $product = Product::orderBy('price','DESC')->get();
            }
            elseif($sortby == "Giá thấp-cao"){
                $product = Product::orderBy('price','ASC')->get();
            }else{
                $product = Product::all();
            }
        }
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
}
