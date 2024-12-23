<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">

            label{
                font-size: 20px;
                color: #000;
            }
            .table_deg{
                border: 2px solid rgb(0, 0, 0);
            }
            th{
                border: 2px solid black;
            }
            td{
                border: 2px solid black;
            }
        
        </style>
</head>
<body>
    <h3>Chi tiet don hang</h3><br>
    <div class="container-fluid">

        <div class="container">
          <!-- Title -->
          <div class="d-flex justify-content-between align-items-center py-3">
            <h2 >Don hang #{{$order->id}}</h2>
          </div>
        
          <!-- Main content -->
          <div class="row">
            <div class="col-lg-8">
              <!-- Details -->                   
              <!-- Payment -->
                      <h3 class="h3">Payment Method</h3>
                      <label>@if($order->payment_status == 'cash on delivery')
                        <span style="color: green">Thanh toán khi giao hàng</span>
                        @else
                        <span style="color: green">Đã thanh toán</span>
                    @endif
                    </label><br>
                      <label>Tổng: $169,98</label>
                      <h3 class="h3">Trạng thái đơn hàng</h3>
                      <label> @if($order->status == 'in progress')
                        <span style="color: red">"Đang chuẩn bị hàng"</span>
                    @elseif ($order->status == 'on the way') 
                        <span style="color: orange">"Dang giao hang"</span>
                    @else
                        <span style="color: green">"Đã giao"</span>
                    @endif</label>
                    </div>
                    <div class="col-lg-6">
                      <h3 class="h3">Billing address</h3>
                      <address>
                        <label>Khách hàng: {{$order->name}}</label><br>
                        <label>Dia chi: {{$order->rec_address}}</label><br>
                        <label>So dien thoai: {{$order->phone}}</label>
                      </address>
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
            <th>Hinh anh</th>
            <th>giá</th>
            <th>So luong</th>
            <th>Tong gia</th>
          </tr>
          @foreach ($data as $data)
            
          <tr>
            <td><label>{{$data->product->title}}<label></td>
            <td><img width="120" src="products/{{$data->product->image}}" ></td>
            <td><label>{{$data->product->price}}<label></td>
          </tr>
          @endforeach
        </table>
        

    </div>
</body>
</html>