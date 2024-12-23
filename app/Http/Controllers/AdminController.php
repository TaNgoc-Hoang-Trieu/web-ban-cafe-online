<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request){

        $category = new Category;

        $category->category_name = $request->category;

        $category->save();
        
        toastr()->timeOut(10000)->closeButton()->success('Thêm category thành công');

        return redirect()->back();
    }
    public function delete_category($id){
        $data = Category::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->success('Xóa category thành công');
        return redirect()->back();
    }

    public function edit_category($id){
        $data = Category::find($id);
        return view('admin.edit_category',compact('data'));
    }

    public function update_category(Request $request,$id){
        $data = Category::find($id);

        $data->category_name = $request->category;

        $data->save();

        toastr()->timeOut(10000)->closeButton()->success('Cập Nhật category thành công');

        return redirect('/view_category');
    }

    public function add_product(){
        $category = Category::all();
        return view('admin.add_product',compact('category'));
    }
    public function upload_product(Request $request){
        $data = new Product;

        $data->title = $request->title;

        $data->description = $request->description;
        
        $data->price = $request->price;

        $data->quantity = $request->qty;

        $data->category = $request->category;

        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            
            $request->image->move('products',$imagename);

            $data->image =  $imagename;
        }

        $data->save();

        toastr()->timeOut(10000)->closeButton()->success('Thêm product thành công');

        return redirect()->back();
    }
    public function view_product(){
        $product = Product::orderby('id','DESC')->paginate(5);
        return view('admin.view_product',compact('product'));
    }
    public function delete_product($id){
        $data = Cart::where('product_id',$id)->delete();
        $data = Order_detail::where('product_id',$id)->delete();
        $data = Product::find($id);
        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->success('Xóa product thành công');
        return redirect()->back();
    }
    public function update_product($slug){
        $data = Product::where('slug',$slug)->get()->first();
        $category = Category::all();
        return view('admin.update_page',compact('data','category'));
    }
    public function edit_product(Request $request,$id){
        $data = Product::find($id);

        $data->title = $request->title;

        $data->description = $request->description;
        
        $data->price = $request->price;

        $data->quantity = $request->qty;

        $data->category = $request->category;

        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            
            $request->image->move('products',$imagename);

            $data->image =  $imagename;
        }

        $data->save();

        toastr()->timeOut(10000)->closeButton()->success('Cập nhật product thành công');

        return redirect('/view_product');
    }
    public function search_product(Request $request){
        $search = $request->search;
        $product = Product::where('title','LIKE','%'.$search.'%')->
                orWhere('category','LIKE','%'.$search.'%')->paginate(3);
        return view('admin.view_product',compact('product'));
    }

    public function view_orders(){
        $data = Order::orderBy('id', 'DESC')->paginate(8);

        return view('admin.order',compact('data')); 
    }
    public function detail_order($id){
        $order = Order::where('id',$id)->first();
        $data = Order_detail::where('order_id',$id)->get();
        
        return view('admin.detail_order',compact('order','data')); 
    }
    public function search_order(Request $request){
        $search = $request->search;
        $data = Order::where('name','LIKE','%'.$search.'%')->
                orWhere('phone','LIKE','%'.$search.'%')->paginate(8);
        return view('admin.order',compact('data'));
    }
    public function delete_orders($id){
        $data = Order_detail::where('order_id',$id)->delete();
        $data = Order::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->success('Xóa đơn hàng thành công');
        return redirect()->back();
    }
    public function on_the_way($id){
        $data = Order::find($id);
        $data->status = 'on the way';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->success('Thay đổi thành công');
        return redirect('/view_orders');
    }
    public function delivered($id){
        $data = Order::find($id);
        $data->status = 'delivered';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->success('Thay đổi thành công');
        return redirect('/view_orders');
    }
    public function print_pdf($id){
        $order = Order::where('id',$id)->first();
        $data = Order_detail::where('order_id',$id)->get();
        $pdf = Pdf::loadView('admin.invoice',compact('order','data'));
        return $pdf->download('invoice.pdf');
    }
    public function view_users(){
        $data = User::where('usertype','user')->orwhere('usertype','ban')->paginate(8);
        return view('admin.view_users',compact('data'));
        
    }
    public function search_user(Request $request){
        $search = $request->search;
        $data = User::where('usertype','user')->Where('name','LIKE','%'.$search.'%')->get();
        return view('admin.view_users',compact('data'));
    }
    public function delete_user($id){
        try{
        $data =User::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->success('Xóa user thành công');
        }catch(Exception){
        toastr()->timeOut(10000)->closeButton()->warning('User có đơn hàng,giỏ hàng');
        }
        return redirect()->back();
    }
    public function a_change_user($id){
        $data = User::find($id);
        $data->usertype = 'user';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->success('Thay đổi thành công');
        return redirect('/view_users');
    }
    public function a_lock_account($id){
        $data = User::find($id);
        $data->usertype = 'ban';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->success('Khóa account thành công');
        return redirect('/view_users');
    }
}
