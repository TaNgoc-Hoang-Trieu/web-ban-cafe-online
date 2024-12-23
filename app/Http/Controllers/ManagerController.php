<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Exception;
use Flasher\Toastr\Prime\ToastrInterface;
class ManagerController extends Controller
{
    public function manager_users(){
        $data = User::all();
        return view('manager.view_users',compact('data'));
    }
    public function m_search_user(Request $request){
        $search = $request->search;
        $data = User::Where('name','LIKE','%'.$search.'%')->get();
        return view('manager.view_users',compact('data'));
    }
    public function m_delete_user($id){
        try{
        $data =User::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->success('Xóa user thành công');
        }catch(Exception){
            toastr()->timeOut(10000)->closeButton()->warning('User có đơn hàng,giỏ hàng');
        }
        return redirect()->back();
        
    }
    public function change_admin($id){
        $data = User::find($id);
        $data->usertype = 'admin';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->success('Thay đổi thành công');
        return redirect('/manager/dashboard');
    }
    public function change_user($id){
        $data = User::find($id);
        $data->usertype = 'user';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->success('Thay đổi thành công');
        return redirect('/manager/dashboard');
    }
    public function lock_account($id){
        $data = User::find($id);
        $data->usertype = 'ban';
        $data->save();
        toastr()->timeOut(10000)->closeButton()->success('Khóa account thành công');
        return redirect('/manager/dashboard');
    }
}
