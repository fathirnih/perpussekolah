<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Internal</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f1f5fb;
            color: #1c3552;
        }
        .box {
            width: min(420px, 92%);
            background: #fff;
            border: 1px solid #d8e2ef;
            border-radius: 14px;
            padding: 22px;
        }
        h1 { margin: 0 0 8px; font-size: 24px; }
        p { margin: 0 0 16px; color: #4b6584; font-size: 14px; }
        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd8ea;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        button {
            width: 100%;
            padding: 11px 12px;
            border: 0;
            border-radius: 10px;
            background: #204c84;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }
        a { display: inline-block; margin-top: 12px; color: #204c84; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <form class="box" method="POST" action="{{ route('login.internal.post') }}">
        @csrf
        <h1>Login Internal</h1>
        <p>Khusus admin dan petugas.</p>
        @if($errors->any())
            <p style="margin-top:-4px; margin-bottom:12px; padding:10px; border-radius:8px; background:#fee2e2; color:#991b1b; font-size:13px;">
                {{ $errors->first() }}
            </p>
        @endif
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Masuk</button>
        <a href="{{ url('/') }}">Kembali ke beranda</a>
    </form>
</body>
</html>
