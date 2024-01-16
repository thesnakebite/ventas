<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">
        {{ config('app.name'), 'Ventas' }}
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->imagen }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('users.show', auth()->user()) }}" class="d-block">
                    {{ auth()->user()->name }}
                </a>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sales.create') }}" class="nav-link">
                                <i class="fas fa-cart-plus nav-icon"></i>
                                <p>Crear venta</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>Mostrar ventas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            Categorías
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clients') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>