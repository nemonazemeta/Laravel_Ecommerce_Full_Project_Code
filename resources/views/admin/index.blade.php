<!DOCTYPE html>
<html>
  <head> 
    @include('admin.cssadmin')
  </head>
  <body>
    <!--header initial -->
    @include('admin.header')  
    <!--- header final -->
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          @include('admin.body')
          
      </div>
    </div>
  </div>
    <!-- JavaScript files-->
    @include('admin.javascript')
  </body>
</html>