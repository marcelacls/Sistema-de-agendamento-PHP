<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica Dentária')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <div class="header-content">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-text">
                <span class="brand-name">Clínica Dentária</span>
                <span class="brand-sub">Sistema de Gestão</span>
            </div>
        </a>
        <nav>
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active' : '' }}">Início</a>
            <a href="{{ route('pacientes.index') }}"
               class="{{ request()->routeIs('pacientes.*') ? 'active' : '' }}">Pacientes</a>
            <a href="{{ route('dentistas.index') }}"
               class="{{ request()->routeIs('dentistas.*') ? 'active' : '' }}">Dentistas</a>
            <a href="{{ route('consultas.index') }}"
               class="{{ request()->routeIs('consultas.*') ? 'active' : '' }}">Consultas</a>
        </nav>
    </div>
</header>

<main class="container">

    @if(session('sucesso'))
        <div class="alert alert-sucesso">{{ session('sucesso') }}</div>
    @endif

    @if(session('erro'))
        <div class="alert alert-erro">{{ session('erro') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-erro">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</main>

<footer>
    Marcela Cabral — 2026
</footer>

</body>
</html>
