<!DOCTYPE html>
<html>

<head>
    <title>Tambah Dosen</title>
</head>

<body>
    @include('sidebar')

    <h2>Tambah Dosen</h2>

    <form method="POST" action="{{ route('dosen.store') }}">
        @csrf

        <label>Nama</label><br>
        <input type="text" name="nama"><br><br>

        <label>Bidang Keahlian</label><br>
        <textarea name="bidang_keahlian"></textarea><br><br>

        <label>Kuota</label><br>
        <input type="number" name="kuota"><br><br>

        <button type="submit">Simpan</button>

    </form>

</body>

</html>
