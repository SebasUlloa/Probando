<!doctype html>
<html lang="en">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h5 class=" font-weight-bold">Resumen</h5>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th scope="col">Name</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cant. de surcos</th>
                    <th scope="col">Distancia entre surcos(en metros)</th>
                    <th scope="col">Doble Line</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($crucianelli as $crucianelli)
                <tr>
                    <td>{{ $crucianelli->machineId }}</td>
                    <td>{{ $crucianelli->name }}</td>
                    <td>{{ $crucianelli->description }}</td>
                    <td>{{ $crucianelli->rowsQty }}</td>
                    <td>{{ $crucianelli->rowsFixedDistance }}</td>
                    <td>{{ $crucianelli->doubleLineConfigs }}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
