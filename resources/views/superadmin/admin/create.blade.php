<!DOCTYPE html>
<html>

<head>
    <title>Tambah Admin</title>
</head>

<body>

    @include('sidebar')

    <div style="margin-left:220px; padding:20px;">

        <h2>Tambah Admin</h2>

        <form method="POST" action="{{ route('admin-user.store') }}">
            @csrf

            <label>Nama</label><br>
            <input type="text" name="name"><br><br>

            <label>Email</label><br>
            <input type="email" name="email"><br><br>

            <label>Password</label><br>
            <input type="password" name="password"><br><br>

            <label>Prodi</label><br>
            <select name="prodi_id">
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->id }}">
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>

            <br><br>

            <button type="submit">Simpan</button>

        </form>

    </div>
</body>

</html>
