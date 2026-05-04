<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f4ff; color: #1a3a6e; }

        header {
            background: #1a3a6e;
            color: white;
            padding: 20px 40px;
            font-size: 22px;
            font-weight: bold;
        }

        .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }

        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h2 { margin-bottom: 20px; color: #1a3a6e; }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        form .row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        form .field {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 180px;
        }

        label { font-size: 13px; margin-bottom: 6px; font-weight: bold; }

        input[type="text"], input[type="password"] {
            padding: 10px 12px;
            border: 1px solid #ccd;
            border-radius: 6px;
            font-size: 15px;
        }

        .btn {
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }

        .btn-primary { background: #2e5ca8; color: white; }
        .btn-primary:hover { background: #1a3a6e; }
        .btn-danger { background: #dc3545; color: white; font-size: 13px; padding: 6px 14px; }
        .btn-danger:hover { background: #a71d2a; }

        table { width: 100%; border-collapse: collapse; }
        th { background: #1a3a6e; color: white; padding: 12px 16px; text-align: left; }
        td { padding: 12px 16px; border-bottom: 1px solid #e0e6f0; }
        tr:hover td { background: #f0f4ff; }

        .badge {
            background: #e0e6f0;
            color: #1a3a6e;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<header>🎮 Panel de Administración — Estudiantes</header>

<div class="container">

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                ⚠️ {{ $error }}<br>
            @endforeach
        </div>
    @endif

    {{-- Formulario agregar --}}
    <div class="card">
        <h2>Agregar Estudiante</h2>
        <form action="/admin/store" method="POST">
            @csrf
            <div class="row">
                <div class="field">
                    <label>Nombre completo</label>
                    <input type="text" name="nombre" placeholder="Ej: Juan Pérez" required>
                </div>
                <div class="field">
                    <label>Usuario</label>
                    <input type="text" name="usuario" placeholder="Ej: juanp" required>
                </div>
                <div class="field">
                    <label>Contraseña</label>
                    <input type="password" name="contrasena" placeholder="Mínimo 4 caracteres" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">+ Agregar estudiante</button>
        </form>
    </div>

    {{-- Tabla de estudiantes --}}
    <div class="card">
        <h2>Estudiantes registrados <span class="badge">{{ count($students) }}</span></h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Registrado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->nombre }}</td>
                    <td><code>{{ $student->usuario }}</code></td>
                    <td>{{ \Carbon\Carbon::parse($student->created_at)->format('d/m/Y') }}</td>
                    <td>
                        <form action="/admin/delete/{{ $student->id }}" method="POST"
                              onsubmit="return confirm('¿Eliminar a {{ $student->nombre }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:#888;">
                        No hay estudiantes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>