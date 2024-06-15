<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            {{-- <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">Report</a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
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
                    {{-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Config</span>
                            <span class="arrow">
                                <i class="arrow-icon"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ Route::currentRouteName() == 'customer-type.index' ? 'active' : '' }}">
                                <a href="{{ route('customer-type.index') }}">Customer Type</a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
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
                        <i class="anticon anticon-user"></i>
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
            {{-- <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-message"></i>
                    </span>
                    <span class="title">Order</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'laundry-order.index' ? 'active' : '' }}">
                        <a href="{{ route('laundry-order.index') }}">Order</a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'order-item.index' ? 'active' : '' }}">
                        <a href="{{ route('order-item.index') }}">Order Item</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-wallet"></i>
                    </span>
                    <span class="title">Payment</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'payment.index' ? 'active' : '' }}">
                        <a href="{{ route('payment.index') }}">Payment</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-smile"></i>
                    </span>
                    <span class="title">Service</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'service.index' ? 'active' : '' }}">
                        <a href="{{ route('service.index') }}">Service</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Configure</span>
                            <span class="arrow">
                                <i class="arrow-icon"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ Route::currentRouteName() == 'item.index' ? 'active' : '' }}">
                                <a href="{{ route('item.index') }}">Item</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'service-type.index' ? 'active' : '' }}">
                                <a href="{{ route('service-type.index') }}">Service Type</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Settings</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() == 'customer-type.index' ? 'active' : '' }}">
                        <a href="{{ route('customer-type.index') }}">Customer Type</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Service</span>
                            <span class="arrow">
                                <i class="arrow-icon"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ Route::currentRouteName() == 'item.index' ? 'active' : '' }}">
                                <a href="{{ route('item.index') }}">Item</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'service-type.index' ? 'active' : '' }}">
                                <a href="{{ route('service-type.index') }}">Service Type</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</div>
