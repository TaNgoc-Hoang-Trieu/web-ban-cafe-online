<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
        input[type='text']
        {
            width: 400px;
            height: 50px;
        }
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }
        .table_deg{
            text-align: center;
            margin: auto;
            border: 2px solid rgb(255, 255, 255);
            margin-top: 50px;
            width: 500px;
        }
        th{
          background-color: orange;
          padding: 15px;
          font-size: 20px;
          font-weight: bold;
          color: white;
          border: 1px solid black;
        }
        td{
          color: white;
          padding: 10px;
          border: 1px solid orange;
        }
    </style>
  </head>
  <body>
   @include('admin.header')
 
      @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <h1 style="color: white">Thêm thể loại</h1>

            <div class="div_deg">

            <form action="{{url('add_category')}}" method="post">
              @csrf
                <div>
                    <input type="text" name="category">
            
                    <input class="btn btn-primary" type="submit" value="Thêm">
                </div>
            </form>
            </div>
            <div>

              <table class="table_deg">
                <tr>
                  <th>Tên thể loại</th>
                  <th>Chức năng</th>
          
                </tr>
                @foreach ($data as $data)
                  
                <tr>
                  <td>{{$data->category_name}}</td>
                  <td>
                    <a href="{{url('edit_category',$data->id)}}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                      <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                    </svg> Sửa</a>                  
                    <a href="{{url('delete_category',$data->id)}}"
                      onclick="confirmation(event)"
                      class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                      </svg> Xóa</a>
                  </td>
                </tr>

                @endforeach
              </table>


            </div>

          </div>
      </div>
    </div>
    <!-- JavaScript files-->

    @include('admin.js')
  </body>
</html>