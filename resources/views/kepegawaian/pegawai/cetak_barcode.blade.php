<!DOCTYPE html>
<html>
<head>
    <title>Barcode Pegawai</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .barcode-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .barcode-box {
            width: 200px;
            text-align: center;
            border: 1px solid #ccc;
            padding: 8px;
        }
        .barcode-box img {
            width: 100%;
        }
    </style>
</head>
<body>
    <h3>Daftar Barcode Pegawai</h3>
    <div class="barcode-container">
        @foreach($pegawai as $item)
            <div class="barcode-box">
                <strong>{{ $item->name }}</strong><br>
                <img src="data:image/png;base64,{{ $item->barcode_base64 }}"><br>
                <small>{{ $item->nip }}</small>
            </div>
        @endforeach
    </div>
</body>
</html>
