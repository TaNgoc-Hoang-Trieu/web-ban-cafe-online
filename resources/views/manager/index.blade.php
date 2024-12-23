<!DOCTYPE html>
<html>
  <head> 
    @include('manager.css')
  </head>
  <body>
   @include('manager.header')
 
      @include('manager.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            @include('manager.view_users')
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('manager.js')
  </body>
</html>