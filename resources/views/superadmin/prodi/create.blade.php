<!DOCTYPE html>
<html>

<head>
    <title>Tambah Prodi</title>
</head>

<body>
    @include('sidebar')

    <h2>Tambah Prodi</h2>

    <form action="{{ route('prodi.store') }}" method="POST">
        @csrf

        <label>Nama Prodi</label><br>
        <input type="text" name="nama_prodi">
        <br><br>

        @error('nama_prodi')
            <div style="color:red;">{{ $message }}</div>
        @enderror

        <br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('prodi.index') }}">Kembali</a>

</body>

</html>
