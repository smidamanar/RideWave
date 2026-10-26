<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="theme-color" content="#ffffff">
    @include('partials.theme-init')
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        :root {
            --shell-bg: #f5f7fb;
            --surface-bg: #ffffff;
            --surface-border: #e5e7eb;
            --text-main: #14213d;
            --text-muted: #475569;
            --accent: #0f766e;
            --button-muted: #e2e8f0;
        }
        html[data-theme='dark'] {
            --shell-bg: #08111f;
            --surface-bg: #0f172a;
            --surface-border: #233042;
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --button-muted: #1e293b;
        }
        body { margin: 0; font-family: Arial, sans-serif; background: var(--shell-bg); color: var(--text-main); transition: background-color 0.2s ease, color 0.2s ease; }
        a { color: inherit; text-decoration: none; }
        .shell { min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 18px 28px; background: var(--surface-bg); border-bottom: 1px solid var(--surface-border); }
        .brand { font-size: 24px; font-weight: 700; color: var(--accent); }
        .actions { display: flex; gap: 12px; }
        .btn { border: 0; border-radius: 10px; padding: 10px 16px; font-weight: 600; cursor: pointer; }
        .btn-primary { background: var(--accent); color: #ffffff; }
        .btn-secondary { background: var(--button-muted); color: var(--text-main); }
        .theme-toggle { display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; border: 1px solid var(--surface-border); border-radius: 999px; padding: 0; background: var(--surface-bg); color: var(--text-main); cursor: pointer; font-weight: 600; }
        .theme-toggle .material-symbols-outlined { font-size: 20px; }
        .panel { max-width: 420px; margin: 48px auto; background: var(--surface-bg); border: 1px solid var(--surface-border); border-radius: 18px; padding: 28px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); }
        .field { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
        input, select { padding: 12px 14px; border-radius: 10px; border: 1px solid #cbd5e1; background: var(--surface-bg); color: var(--text-main); }
        .error-list, .flash { padding: 12px 14px; border-radius: 10px; margin-bottom: 18px; }
        .error-list { background: #fee2e2; color: #991b1b; }
        .flash { background: #dcfce7; color: #166534; }
        .footer-note { text-align: center; color: var(--text-muted); margin-top: 18px; }
    </style>
</head>
<body>
    <div class="shell">
        <header class="topbar">
            <a class="brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <div class="actions">
                @include('partials.theme-toggle-button')
                <a class="btn btn-secondary" href="{{ route('login') }}">Login</a>
                <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
    @include('partials.theme-toggle-script')
</body>
</html>
