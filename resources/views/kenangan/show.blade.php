<!DOCTYPE html>
<html>

<head>
    <title>Detail Kenangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('/img/yo.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            color: white;
        }

        .cover-img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }

        .media-item {
            position: relative;
        }

        .media-item img,
        .media-item video {
            width: 100%;
            border-radius: 10px;
            transition: 0.3s;
        }

        .media-item img:hover,
        .media-item video:hover {
            transform: scale(1.05);
        }

        .btn-hapus {
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .preview-img {
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">

        <a href="/kenangan" class="btn btn-light mb-3">⬅ Kembali</a>

        <div class="card">

            <h2>{{ $data->judul }}</h2>

            @if($data->foto)
            <img src="{{ asset('storage/'.$data->foto) }}" class="cover-img mb-3 shadow">
            @endif

            <p>{{ $data->deskripsi }}</p>
            <p><b>👤 {{ $data->nama_teman }}</b></p>

            <hr>

            <!-- 📤 UPLOAD -->
            <h4>📤 Upload Media</h4>

            <form action="/upload/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" name="file[]" multiple
                    class="form-control mb-2"
                    onchange="preview(event)">

                <div id="preview" class="row mb-2"></div>

                <button class="btn btn-primary">Upload Media</button>
            </form>

            <hr>

            <!-- 📸 GALLERY -->
            <h4> Gallery </h4>

            <div class="row">
                @foreach($data->media as $m)
                <div class="col-md-3 mb-3 media-item">

                    @if($m->tipe == 'foto')
                    <img src="{{ asset('storage/'.$m->file) }}">
                    @else
                    <video controls>
                        <source src="{{ asset('storage/'.$m->file) }}">
                    </video>
                    @endif

                    <!-- 🔥 HAPUS MEDIA -->
                    <button onclick="hapusMedia('{{ $m->id }}')"
                        class="btn btn-danger btn-sm btn-hapus">
                        🗑
                    </button>

                </div>
                @endforeach
            </div>

            <hr>

            <!-- 💬 KOMENTAR -->
            <h5>💬 Komentar</h5>

            @foreach($data->komentar as $c)
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span><b>{{ $c->nama }}</b>: {{ $c->isi }}</span>

                <!-- 🔥 HAPUS KOMENTAR -->
                <button onclick="hapusKomentar('{{ $c->id }}')"
                    class="btn btn-danger btn-sm">
                    🗑
                </button>
            </div>
            @endforeach

        </div>

    </div>

    <script>
        function preview(e) {
            let preview = document.getElementById('preview');
            preview.innerHTML = '';

            Array.from(e.target.files).forEach(file => {
                let url = URL.createObjectURL(file);

                preview.innerHTML += `
            <div class="col-3">
                <img src="${url}" class="img-fluid preview-img">
            </div>
        `;
            });
        }

        // 🔥 HAPUS MEDIA
        function hapusMedia(id) {
            if (confirm('Hapus media ini? 😢')) {
                window.location = '/media/hapus/' + id;
            }
        }

        // 🔥 HAPUS KOMENTAR
        function hapusKomentar(id) {
            if (confirm('Hapus komentar ini?')) {
                window.location = '/komentar/hapus/' + id;
            }
        }
    </script>

</body>

</html>