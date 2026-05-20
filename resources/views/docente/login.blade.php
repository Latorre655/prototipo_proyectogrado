<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HackSoft — Panel Docente</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #0d1117;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
        .logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .logo h1 {
            color: #58a6ff;
            font-size: 28px;
            letter-spacing: 2px;
        }
        .logo p {
            color: #8b949e;
            font-size: 14px;
            margin-top: 6px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            color: #c9d1d9;
            font-size: 14px;
            margin-bottom: 6px;
        }
        input {
            width: 100%;
            padding: 10px 14px;
            background: #0d1117;
            border: 1px solid #30363d;
            border-radius: 6px;
            color: #c9d1d9;
            font-size: 15px;
            outline: none;
        }
        input:focus { border-color: #58a6ff; }
        .btn {
            width: 100%;
            padding: 12px;
            background: #238636;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }
        .btn:hover { background: #2ea043; }
        .error {
            background: #3d1a1a;
            border: 1px solid #f85149;
            color: #f85149;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 16px;
        }
        .back {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #8b949e;
        }
        .back a { color: #58a6ff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>⚡ HackSoft</h1>
            <p>Panel de administración docente</p>
        </div>

        @if($errors->any())
            <div class="error">⚠️ {{ $errors->first('error') }}</div>
        @endif

        <form method="POST" action="/docente/login">
            @csrf
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="usuario" placeholder="usuario docente" required autofocus>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="contrasena" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn">Iniciar sesión</button>
        </form>

        <div class="back">
            <a href="/">← Volver al simulador</a>
        </div>
    </div>
</body>
</html>