<!DOCTYPE html>
<html>

<head>
  @include('home.css')

  <style>
    .img_center{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .detail-box{
        padding: 15px;
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

  <!--  Product area start-->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">


          <div class="col-md-12">
            <div class="box">
                <div class="img_center">
                  <img width="400" src="/products/{{$product->image}}" alt="{{$product->category}}">
                </div>
                <div class="detail-box">
                  <h6> {{$product->title}} </h6>
                  <h6>  Price <span> ${{$product->price}} </span> </h6>
                </div>
                <div class="detail-box">
                    <h6> Category : {{$product->category}} </h6>
                    <h6>  Available Quantity: <span> {{$product->quantity}} </span> </h6>
                </div>
                <div class="detail-box">
                    <p style="padding-left: 20px">
                        <span><strong>=></strong></span>&nbsp&nbsp&nbsp{{$product->description}} 
                    </p>
                </div>
            </div>
          </div> 

      </div>
    </div>
  </section>


  <!-- end of Product area -->


  <!-- info section -->

  @include('home.info')

  <!-- end info section -->

  @include('home.javascript')

</body>

</html>