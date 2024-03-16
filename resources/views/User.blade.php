<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Level Pengguna</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
    }
</style>

<body>
    <h1>Data User</h1>
    <table>
        <thead>
            <th>Jumlah Pengguna</th>
        </thead>
        <tbody>
            <td>{{$data}}</td>
        </tbody>
    </table>
</body>

</html>