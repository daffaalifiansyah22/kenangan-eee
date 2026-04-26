<!DOCTYPE html>
<html>

<head>
    <title>Tambah Kenangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #fbc2eb, #a6c1ee);
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 15px;
        }

        h1 {
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card shadow p-4 col-md-6 mx-auto">
        <h2 class="text-center mb-4">Tambah Kenangan 📸</h2>

        <form action="/kenangan" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <div class="mb-3">
                <label>Nama Teman</label>
                <input type="text" name="nama_teman" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Simpan</button>

            <a href="/kenangan" class="btn btn-secondary w-100 mt-2">Kembali</a>
        </form>
    </div>

</div>

</body>
</html>