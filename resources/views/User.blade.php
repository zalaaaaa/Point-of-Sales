<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Level Pengguna</title>
</head>

<body>
    <h1>Data Level Pengguna</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
            <th>ID Level Pengguna</th>
        </tr>
        <td>{{$data->user_id}}</td>
        <td>{{$data->username}}</td>
        <td>{{$data->nama}}</td>
        <td>{{$data->level_id}}</td>
        </tr>
    </table>
</body>

</html>