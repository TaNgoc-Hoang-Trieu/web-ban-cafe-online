<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>
<style type="text/css">
    .div_center
    {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }
    .detail-box{
        padding: 15px;
    }
</style>
<body>
  <div class="hero_area">
    <!-- header section strats -->
        @include('home.header')
    <!-- end header section -->

  </div>
  <!-- end hero area -->


  <!-- product details start -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Thông tin chi tiết
        </h2>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="box">
              <div class="div_center">
                <img width="400" src="/products/{{$data->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$data->title}}</h6>
                <h6>Giá:
                  <span>
                    {{$data->price}}đ
                  </span>
                </h6>
              </div>
              <div class="detail-box">
                <h6>Category : {{$data->category}}</h6>
                <h6>Số lượng có sẵn :
                  <span> 
                    {{$data->quantity}}
                  </span>
                </h6>
              </div>
              <div class="detail-box">
                <p>{{$data->description}}</p>
              </div>
              <div class="detail-box">
                <a style="padding:10px 40px 10px 40px" href="{{url('add_cart',$data->id)}}" class="btn btn-cart">Thêm vào giỏ hàng</a>
              </div>
          </div>
        </div>
        

      </div>
  
    </div>
</section>



<!-- end product details -->



   

  <!-- info section -->

  @include('home.footer')

</body>

</html>