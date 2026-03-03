<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Siswa</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #eef4fb;
            color: #163252;
        }
        .box {
            width: min(420px, 92%);
            background: #fff;
            border: 1px solid #d7e2f0;
            border-radius: 14px;
            padding: 22px;
        }
        h1 { margin: 0 0 8px; font-size: 24px; }
        p { margin: 0 0 16px; color: #496484; font-size: 14px; }
        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #c9d9ec;
            margin-bottom: 10px;
        }
        button {
            width: 100%;
            padding: 11px 12px;
            border: 0;
            border-radius: 10px;
            background: #1e4f8f;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }
        a { display: inline-block; margin-top: 12px; color: #1f4f8f; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <form class="box" method="POST" action="#">
        @csrf
        <h1>Login Siswa</h1>
        <p>Gunakan akun yang sudah dibuatkan oleh admin sekolah.</p>
        <p style="margin-top:-8px; margin-bottom:16px; padding:10px 12px; border-radius:10px; background:#fff7d6; color:#6b4f00; font-size:13px;">
            Password default siswa adalah <strong>password</strong>. Silakan ganti setelah berhasil login.
        </p>
        <input type="text" name="nisn" placeholder="NISN atau Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Masuk</button>
        <a href="{{ url('/') }}">Kembali ke beranda</a>
    </form>
</body>
</html>
