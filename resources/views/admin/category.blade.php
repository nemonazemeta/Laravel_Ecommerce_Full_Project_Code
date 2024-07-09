<!DOCTYPE html>
<html>
  <head> 
    @include('admin.cssadmin')
    <style>
        .addCategory {
            justify-content: left;
            align-items: center;
            display: flex;
        }
        input[type='text']{
            width:300px;
            height: 50px;
        }

        .tableDesign{
          text-align: center;
          margin: auto;
          border: 2px solid yellowgreen;
          margin-top: 50px;
          width: 800px;
        }
        th{
          background-color: skyblue;
          padding: 15px;
          font-size: 20px;
          font-weight: bold;
          color: white;
          border: 2px solid yellowgreen;
        }

        td{
          color: white;
          padding: 10px;
          border: 1px solid skyblue;
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
            
            <div class="addCategory">
                <h2 style="color:white">&nbsp&nbsp&nbsp&nbsp Add Category : &nbsp&nbsp&nbsp&nbsp</h2>
                <form action="{{url('add_category')}}" method="POST">
                  @csrf
                    <div>
                        <input type="text" name = "category">&nbsp&nbsp&nbsp&nbsp
                        <input class = "btn btn-primary" type="submit" value="Add Category">
                    </div>
                </form>
            </div>
            <div >
              <table class="tableDesign">
                <tr>
                  <th>S.No</th>
                  <th>Category Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Edit</th>
                  <th>Delete</th>
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
                  <td>{{$data->category_name}}</td>
                  <td>{{$data->created_at}}</td>
                  <td>{{$data->updated_at}}</td>
                  <td>
                    <a class="btn btn-success" href="{{url('edit_category',$data->id)}}">Edit</a>
                  </td>
                  <td>
                    <a class= "btn btn-danger" onclick="confirmation(event)" href="{{url('delete_category',$data->id)}}">Delete</a>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                  <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p>
                  </div>
              </footer>
      </div>
    </div>
  
    <!-- JavaScript files-->
    
    @include('admin.javascript')
  </body>
</html>