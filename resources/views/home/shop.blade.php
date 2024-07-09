<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">

        @foreach ($product as $item)

          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
                <div class="img-box">
                  <img src="products/{{$item->image}}" alt="{{$item->category}}">
                </div>
                <div class="detail-box">
                  <h6> {{$item->title}} </h6>
                  <h6>  Price <span> ${{$item->price}} </span> </h6>
                </div>
                
                {{-- <div class="new">
                  <span>
                    New
                  </span>
                </div> --}}
               

                    <div style="padding: 15px;display:flex;justify-content:center;align-items:center;">
                      <a class="btn btn-danger" href="{{url('product_details',$item->id)}}">Details</a>
                      <a class="btn btn-primary" href="{{url('add_cart',$item->id)}}">Add to Cart</a>
                    </div>
                  
            </div>
          </div> 

        @endforeach
        
      </div>
    </div>
  </section>
