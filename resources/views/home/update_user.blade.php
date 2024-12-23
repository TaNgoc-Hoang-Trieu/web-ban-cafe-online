<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .order_deg{
            height: 500px;
            width: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid black;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 600px;
            background:rgb(239, 239, 239);
            border-radius: 50px;
            border: none;
        }
        label{
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            width: 150px;
        }
        .div_gap{
            padding: 20px;
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
  </div>
  <!-- end hero area -->
  <div class="order_deg">
    
    <form action="{{url('update_user',$data->id)}}" method="POST">
        @csrf
        <h3 style="padding-left:50px">Thông tin khách hàng</h3>
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
        <div style="padding-left: 120px;" class="div_gap">
            <input style="border-radius:40px;" class="btn btn-success" type="submit" value="Thay đổi thông tin">
        </div>
    </form>
</div>








   

  <!-- info section -->

  @include('home.footer')

</body>

</html>