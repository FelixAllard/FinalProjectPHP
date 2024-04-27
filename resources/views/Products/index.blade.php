<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel=”stylesheet” href=”https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css”rel=”nofollow” integrity=”sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm” crossorigin=”anonymous”>
    <title>Document</title>
</head>
<body>
    <h1>
        Welcome to the grocery store!
    </h1>
    <div>
        <table border="1">
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Description
                </th>
                <th>
                    price
                </th>
                <th>
                    Quantity
                </th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>
                        {{$product->id}}
                    </td>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        {{$product->description}}
                    </td>
                    <td>
                        {{$product->price}}
                    </td>
                    <td>
                        {{$product->quantity}}
                    </td>
                </tr>
            @endforeach
            </table>
    </div>
</body>
</html>
