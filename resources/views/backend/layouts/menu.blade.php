<div class="app-bar fixed-top" data-role="appbar">
        <a  class="app-bar-element branding 
            {{ Request::segment(2) == 'dashboard'?'active-menu':false}}"
            href="{{ route('backend.dashboard') }}">Sistema Base</a>

        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu">
            <li data-flexorderorigin="0" data-flexorder="1"><a href="">Mi Web</a></li>

			<!-- USUARIO -->
    @if(Auth::user()->forzar_clave)
            @if(Auth::user()->can('permiso_usuario'))
            <li data-flexorderorigin="1" data-flexorder="2">
                <a  class="dropdown-toggle 
                    {{ Request::segment(2) == 'usuario'?'active-menu':false}}
                    {{ Request::segment(2) == 'trabajador'?'active-menu':false}}">Usuario</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="{{ route('backend.usuario.index') }}">Gestionar Usuario</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.trabajador.index') }}">Gestionar Trabajador</a></li>
                    
                </ul>
            </li>
            @endif


            <!-- GALERIA -->
            @if(Auth::user()->can('permiso_albun'))
            <li data-flexorderorigin="1" data-flexorder="2">
                <a  class="dropdown-toggle 
                    {{ Request::segment(2) == 'galeria'?'active-menu':false}}
                    {{ Request::segment(2) == 'galeria_categoria'?'active-menu':false}}">Galería</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="{{ route('backend.galeria.index') }}">Gestionar Galería</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.galeria_categoria.index') }}">Gestionar Categoría</a></li>
                    
                </ul>
            </li>
            @endif
            
            <!-- BLOG -->
            @if(Auth::user()->can('permiso_publicacion'))
            <li data-flexorderorigin="2" data-flexorder="3">
                <a class="dropdown-toggle
                    {{ Request::segment(2)=='blog'?'active-menu':false}}
                    {{ Request::segment(2)=='blog_categoria'?'active-menu':false}}">Blog</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="{{ route('backend.blog.index') }}">Gestionar Blog</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.blog_categoria.index') }}">Gestionar Categoría</a></li>
                    
                </ul>
            </li>
            @endif
            
            <!-- CATALOGO -->
            @if(Auth::user()->can('permiso_producto'))
            <li data-flexorderorigin="3" data-flexorder="4">
                <a  class="dropdown-toggle
                    {{ Request::segment(2)=='subcategoria_producto'?'active-menu':false}}
                    {{ Request::segment(2)=='producto'?'active-menu':false}}
                    {{ Request::segment(2)=='catalogo_categoria'?'active-menu':false}}">Catologo</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="{{ route('backend.producto.index') }}">Gestionar Producto</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.subcategoria_producto.index') }}">Gestionar Sub Categorías</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('backend.catalogo_categoria.index') }}">Gestionar Categoría</a></li>
                    
                </ul>
            </li>
            @endif

            <!-- SITIO -->
            @if(Auth::user()->can('permiso_sitio'))
            <li data-flexorderorigin="4" data-flexorder="5">
                <a href="" class="dropdown-toggle {{ Request::segment(2)=='empresa'?'active-menu':false}}">Empresa</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="{{ route('backend.empresa.create') }}">Registrar Empresa</a></li>
                </ul>
            </li>
            @endif

    @endif
        </ul>

        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span> {{ Auth::User()->username }}</span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
                <h2 class="text-light">Mi Tablero</h2>
                <ul class="unstyled-list fg-dark">
                    <!-- <li><a href="" class="fg-white1 fg-hover-yellow">Profile</a></li>
                    <li><a href="" class="fg-white2 fg-hover-yellow">Security</a></li> -->
                    <li><a href="{{ route('auth.logout')}}" class="fg-white3 fg-hover-yellow">Exit</a></li>
                </ul>
            </div>
        </div>
    <div class="app-bar-pullbutton automatic" style="display: none;"></div>
    <div class="clearfix" style="width: 0;"></div>
    <nav class="app-bar-pullmenu hidden flexstyle-app-bar-menu" style="display: none;">
        <ul class="app-bar-pullmenubar hidden app-bar-menu"></ul>
    </nav></div>