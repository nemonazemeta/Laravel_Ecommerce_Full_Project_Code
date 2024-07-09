<!DOCTYPE html>
<html>
  <head> 
    @include('admin.cssadmin')

    <style>
        .productTableDeg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .table_deg{
            border: 2px solid greenyellow;
        }

        th{
            background: skyblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td{
            border: 1px solid skyblue;
            text-align: center;
            color: white;
        }

        input[type='search']{
            width: 400px;
            height: 50px;
            margin-left: 50px;
            border-radius: 15px;
        }
    </style>
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

            <form action="{{url('product_search')}}" method="get">
                @csrf
                    <input type="search" name="search">
                    <input class="btn btn-primary" type="submit" value="Search">
            </form>
            <div class="productTableDeg">
                <table class="table_deg">
                    <tr>
                        <th>S.NO</th>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th> 
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @php
                        $count = 0;
                    @endphp
                    @foreach($data as $datas)
                        @php
                            $count++;
                        @endphp
                        
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$datas->title}}</td>
                            <td>{!! Str::limit($datas->description,30)!!}</td>
                            <td>{{$datas->category}}</td>
                            <td>{{$datas->price}}</td>
                            <td>{{$datas->quantity}}</td>
                            <td>
                                <img height="120" width="120" src="products/{{$datas->image}}" alt="image not found">
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{url('edit_product',$datas->id)}}">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_product',$datas->id)}}">Delete</a>
                            </td>
                           
                        </tr>

                    @endforeach
                    
                </table>
            </div>

            <div class="productTableDeg">
                {{$data->onEachSide(1)->links()}}
            </div>
      </div>
    </div>
  </div>
    <!-- JavaScript files-->

    @include('admin.javascript')
  </body>
</html>