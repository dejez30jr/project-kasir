


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Artikel</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 30px;
            line-height: 1.6;
            font-size: 13px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
        .section {
            margin-top: 20px;
        }
        .label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        .value {
            display: inline-block;
            width: 400px;
            border-bottom: 1px dotted #000;
        }
        .content-box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 10px;
            white-space: pre-line;
            text-align: justify;
        }
    </style>
</head>
<body>

    <h2 class="title">DATA SPMB</h2>

    <div class="section">
          @foreach ($artikels as $index => $artikel)
        <p><span class="label">Judul Artikel</span>: <span class="value">{{ $artikel->title }}</span></p>
        <p><span class="label">Slug</span>: <span class="value">{{ $artikel->slug }}</span></p>
        <p><span class="label">Penulis</span>: <span class="value">{{ $artikel->author }}</span></p>
        <p><span class="label">Tag Konten</span>: <span class="value">{{ $artikel->ketegori }}</span></p>
        <p><span class="label">Tanggal Dibuat</span>: <span class="value">{{ $artikel->created_at->format('d M Y') }}</span></p>
        @endforeach
    </div>

    <div class="section">
        <strong>Isi Artikel:</strong>
        <div class="content-box">
            {!! $artikel->content !!}
        </div>
    </div>

</body>
</html>
