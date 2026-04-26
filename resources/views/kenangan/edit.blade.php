<!DOCTYPE html>
<html>
<head>
    <title>Edit Kenangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Edit Kenangan</h1>

    <form action="/update/{{ $data->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="judul" value="{{ $data->judul }}" class="form-control mb-2">

        <textarea name="deskripsi" class="form-control mb-2">{{ $data->deskripsi }}</textarea>

        <input type="file" name="foto" class="form-control mb-2">

        <input type="text" name="nama_teman" value="{{ $data->nama_teman }}" class="form-control mb-2">

        <button class="btn btn-success">Update</button>
    </form>
</div>

</body>
</html>