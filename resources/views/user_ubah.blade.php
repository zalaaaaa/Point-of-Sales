<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Form Ubah Data User</h1>
    <a href="../">Kembali</a>
    <form action="../ubah_simpan/{{$data->user_id}}" method="post">

        {{csrf_field()}}
        {{method_field('PUT')}}

        <label>Username</label>
        <input value="{{$data->username}}" type="text" name="username" placeholder="Masukan Username">
        <br>

        <label>Nama</label>
        <input value="{{$data->nama}}" type="text" name="nama" placeholder="Masukan Nama">
        <br>

        <label>Password</label>
        <input value="{{$data->password}}" type="password" name="password" placeholder="Masukan Password">
        <br>

        <label>Level ID</label>
        <input value="{{$data->level_id}}" type="number" name="level_id" placeholder="Masukan ID Level">
        <br>

        <input type="submit" value="Ubah" class="btn btn-success">

    </form>
</body>

</html>