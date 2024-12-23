<header class="header_section">
  <div id="snow"></div>
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="{{url('/')}}">
        <span>
          Coffee TCO Shop
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  ">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('shop')}}">
              Shop
            </a>
          </li>
          
         
          <li class="nav-item">
            <a class="nav-link" href="{{url('contact')}}">Liên hệ</a>
          </li>
        </ul>
        {{-- <form action="{{url('search_product_home')}}" method="GET">
          @csrf
          <input class="search" type="search" name="search" placeholder="Tìm kiếm">
          <input type="submit" class="btn btn-primary" value="Tìm Kiếm">
      </form> --}}
      <form action="{{url('search_product_home')}}" method="GET">
        @csrf
          <div class="form">
            <i class="fa fa-search"></i>
            <input type="search" class="form-control form-input" name="search" placeholder="Tìm kiếm">
          </div>
        </form>
        
    
        <div class="user_option">
          @if (Route::has('login'))
            
          @auth

          
            <a class="hh" href="{{url('myorders')}}">
              Đơn hàng
            </a>
      
    
          <a class="hh" href="{{url('mycart')}}">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            [{{$count}}]
       
          </a>
  


     
          <a class="hh" href="{{url('edit_user',Auth::user()->id)}}">
            <i class="fa fa-user" aria-hidden="true"></i>
          </a>
   
          <form style="padding: 15px" method="POST" action="{{ route('logout') }}">
            @csrf
                  <button class="logout" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                  </svg>
                </button>
          </form>
          @else
          <a href="{{url('/login')}}">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>
              Đăng nhập
            </span>
          </a>
          <a href="{{url('/register')}}">
            <i class="fa fa-vcard" aria-hidden="true"></i>
            <span>
              Đăng ký
            </span>
          </a>
         @endauth
         @endif
         
        </div>
      </div>
    </nav>
  </header>