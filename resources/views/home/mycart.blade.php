<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        table{
            border: 2px solid black;
            text-align: center; 
            width: 800px;
        }
        th{
          background-color: orange;
          padding: 15px;
          font-size: 15px;
          border: 2px solid black;
          font-weight: bold;
          text-align: center;
        }
        td{
          border: 1px solid rgb(0, 0, 0);
          text-align: center;
        }
        .cart_value{
            margin-bottom: 70px;
            display: flex; 
            flex-wrap: wrap;
            justify-content: right;
            margin-right: 470px;

        }
        .order_deg{           
            margin-top: -30px; 
            margin-bottom: 20px;
            margin-left: 550px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid black;
            height: 530px;
            width: 500px;
            background:rgb(246, 246, 246);
            border-radius: 50px;
            border: none;
        }
        label{
            display: inline-block;
            width: 150px;
        }
        .div_gap{
            padding: 20px;
        }
        .quantity{
            margin: 5px;
        }
        .card {
            margin-bottom: 30px;
            border: 0;
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
            letter-spacing: .5px;
            border-radius: 8px;
            -webkit-box-shadow: 1px 5px 24px 0 rgba(68,102,242,.05);
            box-shadow: 1px 5px 24px 0 rgba(68,102,242,.05);
        }

        .card .card-header {
            background-color: #fff;
            border-bottom: none;
            padding: 24px;
            border-bottom: 1px solid #f6f7fb;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .card .card-body {
            padding: 30px;
            background-color: transparent;
        }

        .btn-primary, .btn-primary.disabled, .btn-primary:disabled {
            background-color: #4466f2!important;
            border-color: #4466f2!important;
        }
        input[type='text']
        {
          width: 350px;
          height: 50px;
          border-radius: 50px;
          border: none;
          padding: 10px;
        }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
        @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
    <!-- end slider section -->
  </div>
  <!-- end hero area -->
  <?php
  $value = 0;
  $price=0;
  $quantity=0;
  $totalquantity=0;
  $totalquantity1=0;
?>
@foreach ($cart as $carts)
        <?php
         $totalquantity1 = $totalquantity1 + $carts->quantity;
        ?>
@endforeach
@if($totalquantity1 == 0)
<div class="card-body cart">
    <div class="col-sm-12 empty-cart-cls text-center">
        <img src={{asset('images/dCdflKN.png')}} width="130" height="130" class="img-fluid mb-4 mr-3">
        <h3><strong>Giỏ hàng trống</strong></h3>
        <h4>Không có món nào trong giỏ hàng</h4>
        <a href="/" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Về trang chủ</a>   
    </div>
</div>
@else
<div class="div_deg">
    <table>
        <tr>
            <th>Tên món</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Tổng giá</th>
            <th>Xóa</th>
        </tr>
   

        @foreach ($cart as $cart)

        <tr>
            <td>{{$cart->product->title}}</td>
            <td>{{$cart->product->price}}</td>
            <td><img width="120" src="/products/{{$cart->product->image}}" ></td>
            <td>
                <div class="number">
                    @if($cart->quantity > 1)
                   <a href="{{url('minus_cart',$cart->id)}}" class="btn btn-secondary">-</a>
                   @else
                   <span class="btn btn-secondary">-</span>
                   @endif
                   <span class="quantity">{{$cart->quantity}}</span>
                   @if($cart->quantity < 100) 
                   <a href="{{url('plus_cart',$cart->id)}}" class="btn btn-success">+</a>
                   @endif
                </div>
        
            </td>
            <?php
                $price = $cart->product->price;
                $int = (int)$price;
                $quantity = $cart->quantity * $int;
            ?>
            <td>
                <span class="quantity">{{$quantity}} đ</span>
            </td>
            <td>
                <a href="{{url('delete_cart',$cart->id)}}"
                    onclick="confirmation(event)"
                    class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                      </svg></a>
            </td>
        </tr>
        <?php
            $value = $value + $quantity;
        ?>
         <?php
         $totalquantity = $totalquantity + $cart->quantity;
           ?>
        @endforeach
    </table>
</div>
<div class="cart_value">
    <h4 style="color: black">Tổng SL: {{$totalquantity}}</h4>
  <h4 style="color: black;padding-left:30px;">Tổng: {{$value}}đ</h4>
</div>

<div class="order_deg">
    <form action="{{url('comfirm_order')}}" method="POST">
        @csrf
        <div style="padding-left:50px">
        <h3 style="padding-left:70px">Thông tin đặt hàng</h3>
        <div class="div_gap">
            <label>Tên</label>
            <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>
        <div class="div_gap">
            <label>Địa chỉ</label>
            <input type="text" name="address" value="{{Auth::user()->address}}">
        </div>
        <div class="div_gap">
            <label>Số điện thoại</label>
            <input type="text" name="phone" value="{{Auth::user()->phone}}">
        </div>
    </div>
        <div class="div_gap">
            <?php
            if( $totalquantity != 0)
            {
            ?>
            <input style="border-radius:40px;" class="btn btn-cart" type="submit" value="Thanh toán khi nhận hàng">
            <a style="border-radius:40px;" class="btn btn-primary" href="{{url('stripe',$value)}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
              </svg> Thanh toán qua thẻ</a>
              <?php } ?>
        </div>
    </form>
   
</div>
@endif



   

  <!-- info section -->

  @include('home.footer')

</body>

</html>