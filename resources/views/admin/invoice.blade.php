<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <br>
        <h3>Customer Name: {{$data->name}}</h3><br>
        <h3>Customer Address: {{$data->rec_address}}</h3><br>
        <h3>Customer Phone: {{$data->phone}}</h3><br>
        <h2>Product Title : {{$data->product->title}}</h2><br>
        <h2>Product Price : {{$data->product->price}}</h2><br>
        <img height="300" width="500" src="products/{{$data->product->image}}" alt="Image not found">


    </center>
</body>
</html>