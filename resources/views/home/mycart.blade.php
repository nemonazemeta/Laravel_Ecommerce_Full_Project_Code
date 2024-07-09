<!DOCTYPE html>
<html>

<head>
  @include('home.css')

  <style>
    .table_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px;
        margin-bottom: 0;
    }
    table{
        border: 2px solid  black;
        text-align: center;
        width: 800px;
    }
    th{
        border: 2px solid black;
        text-align: center;
        color: white;
        font: 20px;
        font-weight: bold;
        background-color: black;
        padding: 15px;
    }
    td{
        border: 1px solid skyblue;
    }
    .cart_val{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 60px;
        
    }

    .tbl_and_h4{
        display: inline-block;
    }

    .cart_val h4{
        background-color: black;
        color: white;
        text-align: center;
        width: 800px;
        padding: 18px;
    }

    .order_div{
        display: flex;
        justify-content: center;
       align-items: center; 
        padding: 100px;
        margin-top: -150px;
        margin-left: -100px;
    }

    .div_gap{
        padding: 20px;
    }

    label{
        display: inline-block;
        width: 150px;
        font-weight: bold;
    }
    input[type='text']{
        width: 250px;
        height: 50px;
        border-radius: 10px;
    }
    textarea{
        width: 250px;
        height: 80px;
        border-radius: 10px;
    }
    .abc{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    input[type='submit']{
        border-radius: 10px;
        padding:10px;
    }

  </style>
</head>
<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    
    
    <div class="table_deg">

        <div class="order_div">
            <form action="{{ url('confirm_order') }}" method="POST">
                @csrf <!-- Add CSRF token for security -->
                <div class="div_gap">
                    <label for="name">Receiver Name </label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">
                </div>
                <div class="div_gap">
                    <label for="address">Receiver Address </label>
                    <textarea name="address" id="address">{{ Auth::user()->address }}</textarea>
                </div>
                <div class="div_gap">
                    <label for="phone">Receiver Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}">
                </div>
                <div class="div_gap abc">
                    <input class="btn btn-primary" type="submit" value="Place Order">
                </div>
            </form>
            
        </div>
        <div class="tbl_and_h4">
            <table>
           
                <tr>
                    <th>S.NO</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Remove</th>
                </tr> 
                 @php
                $counts = 0;
                $value = 0;
                @endphp
                @foreach($cart as $cart)
                    @php
                        $counts++;
                    @endphp
                    <tr>

                        <td>{{$counts}}</td>
                        <td>{{$cart->product->title}}</td>
                        <td>{{$cart->product->price}}</td>
                        <td>
                            <img height="100" width="120" src="products/{{$cart->product->image}}" alt="image not found">
 
                        </td>
                        <td>
                            <a class="btn btn-danger"  onclick="confirmation(event)"  href={{url('remove_cart',$cart->id)}}>Remove</a>
                        </td>
                        <td>
                        </td>
                        {{-- onclick="confirmation(event)" --}}
                    </tr>
                    @php
                        $value = $value + $cart->product->price
                    @endphp
                @endforeach
            </table>
            <div class="cart_val">
                <h4>Total Price of Cart: ${{$value}}</h4>

            </div>
        </div>
        
        
    </div>
    
    

    

  <!-- info section -->

  @include('home.info')

  <!-- end info section -->

  @include('home.javascript')

</body>

</html>