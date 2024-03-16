<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Form Tambah Data User</h1>
    <form action="tambah_simpan" method="post">

        {{csrf_field()}}

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukan Username">
        <br>

        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukan Nama">
        <br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukan Password">
        <br>

        <label>Level ID</label>
        <input type="number" name="level_id" placeholder="Masukan ID Level">
        <br>

        <input type="submit" value="Simpan" class="btn btn-success">

    </form>
</body>

</html>