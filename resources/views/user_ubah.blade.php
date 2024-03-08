<!DOCTYPE html>
<html>
    <head>
        <title>Data User</title>
    </head>
    <body>
        <h1>Form Ubah Data User</h1>
        <form action="/user/ubah_simpan/{{ $data->user_id }}" method="post">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan Username" value="{{ $data->username }}">
            <br>
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Masukkan Nama" value="{{ $data->nama }}">
            <br>
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan Password" value="{{ $data->password }}">
            <br>
            <label>Level ID</label>
            <input type="text" name="level_id" placeholder="Masukkan ID Level" value="{{ $data->level_id }}">
            <br><br>
            <input type="submit" class="btn btn-success" value="simpan">

        </form>
    </body>
</html>