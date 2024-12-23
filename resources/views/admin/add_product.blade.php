<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
      input[type='text']
      {
          width: 350px;
          height: 50px;
      }
      .div_deg
      {
          display: flex;
          justify-content: center;
          align-items: center;
          margin-top: 60px;
      }
      label
      {
        display: inline-block;
        width: 250px;
        font-size: 18px!important;
        color: white!important;
      }
      textarea
      {
        width: 450px;
        height: 80px;
      }
      .input_deg
      {
        padding: 15px;
      }
  </style>
  </head>
  <body>
   @include('admin.header')
 
      @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h1 style="color: white">Thêm món</h1>
            <div class="div_deg">
                <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                  @csrf  
                  <div class="input_deg">
                        <label>Tên món</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="input_deg">
                        <label>Mô tả</label>
                        <textarea name="description"  required></textarea>
                    </div>
                    <div class="input_deg">
                        <label>Giá</label>
                        <input type="text" name="price" required>
                    </div>
                    <div class="input_deg">
                        <label>Số lượng</label>
                        <input type="number" name="qty" required>
                    </div>
                    <div class="input_deg">
                        <label>Thể loại</label>
                        <select name="category" required>
                            <option>Chọn</option>
                            @foreach ($category as $category)

                            <option value="{{$category->category_name}}">
                              {{$category->category_name}}</option>
                              
                            @endforeach

                        </select>
                    </div>
                    <div class="input_deg">
                        <label>Hình ảnh</label>
                        <input type="file" name="image">
                    </div>
                    <div class="input_deg">
                     
                      <input class="btn btn-success" type="submit" value="Add Product">
                  </div>
                </form>
            </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>