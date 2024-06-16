<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-medicine-box"></i>
                    </span>
                    <span class="title">Obat</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'obat.index' ? 'active' : '' }}">
                        <a href="{{ route('obat.index') }}">Obat</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-contacts"></i>
                    </span>
                    <span class="title">Formasi</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'formasi.index' ? 'active' : '' }}">
                        <a href="{{ route('formasi.index') }}">Formasi</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-shop"></i>
                    </span>
                    <span class="title">Stok Obat</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'stok-obat.index' ? 'active' : '' }}">
                        <a href="{{ route('stok-obat.index') }}">Stok Obat</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-schedule"></i>
                    </span>
                    <span class="title">Perpindahan</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'perpindahan.index' ? 'active' : '' }}">
                        <a href="{{ route('perpindahan.index') }}">Perpindahan</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
