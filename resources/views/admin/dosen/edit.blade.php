<!DOCTYPE html>
<html>

<head>
    <title>Edit Dosen</title>
</head>

<body>
    @include('sidebar')

    <h2>Edit Dosen</h2>

    <form method="POST" action="{{ route('dosen.update', $dosen->id) }}">
        @csrf
        @method('PUT')

        <label>Nama</label><br>
        <input type="text" name="nama" value="{{ $dosen->nama }}"><br><br>

        <label>Bidang</label><br>
        <textarea name="bidang_keahlian">{{ $dosen->bidang_keahlian }}</textarea><br><br>

        <label>Kuota</label><br>
        <input type="number" name="kuota" value="{{ $dosen->kuota }}"><br><br>

        <button type="submit">Update</button>

    </form>

</body>

</html>
