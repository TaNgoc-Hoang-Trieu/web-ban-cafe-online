<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
    .card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 1000px;
    word-wrap: break-word;
    background-color: #f2f2f2;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
.text-reset {
    --bs-text-opacity: 1;
    color: inherit!important;
}
        label{
            font-size: 20px;
            color: #000;
        }
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }
        .table_deg{
            border: 2px solid black;
        }
        th{
          background-color: orange;
          padding: 15px;
          font-size: 20px;
          font-weight: bold;
          width: 200px;
          color: black;
          border: 2px solid black;
        }
        td{
          color: black;
          border: 1px solid black;
          text-align: center;
        }
        .cart_value{
            margin-bottom: 70px;
            display: flex; 
            flex-wrap: wrap;
            justify-content: right;
            margin-right: 320px;

        }
        .quantity_value{
            text-align: right; 
            margin-right: 500px;
            padding: 18px;

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
?>
  <div class="container-fluid">
    <div class="container">
      <!-- Title -->
      <div class="d-flex justify-content-between align-items-center py-3">
        <?php

          // Get the current date
          $date = $order->created_at;

          // Extract day, month, and year
          $day = date('d', strtotime($date));
          $month = date('m', strtotime($date));
          $year = date('Y', strtotime($date));
          
        ?>
        <h2 >Đơn hàng #{{$day}}{{$month}}{{$year}}{{$order->id}}</h2>
      </div>
    
      <!-- Main content -->
      <div class="row">
        <div class="col-lg-8">
          <!-- Details -->                   
          <!-- Payment -->
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h1>Thông tin đơn hàng</h1>
                  <br>
                  <address>
                    <label>Khách hàng: {{$order->name}}</label><br>
                    <label>Địa chỉ: {{$order->rec_address}}</label><br>
                    <label>Số điện thoại: {{$order->phone}}</label>
                    <label>Ngày đặt hàng: {{$order->created_at}}</label>
                  </address>
                 
                </div>
                <div class="col-lg-6">
                    <br><br><br>
                  <h3 class="h3">Hình thức thanh toán</h3>
                  <label>@if($order->payment_status == 'cash on delivery')
                    <span style="color: green">Thanh toán khi giao hàng</span>
                    @else
                    <span style="color: rgb(0, 219, 0)">Đã thanh toán online</span>
                @endif
                </label><br>
                  <h3 class="h3">Trạng thái đơn hàng</h3>
                  <label> @if($order->status == 'in progress')
                    <span style="color: red">"Đang chuẩn bị hàng"</span>
                @elseif ($order->status == 'on the way') 
                    <span style="color: orange">"Đang giao hàng"</span>
                @else
                    <span style="color: green">"Đã giao"</span>
                @endif</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
      </div>
<div class="div_deg">

    <table class="table_deg">
      <tr>
        <th>Tên Món</th>
        <th>Hình ảnh</th>
        <th>giá</th>
        <th>Số lượng</th>
        <th>Tổng giá</th>
      </tr>
      @foreach ($data as $data)
        
      <tr>
        <td>{{$data->product->title}}</td>
        <td><img width="120" src="/products/{{$data->product->image}}" ></td>
        <td>{{$data->product->price}}</td>
        <td>{{$data->quantity}}</td>
        <?php
        $price = $data->product->price;
        $int = (int)$price;
        $quantity = $data->quantity * $int;
        ?>
        <td>
            {{$quantity}} đ
        </td>
      </tr>
      <?php
$value = $value + $quantity;
  ?>
   <?php
   $totalquantity = $totalquantity + $data->quantity;
     ?>
      @endforeach
    </table>
  
</div>
<div class="quantity_value">
    
  </div>
<div class="cart_value">
    <h4 style="color: black">Tổng SL: {{$totalquantity}}</h4>
  <h4 style="color: black;padding-left:70px;">Tổng: {{$value}}đ</h4>
</div>







   

  <!-- info section -->

  @include('home.footer')

</body>

</html>