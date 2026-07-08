<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            text-align:center;
            padding:40px;
        }

        .certificate{
            border:8px solid #2563eb;
            padding:50px;
        }

        h1{
            color:#2563eb;
            font-size:40px;
            margin-bottom:30px;
        }

        h2{
            font-size:30px;
            margin:20px 0;
        }

        h3{
            font-size:24px;
            margin:20px 0;
        }

        .footer{
            margin-top:60px;
            width:100%;
            margin-bottom:60px;
        }

        .left{
            float:left;
            text-align:left;
        }

        .right{
            float:right;
            text-align:right;
        }
    </style>

</head>

<body>

<div class="certificate">

    <h1>SERTIFIKAT</h1>

    <p>Diberikan kepada</p>

    <h2>{{ $certificate->enrollment->user->name }}</h2>

    <p>Telah berhasil menyelesaikan kursus</p>

    <h3>{{ $certificate->enrollment->course->title }}</h3>

    <div class="footer">
        <div class="left">
            <strong>Tanggal Lulus</strong><br>
            {{ $certificate->created_at->format('d F Y') }}
        </div>

        <div class="right">
            <strong>No. Sertifikat</strong><br>
            {{ $certificate->certificate_number }}
        </div>
    </div>

</div>

</body>
</html>