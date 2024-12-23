<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
    .span_title{
      font-size: 18px;
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
        @include('home.header')
    <!-- end header section -->

  </div>
  <!-- end hero area -->

<section class="shop_section layout_padding">
  <div class="container">
  <form action="{{url('category_search')}}" method="GET">
  <span class="span_title">Danh mục</span>
  <select name="category">
    <option><span> {{$name}}</span></option>
    <option value="Tất cả">Tất cả</option>
    @foreach ($category as $categorys)

    <option value="{{$categorys->category_name}}">
      {{$categorys->category_name}}</option> 
    
      
   @endforeach 
  </select>
  <span style="padding-left: 10px" class="span_title">Sắp xếp</span>
  <select name="sortby">
    <option><span>{{$sortby}}</span></option>
    <option value="Phổ biến">Phổ biến</option>
    <option value="Giá thấp-cao">Giá thấp-cao</option>
    <option value="Giá cao-thấp">Giá cao-thấp</option>
  </select>
  <input type="submit" class="btn btn-cart" value="Lọc">
  </form>
    <div class="row">

      @foreach ($product as $products)
        

      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="box">
            <div class="img-box">
              <img src="products/{{$products->image}}" alt="">
            </div>
            <div class="detail-box">
              <h6>{{$products->title}}</h6>
              <h6>Giá
                <span>
                  {{$products->price}}đ
                </span>
              </h6>
            </div>

      
              <a style="margin-left:0px;margin-top:15px"href="{{url('product_details',$products->id)}}" class="btn btn-danger">Chi tiết</a>
            
              <a style="margin-left: 110px;margin-top:15px" href="{{url('add_cart',$products->id)}}" class="btn btn-cart"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
              </svg></a>
          

        </div>
      </div>
      
      @endforeach

    </div>

  </div>
</section>








   

  <!-- info section -->

  @include('home.footer')

</body>

</html>