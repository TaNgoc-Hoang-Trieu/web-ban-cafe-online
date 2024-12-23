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
            margin: 30px;
        }
        th{
          background-color: orange;
          padding: 15px;
          font-size: 15px;
          border: 2px solid black;
          font-weight: bold;
          text-align: center;
          width: 300px;
        }
        td{
          border: 1px solid rgb(0, 0, 0);
          text-align: center;
        }
        .cart_value{
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }
        .order_deg{
            padding-right: 100px;
            margin-top: -50px; 
        }
        label{
            display: inline-block;
            width: 150px;
        }
        .div_gap{
            padding: 20px;
        }
        .abs{
            display: flex; 
            flex-wrap: wrap; 
            justify-content: space-between; 
            margin: 20px;
            width: 900px; 
        }
        @media (min-width: 768px) { 
            .table { 
                width: 40%; 
                margin-bottom: 0; 
            } 
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

<div class="div_deg">
    <div class="abs">
        
    @foreach ($data as $data)
    <?php

    // Get the current date
    $date = $data->created_at;

    // Extract day, month, and year
    $day = date('d', strtotime($date));
    $month = date('m', strtotime($date));
    $year = date('Y', strtotime($date));
    
  ?>
    <span style="font-size: 20px;font-weight:bold;">Đơn hàng #{{$day}}{{$month}}{{$year}}{{$data->id}}</span>
    <table>
        <tr>
            <th>Ngày đặt hàng</th>
            <th>Trạng thái</th>
            <th>Thanh toán</th>
            <th>Chi tiết đơn hàng</th>
            <th>Hủy đơn hàng</th>
        </tr>
        

        <tr>
            <td>{{$data->created_at}}</td>
            <td>
                @if($data->status == 'in progress')
                <span style="color: red">"Đang chuẩn bị hàng"</span>
            @elseif ($data->status == 'on the way') 
                <span style="color: orange">"Đang giao hàng"</span>
            @else
                <span style="color: green">"Đã giao"</span>
            @endif
            </td>
            <td>
                <label>@if($data->payment_status == 'cash on delivery')
                    <span style="color: green">Thanh toán khi giao hàng</span>
                    @else
                    <span style="color: green">Đã thanh toán</span>
                @endif
                </label>
            </td>
            <td>
                <a href="{{url('my_detail_order',$data->id)}}" class="btn btn-secondary">Chi tiết</a>
              </td>
            <td>@if($data->status == 'in progress' && $data->payment_status != 'paid')
                <a href="{{url('delete_order',$data->id)}}"
                    onclick="confirmation(event)"
                    class="btn btn-danger">Hủy</a>
                @endif
            </td>
        </tr>
        
    </table>
   
    @endforeach
</div>
</div>







   

  <!-- info section -->

  @include('home.footer')

</body>

</html>