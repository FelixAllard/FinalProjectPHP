<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>
    Create a product!
</h1>
<div>
    <!--
        if there is an error, prints it out here!

    {{--@if($error->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    @endif--}}
    -->
</div>
<form method="post" action="{{route('product.store')}}">
    @csrf
    @method('post')
    <div>
        <label>
            Name
        </label>
        <input type="text" name="name" placeholder="Name">
    </div>
    <div>
        <label>
            Description
        </label>
        <input type="text" name="description" placeholder="Description">
    </div>
    <div>
        <label>
            Price
        </label>
        <input type="text" name="price" placeholder="Price">
    </div>
    <div>
        <label>
            Quantity
        </label>
        <input type="text" name="quantity" placeholder="Quantity">
    </div>
    <div>
        <input type="submit" value="Add new Product!">
    </div>

</form>

</body>
</html>
