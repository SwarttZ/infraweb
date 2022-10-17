<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('backend/img/logoMobile.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Quality Sistemas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <h5 style="color:white;">Online: </h5><a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                <li class="nav-header">MONITOR</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-database"></i>
                        <p>
                            Servidores
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>Locais</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>Externos</p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-item">
                <li class="nav-header">BACKUPS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-database"></i>
                        <p>
                            Clientes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.clients.backup') }}" class="nav-link">
                                <p>Atrasados</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.clients.backup') }}" class="nav-link">
                                <p>Corrompidos</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                <li class="nav-header">CADASTROS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-server"></i>
                        <p>
                            Dispositivos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create.computer') }}" class="nav-link">
                                <i class="nav-icon fa fa-tv" aria-hidden="true" nav-icon></i>
                                <p>Computadores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create.printers') }}" class="nav-link">
                                <i class="nav-icon fa fa-print" aria-hidden="true" nav-icon></i>
                                <p>Impressoras</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create.monitor') }}" class="nav-link">
                                <i class="nav-icon fa fa-tv" aria-hidden="true" nav-icon></i>
                                <p>Monitores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create.switch') }}" class="nav-link">
                                <i class="nav-icon fa fa-server" aria-hidden="true" nav-icon></i>
                                <p>Switch/Roteadores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fire" aria-hidden="true" nav-icon></i>
                                <p>Firewall</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create.server') }}" class="nav-link">
                                <i class="nav-icon fa fa-terminal" aria-hidden="true" nav-icon></i>
                                <p>Servidores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-truck" aria-hidden="true" nav-icon></i>
                                <p>Fornecedores</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <hr>
                <li class="nav-item">
                <li class="nav-header">RELATÓRIOS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-server"></i>
                        <p>
                            Todos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.list.users') }}" class="nav-link">
                                <i class="nav-icon fa fa-user" aria-hidden="true" nav-icon></i>
                                <p>Usuários</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.show.all.computers') }}" class="nav-link">
                                <i class="nav-icon fa fa-tv" aria-hidden="true" nav-icon></i>
                                <p>Computadores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.list.printers') }}" class="nav-link">
                                <i class="nav-icon fa fa-print" aria-hidden="true" nav-icon></i>
                                <p>Impressoras</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.list.monitor') }}" class="nav-link">
                                <i class="nav-icon fa fa-tv" aria-hidden="true" nav-icon></i>
                                <p>Monitores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.list.router') }}" class="nav-link">
                                <i class="nav-icon fa fa-server" aria-hidden="true" nav-icon></i>
                                <p>Switch/Roteadores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-fire" aria-hidden="true" nav-icon></i>
                                <p>Firewall</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.list.server') }}" class="nav-link">
                                <i class="nav-icon fa fa-terminal" aria-hidden="true" nav-icon></i>
                                <p>Servidores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-truck" aria-hidden="true" nav-icon></i>
                                <p>Fornecedores</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cogs" aria-hidden="true" nav-icon></i>
                                <p>Gerar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <hr>
                @foreach($users as $user)
                @if($user->level > 1)
                <li class="nav-header">ADMIN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.create.user') }}" class="nav-link">
                        <i class="fa fa-user-document nav-icon"></i>
                        <p>Criar novo usuário</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.profile.user') }}" class="nav-link">
                        <i class="fa fa-user-document nav-icon"></i>
                        <p>Conta</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.backup.show') }}" class="nav-link">
                        <i class="fa fa-user-document nav-icon"></i>
                        <p>Backup</p>
                    </a>
                </li>
                @endif
                @endforeach
                <li class="nav-item">
                    <a href="{{ route('dashboard.logout') }}" class="nav-link">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <p>Sair</p>
                    </a>
                </li>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
