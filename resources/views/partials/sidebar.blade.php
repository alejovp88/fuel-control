<div id="sidebar" class="d-flex">
    <div class="sidebar-content js-simplebar">
        <div class="sidebar-brand" href="#">
            <span class="align-middle" style="color: #fff">E/S Duaca</span>
        </div>

        <div class="menu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link p-3" href="/dashboard">
                        <i class="fas fa-th me-1"></i>
                        Tablero
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-3" href="/daily">
                        <i class="fas fa-clipboard-list me-1"></i>Control Diario
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-3" href="{{ route('inventario.create') }}">
                        <i class="fas fa-truck-moving me-1"></i>Recepci&oacute;n <br>Inventario
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-3">
                        <i class="fas fa-chart-line me-1"></i>Reportes
                    </a>
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reporte.diario') }}">
                                <i class="fas fa-calendar-day me-1"></i>Diario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reporte.personalizado') }}">
                                <i class="fas fa-calendar-alt me-1"></i>Personalizado
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reporte.inventario') }}">
                                <i class="fas fa-boxes me-1"></i>Recepci&oacute;n <br>Inventario
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-3" href="{{ route('rubros') }}">
                        <i class="fas fa-list me-1"></i>Rubros
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-3" href="{{ route('usuarios') }}">
                        <i class="fas fa-users me-1"></i>Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-3" href="/logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Salir
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
