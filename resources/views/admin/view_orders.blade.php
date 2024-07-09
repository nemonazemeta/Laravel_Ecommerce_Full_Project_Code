<!DOCTYPE html>
<html>
  <head> 
    @include('admin.cssadmin')

    <style>
        .table_div{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 100px;
            margin-top: 50px;
        }
        table{
            border:2px solid skyblue;
            text-align: center;
        }
        th{
            background-color: skyblue;
            padding: 10px;
            font-size:14px;
            font-weight: bold;
            text-align: center;
            color: white;
        }
        td{
            padding: 5px;
            font-size:10px;
            font-weight: bold;
            text-align: center;
            color: white;
            border:1px solid yellowgreen;
        }
        .status{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* .status a{
            display:block
        } */
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

          <div class="table_div">
            <table>
                <tr>
                    <th>S.NO</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Print PDF</th>
                </tr>
                @php
                    $count = 0;
                @endphp
                @foreach($data as $data)
                @php
                    $count++;
                @endphp
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->rec_address}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->product->title}}</td>
                    <td>{{$data->product->price}}</td>
                    <td>
                        <img height="120" width="120" src="products/{{$data->product->image}}" alt="Image not found">
                    </td>
                    <td>
                        @if($data->status == 'in progress')
                            <span style="color:red">{{$data->status}}</span>

                        @elseif($data->status == 'On the Way')
                            <span style="color:aqua">{{$data->status}}</span>
                        @else
                        <span style="color:green;font-weight:bolder">{{$data->status}}</span>
                        @endif

                    </td>
                    <td>
                        <div class="status">
                            <a class="btn btn-primary" href="{{url('on_the_way',$data->id)}}">On the Way</a>&nbsp&nbsp&nbsp
                            <a class="btn btn-success" href="{{url('delivered',$data->id)}}">Delivered</a>
                        </div>
                    </td>
                    <td>
                        <div class="status">
                            <a href="{{url('print_pdf',$data->id)}}" class="btn btn-secondary">Print PDF</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
          </div>
          
      </div>
    </div>
  </div>
    <!-- JavaScript files-->
    @include('admin.javascript')
  </body>
</html>