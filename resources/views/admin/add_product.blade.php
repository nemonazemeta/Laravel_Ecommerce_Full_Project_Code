<!DOCTYPE html>
<html>
  <head> 
    @include('admin.cssadmin')
    <style>
        .form_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        h1{
            color: white;
            font-weight: bolder;
        }
        label{
            display: inline-block;
            width: 200px;
            font-size: 18px! important;
            color: white! important;
            text-align: right;
            margin-right: 80px;
        }
        input[type="text"]{
            width:350px;
            height:50px;
        }
        #sub{
            width:200px;
            height:40px;
        }
        input[type="file"]{
            width:350px;
            height:50px;
        }
        .subButton{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        select{
            width:350px;
            height:50px;
            color: black;
        }

        textarea{
            width:350px;
            height:80px;
        }
        .inp_deg{
            padding:10px;
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
                <h1>Add Product</h1>
          <div class="form_deg">
            <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                 
                <div class="inp_deg">
                    <label for="title">Product Title : </label>
                    <input type="text" name="title" required>
                </div>
                <div class="inp_deg">
                    <label for="description">Description :</label>
                    <textarea name="description"  cols="30" required></textarea>
                </div>
                <div class="inp_deg">
                    <label for="price">Price :</label>
                    <input type="text" name = "price" required>
                </div>
                <div class="inp_deg">
                    <label for="quantity">Quantity :</label>
                    <input type="text" name="qty">
                </div>
                <div class="inp_deg">
                    <label for="category">Product Category :</label>
                    <select name="category" id="category">
                        <option>Select Category</option>
 
                        @foreach ($category as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inp_deg">
                    <label for="image">Product Image :</label>
                    <span><input type="file" name="image"></span>
                </div>
                <div class="inp_deg">
                    <div class="subButton">
                        <input class="btn btn-success" id="sub" type="submit" value="Add Category">
                    </div>
                </div>
                
            </form>

          </div>
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