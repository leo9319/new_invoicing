<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
        </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('home') }}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i> Dashboard
                    </a>
                </li>
                @hasanyrole('Super Admin|Admin|Brand Manager|Customer Service|Accounts')
                @role('Super Admin|Admin')
                <li class="app-sidebar__heading">Users, Roles and Permissions</li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="metismenu-icon pe-7s-users"></i> All Users
                    </a>
                </li>
                @endrole
                @role('Super Admin')
                <li>
                    <a href="{{ route('roles.index') }}">
                        <i class="metismenu-icon pe-7s-network"></i> Roles
                    </a>
                </li>
                <li>
                    <a href="{{ route('permissions.index') }}">
                        <i class="metismenu-icon pe-7s-unlock"></i> Permissions
                    </a>
                </li>
                @endrole
                @role('Super Admin|Admin')
                <li class="app-sidebar__heading">Products, Brands and Inventories</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-gift"></i> Offers
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('vouchers.index') }}">
                                <i class="metismenu-icon">
                                    </i>Vouchers
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('discounts.index') }}">
                                <i class="metismenu-icon">
                                    </i>Discounts
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-plane"></i> Deliveries
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('delivery-companies.index') }}">
                                <i class="metismenu-icon">
                                    </i> Add Deliveries
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('company-names.index') }}">
                                <i class="metismenu-icon">
                                    </i> Company Names
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('districts.index') }}">
                                <i class="metismenu-icon">
                                    </i> Districts
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-science"></i> Brands
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('brands.index') }}">
                                <i class="metismenu-icon">
                                    </i> Brands
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('brand-users.index') }}">
                                <i class="metismenu-icon">
                                    </i> Brand Managers
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('products.index') }}">
                        <i class="metismenu-icon pe-7s-box2"></i> Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('inventories.index') }}">
                        <i class="metismenu-icon pe-7s-box1"></i> Inventories
                    </a>
                </li>
                @endrole
                @role('Super Admin|Admin|Brand Manager|Customer Service')
                <li class="app-sidebar__heading">Sales</li>
                <li>
                    <a href="{{ route('sales.index') }}">
                        <i class="metismenu-icon pe-7s-note2"></i> Invoices
                    </a>
                </li>
                @endrole
                <li class="app-sidebar__heading">Reports</li>
                <li>
                    <a href="{{ route('reports.sales') }}">
                        <i class="metismenu-icon pe-7s-graph3"></i> Generate Reports
                    </a>
                </li>
                @endhasanyrole
            </ul>
        </div>
    </div>
</div>