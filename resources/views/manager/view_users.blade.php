<!DOCTYPE html>
<html>
  <head> 
    @include('manager.css')
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
          padding: 10px;
          text-align: center;
          font-size: 20px;
          width: 200px;
          font-weight: bold;
          color: white;
          border: 2px solid rgb(255, 255, 255);
      
        }
        td{
          color: black;
          border: 1px solid black;
          text-align: center;
          font-size: 18px;
          padding: 5px;
          background: white;
        
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
   @include('manager.header')
 
      @include('manager.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h3>Tất cả ngươi dùng</h3><br>
            <form action="{{url('m_search_user')}}" method="GET">
              @csrf
              <input type="search" name="search">
              <input type="submit" class="btn btn-primary" value="Tìm Kiếm">
          </form>
            <div class="div_deg">

                <table class="table_deg">
                  <tr>
                    <th>Email</th>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Quyền truy cập</th>
                    <th>Thay đổi quyền</th>
                    <th>Chức năng</th>
                  </tr>
                  @foreach ($data as $datas)
                  @if($datas->usertype != 'manager')
                  <tr>
                    <td>{{$datas->email}}</td>
                    <td>{{$datas->name}}</td>
                    <td>{{$datas->address}}</td>
                    <td>{{$datas->phone}}</td>
                    <td>{{$datas->usertype}}</td>
                    <td>  @if($datas->usertype == 'user')
                      <a class="btn btn-primary" href="{{url('change_admin',$datas->id)}}">Admin</a>
                      @elseif ($datas->usertype == 'admin')
                      <a class="btn btn-success" href="{{url('change_user',$datas->id)}}">User</a>
              
                      @endif</td>
                      <td>
                        @if($datas->usertype == 'user')
                    <a href="{{url('lock_account',$datas->id)}}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
                    </svg> Khóa</a>
                    @endif
                    @if($datas->usertype == 'ban')
                    <a href="{{url('unlock_account',$datas->id)}}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                      <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2M3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z"/>
                    </svg> Mở</a>
                    @endif
                      <a href="{{url('m_delete_user',$datas->id)}}"
                      onclick="confirmation(event)"
                        class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg> Xóa</a>
                    </td>
                  </tr>
                  @endif
                  @endforeach
                </table>
                
  
            </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('manager.js')
  </body>
</html>