<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }
        .table_deg{
            border: 2px solid rgb(255, 255, 255);
        }
        th{
          background-color: orange;
          padding: 15px;
          font-size: 20px;
          font-weight: bold;
          color: black;
          border: 2px solid black;
        }
        td{
          color: black;
          border: 1px solid black;
          text-align: center;
          background: white;
          padding: 5px;
          font-size: 18px;
        }
        input[type='search']
        {
            width: 400px;
            height: 50px;
            margin-left: 50px;
        }
    </style>
  </head>
  <body>
   @include('admin.header')
 
      @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h3>Tất cả đơn hàng</h3><br>
            <form action="{{url('search_order')}}" method="GET">
              @csrf
              <input type="search" name="search">
              <input type="submit" class="btn btn-primary" value="Tìm Kiếm">
          </form>
            <div class="div_deg">

                <table class="table_deg">
                  <tr>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>                  
                    <th>Thay đổi trạng thái</th>                   
                    <th>Chi tiết</th>
                    <th>Print PDF</th>
                    <th>Xóa</th>
                  </tr>
                  @foreach ($data as $datas)
                    
                  <tr>
                    <td>{{$datas->name}}</td>
                    <td>{{$datas->rec_address}}</td>
                    <td>{{$datas->phone}}</td>
                    <td>
                      @if($datas->payment_status == 'cash on delivery')
                            <span style="color: green">"Thanh toán khi giao hàng"</span>
                      @else
                            <span style="color: rgb(0, 68, 0)">"Đã thanh toán online"</span>
                        @endif
                    </td>
                    <td>
                        @if($datas->status == 'in progress')
                            <span style="color: red">"Đang chuẩn bị hàng"</span>
                        @elseif ($datas->status == 'on the way') 
                            <span style="color: orange">"Đang giao hàng"</span>
                        @else
                            <span style="color: green">"Đã giao"</span>
                        @endif
                    </td>
                    <td>
                      @if($datas->status != 'delivered')
                        <a class="btn btn-primary" href="{{url('on_the_way',$datas->id)}}">Đang giao hàng</a>
                        <a class="btn btn-success" href="{{url('delivered',$datas->id)}}">Đã giao</a>
                        @endif
                      </td>
                    <td>
                      <a href="{{url('detail_order',$datas->id)}}" class="btn btn-secondary">Chi tiết</a>
                    </td>
                    <td>
                      <a class="btn btn-secondary" href="{{url('print_pdf',$datas->id)}}">Print PDF</a>
                    </td>
                    <td>@if($datas->status != 'delivered')
                      <a href="{{url('delete_orders',$datas->id)}}"
                      onclick="confirmation(event)"
                        class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg></a>
                        @endif
                    </td>
                  </tr>
  
                  @endforeach
                </table>
                
  
            </div>
            <div class="div_deg">
              {{$data->onEachSide(1)->links()}}
          </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>