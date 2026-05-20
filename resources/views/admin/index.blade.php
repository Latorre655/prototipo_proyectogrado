<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f4ff; color: #1a3a6e; }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #1e3a5f;
        }
        header h1 { color: white; font-size: 20px; }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.95rem;
        }
        .btn-logout:hover { background-color: #a71d2a; }

        .tabs {
            display: flex;
            background: #1a3a6e;
            padding: 0 40px;
        }
        .tab {
            padding: 12px 28px;
            color: #a0b4d6;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
        }
        .tab:hover { color: white; }
        .tab.active { color: white; border-bottom: 3px solid #4a9eff; }

        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .container { max-width: 960px; margin: 40px auto; padding: 0 20px; }

        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h2 { margin-bottom: 20px; color: #1a3a6e; }
        h3 { margin-bottom: 12px; color: #1a3a6e; }

        .alert-success {
            background: #d4edda; color: #155724;
            padding: 12px 16px; border-radius: 6px; margin-bottom: 20px;
        }
        .alert-error {
            background: #f8d7da; color: #721c24;
            padding: 12px 16px; border-radius: 6px; margin-bottom: 20px;
        }

        form .row { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 16px; }
        form .field { display: flex; flex-direction: column; flex: 1; min-width: 180px; }
        label { font-size: 13px; margin-bottom: 6px; font-weight: bold; }
        input[type="text"], input[type="password"], select {
            padding: 10px 12px; border: 1px solid #ccd;
            border-radius: 6px; font-size: 15px;
        }

        .btn { padding: 10px 24px; border: none; border-radius: 6px; cursor: pointer; font-size: 15px; font-weight: bold; }
        .btn-primary { background: #2e5ca8; color: white; }
        .btn-primary:hover { background: #1a3a6e; }
        .btn-danger { background: #dc3545; color: white; font-size: 13px; padding: 6px 14px; }
        .btn-danger:hover { background: #a71d2a; }

        table { width: 100%; border-collapse: collapse; }
        th { background: #1a3a6e; color: white; padding: 12px 16px; text-align: left; }
        td { padding: 12px 16px; border-bottom: 1px solid #e0e6f0; }
        tr:hover td { background: #f0f4ff; }

        .badge {
            background: #e0e6f0; color: #1a3a6e;
            padding: 3px 10px; border-radius: 20px; font-size: 13px;
        }
        .badge-green { background: #d4edda; color: #155724; }
        .badge-blue  { background: #cce5ff; color: #004085; }
        .badge-red   { background: #f8d7da; color: #721c24; }

        .roles-grid { display: flex; gap: 20px; flex-wrap: wrap; }
        .rol-card {
            flex: 1; min-width: 280px;
            border: 1px solid #e0e6f0;
            border-radius: 8px; padding: 20px;
        }
        .rol-card h3 { text-transform: capitalize; margin-bottom: 6px; }
        .rol-card > p { font-size: 13px; color: #666; margin-bottom: 14px; }

        .permiso-item {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 10px 0; border-bottom: 1px solid #f0f4ff;
        }
        .permiso-item:last-of-type { border-bottom: none; }
        .permiso-item input[type="checkbox"] { margin-top: 3px; cursor: pointer; }
        .permiso-item label { cursor: pointer; margin: 0; font-weight: normal; }
        .permiso-nombre { font-weight: bold; font-size: 14px; }
        .permiso-desc { font-size: 12px; color: #888; }

        .empty { text-align: center; color: #888; padding: 20px; }
    </style>
</head>
<body>

<header>
    <h1>🎮 Panel de Administración — HackSoft</h1>
    <form action="/docente/logout" method="POST">
        @csrf
        <button type="submit" class="btn-logout">🔒 Cerrar sesión</button>
    </form>
</header>

<div class="tabs">
    <div class="tab active" onclick="switchTab('estudiantes', this)">👥 Usuarios</div>
    <div class="tab" onclick="switchTab('dashboard', this)">📊 Dashboard</div>
</div>

{{-- PESTAÑA USUARIOS --}}
<div id="tab-estudiantes" class="tab-content active">
    <div class="container">

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

        <div class="card">
            <h2>Agregar Usuario</h2>
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
                    <div class="field">
                        <label>Rol</label>
                        <select name="role_id" required>
                            <option value="">-- Seleccionar rol --</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ ucfirst($rol->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">+ Agregar usuario</button>
            </form>
        </div>

        <div class="card">
            <h2>Usuarios registrados <span class="badge">{{ count($students) }}</span></h2>
            <table>
                <thead>
                    <tr><th>#</th><th>Nombre</th><th>Usuario</th><th>Rol</th><th>Registrado</th><th>Acción</th></tr>
                </thead>
                <tbody>
                    @forelse($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->nombre }}</td>
                        <td><code>{{ $student->usuario }}</code></td>
                        <td>
                            @if($student->role_id == 1)
                                <span class="badge badge-blue">Docente</span>
                            @else
                                <span class="badge">Estudiante</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($student->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <form action="/admin/delete/{{ $student->id }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar a {{ $student->nombre }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="empty">No hay usuarios registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<div id="tab-dashboard" class="tab-content">
    <div class="container">

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="card">
            <h2>🔐 Roles y Permisos</h2>
            <div class="roles-grid">
                @foreach($roles as $rol)
                <div class="rol-card">
                    <h3>{{ $rol->nombre }}</h3>
                    <p>{{ $rol->descripcion }}</p>
                    <form action="/admin/permisos/{{ $rol->id }}" method="POST">
                        @csrf
                        @foreach($todosLosPermisos as $permiso)
                        <div class="permiso-item">
                            <input
                                type="checkbox"
                                name="permisos[]"
                                value="{{ $permiso->id }}"
                                id="perm_{{ $rol->id }}_{{ $permiso->id }}"
                                {{ $rol->permisos->contains('id', $permiso->id) ? 'checked' : '' }}
                            >
                            <label for="perm_{{ $rol->id }}_{{ $permiso->id }}">
                                <div class="permiso-nombre">{{ $permiso->nombre }}</div>
                                <div class="permiso-desc">{{ $permiso->descripcion }}</div>
                            </label>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary" style="margin-top: 16px; width: 100%;">
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <h2>🟢 Estudiantes Activos <span class="badge">{{ count($estudiantesActivos) }}</span></h2>
            <table>
                <thead>
                    <tr><th>#</th><th>Nombre</th><th>Usuario</th><th>Último acceso</th><th>Tutorial</th></tr>
                </thead>
                <tbody>
                    @forelse($estudiantesActivos as $index => $est)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $est->nombre }}</td>
                        <td><code>{{ $est->usuario }}</code></td>
                        <td>
                            @if($est->ultimo_acceso)
                                {{ \Carbon\Carbon::parse($est->ultimo_acceso)->format('d/m/Y H:i') }}
                            @else
                                <span style="color:#aaa;">Sin acceso aún</span>
                            @endif
                        </td>
                        <td>
                            @if($est->tutorial_completado)
                                <span class="badge badge-green">✅ Completado</span>
                            @else
                                <span class="badge">⏳ Pendiente</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="empty">No hay estudiantes registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2>📋 Actividad Reciente</h2>
            <table>
                <thead>
                    <tr><th>#</th><th>Usuario</th><th>Nombre</th><th>Acción</th><th>Detalle</th><th>Fecha</th></tr>
                </thead>
                <tbody>
                    @forelse($actividades as $index => $act)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><code>{{ $act->usuario }}</code></td>
                        <td>{{ $act->nombre }}</td>
                        <td><span class="badge badge-blue">{{ $act->tipo }}</span></td>
                        <td>{{ $act->detalle }}</td>
                        <td>{{ \Carbon\Carbon::parse($act->fecha)->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="empty">No hay actividad registrada aún.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    function switchTab(tab, el) {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        el.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const params = new URLSearchParams(window.location.search);
        if (params.get('tab') === 'dashboard') {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.getElementById('tab-dashboard').classList.add('active');
            document.querySelectorAll('.tab')[1].classList.add('active');
        }
    });
</script>

</body>
</html>