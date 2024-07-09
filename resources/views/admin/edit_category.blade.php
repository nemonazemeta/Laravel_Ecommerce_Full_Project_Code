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
                <h2 style="color:white">&nbsp&nbsp&nbsp&nbsp Update Category : &nbsp&nbsp&nbsp&nbsp</h2>
                <form action="{{url('update_category', $data->id)}}" method="POST">
                  @csrf
                    <div>
                        <input type="text"  name = "editCategory" value="{{$data->category_name}}">&nbsp&nbsp&nbsp&nbsp
                        <input class = "btn btn-secondary"  type="submit" value="Update Category">
                        {{-- onclick="confirmation(events)" --}}
                    </div>
                </form>
            </div>
            
            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                  <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank" href="https://templateshub.net">Templates Hub</a>.</p>
                  </div>
              </footer>
      </div>
    </div>
  
    <!-- JavaScript files-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script>
    function confirmation(evt) {
        evt.preventDefault();
        var urlToRedirect = evt.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
    
        swal({
            title: "Are you sure you want to edit this category?",
            text: "This action will be reflected.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = urlToRedirect;
            }
        });
    }
    </script> --}}
    
    @include('admin.javascript')
  </body>
</html>