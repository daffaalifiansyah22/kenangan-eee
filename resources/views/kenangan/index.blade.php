<!DOCTYPE html>
<html>

<head>
    <title>Kenangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- 🎵 MUSIC -->
    <audio id="bgMusic" loop>
        <source src="/music/lagu.mp3" type="audio/mpeg">
    </audio>

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
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        .card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.2),
                    transparent);
        }

        .card-title,
        .card-text,
        .text-muted {
            color: #fff;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }

        .card-img-top {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }

        .komentar-box {
            max-height: 120px;
            overflow-y: auto;
            font-size: 14px;
        }

        .komentar-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 10px;
            margin-bottom: 5px;
            border-radius: 8px;
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

        <h1 class="text-center mb-4 text-white">tolak balak moment</h1>

        <div class="text-center mb-4">
            <a href="/tambah" class="btn btn-primary">+ Tambah</a>
            <button onclick="toggleMusic()" class="btn btn-success">🎵</button>
        </div>

        <div class="row">
            @foreach($data as $k)
            <div class="col-md-4">
                <div class="card mb-4">

                    @if($k->foto)
                    <a href="/kenangan/{{ $k->id }}">
                        <img src="{{ asset('storage/'.$k->foto) }}" class="card-img-top">
                    </a>
                    @endif

                    <div class="card-body">

                        <h5 class="card-title">{{ $k->judul }}</h5>
                        <p class="card-text">{{ $k->deskripsi }}</p>

                        <p class="text-muted">📅 {{ $k->created_at->format('d M Y') }}</p>
                        <p class="text-muted">👤 {{ $k->nama_teman }}</p>

                        <!-- 📂 MASUK FOLDER -->
                        <a href="/kenangan/{{ $k->id }}" class="btn btn-info btn-sm w-100 mb-3">
                             Buka 
                        </a>

                        <!-- 📤 UPLOAD + PREVIEW (SATU FORM) -->
                        <form action="/upload/{{ $k->id }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="file[]" multiple
                                class="form-control mb-2"
                                onchange="preview(event, 'preview{{ $k->id }}')">

                            <!-- preview -->
                            <div id="preview{{ $k->id }}" class="row mb-2"></div>

                            <button class="btn btn-success btn-sm w-100">
                                Upload Media
                            </button>
                        </form>

                        <hr>

                        <!-- 💬 KOMENTAR -->
                        <div class="komentar-box mb-2">
                            @foreach($k->komentar as $c)
                            <div class="komentar-item">
                                <b>{{ $c->nama }}</b>: {{ $c->isi }}
                            </div>
                            @endforeach
                        </div>

                        <form action="/komentar/{{ $k->id }}" method="POST">
                            @csrf
                            <input type="text" name="nama" class="form-control mb-1" placeholder="Nama" required>
                            <input type="text" name="isi" class="form-control mb-2" placeholder="Komentar" required>
                            <button class="btn btn-primary btn-sm w-100">Kirim</button>
                        </form>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="/edit/{{ $k->id }}" class="btn btn-warning btn-sm">Edit</a>
                            <button onclick="hapus('{{ $k->id }}')" class="btn btn-danger btn-sm">Hapus</button>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <script>
        const music = document.getElementById('bgMusic');

        function toggleMusic() {
            music.paused ? music.play() : music.pause();
        }

        function hapus(id) {
            if (confirm('Yakin? 😢')) {
                window.location = '/hapus/' + id;
            }
        }

        // ✅ preview fix (per card, gak tabrakan)
        function preview(e, id) {
            let preview = document.getElementById(id);
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
    </script>

</body>

</html>