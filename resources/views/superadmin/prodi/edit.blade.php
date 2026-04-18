<!DOCTYPE html>
<html>

<head>
    <title>Edit Prodi</title>
</head>

<body>
    @include('sidebar')

    <h2>Edit Prodi</h2>

    <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Prodi</label><br>
        <input type="text" name="nama_prodi" value="{{ $prodi->nama_prodi }}">
        <br><br>

        @error('nama_prodi')
            <div style="color:red;">{{ $message }}</div>
        @enderror

        <br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('prodi.index') }}">Kembali</a>

</body>

</html>
