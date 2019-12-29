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
                @hasanyrole('Super Admin|Admin')
                <li class="app-sidebar__heading">Users, Roles and Permissions</li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="metismenu-icon pe-7s-users"></i> All Users
                    </a>
                </li>
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
{{--                 <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i> Others
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i> Buttons
                            </a>
                        </li>
                        <li>
                            <a href="elements-dropdowns.html">
                                <i class="metismenu-icon">
                                    </i>Dropdowns
                            </a>
                        </li>
                        <li>
                            <a href="elements-icons.html">
                                <i class="metismenu-icon">
                                    </i>Icons
                            </a>
                        </li>
                        <li>
                            <a href="elements-badges-labels.html">
                                <i class="metismenu-icon">
                                    </i>Badges
                            </a>
                        </li>
                        <li>
                            <a href="elements-cards.html">
                                <i class="metismenu-icon">
                                    </i>Cards
                            </a>
                        </li>
                        <li>
                            <a href="elements-list-group.html">
                                <i class="metismenu-icon">
                                    </i>List Groups
                            </a>
                        </li>
                        <li>
                            <a href="elements-navigation.html">
                                <i class="metismenu-icon">
                                    </i>Navigation Menus
                            </a>
                        </li>
                        <li>
                            <a href="elements-utilities.html">
                                <i class="metismenu-icon">
                                    </i>Utilities
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-car"></i> Components
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                    </i>Tabs
                            </a>
                        </li>
                        <li>
                            <a href="components-accordions.html">
                                <i class="metismenu-icon">
                                    </i>Accordions
                            </a>
                        </li>
                        <li>
                            <a href="components-notifications.html">
                                <i class="metismenu-icon">
                                    </i>Notifications
                            </a>
                        </li>
                        <li>
                            <a href="components-modals.html">
                                <i class="metismenu-icon">
                                    </i>Modals
                            </a>
                        </li>
                        <li>
                            <a href="components-progress-bar.html">
                                <i class="metismenu-icon">
                                    </i>Progress Bar
                            </a>
                        </li>
                        <li>
                            <a href="components-tooltips-popovers.html">
                                <i class="metismenu-icon">
                                    </i>Tooltips &amp; Popovers
                            </a>
                        </li>
                        <li>
                            <a href="components-carousel.html">
                                <i class="metismenu-icon">
                                    </i>Carousel
                            </a>
                        </li>
                        <li>
                            <a href="components-calendar.html">
                                <i class="metismenu-icon">
                                    </i>Calendar
                            </a>
                        </li>
                        <li>
                            <a href="components-pagination.html">
                                <i class="metismenu-icon">
                                    </i>Pagination
                            </a>
                        </li>
                        <li>
                            <a href="components-scrollable-elements.html">
                                <i class="metismenu-icon">
                                    </i>Scrollable
                            </a>
                        </li>
                        <li>
                            <a href="components-maps.html">
                                <i class="metismenu-icon">
                                    </i>Maps
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="tables-regular.html">
                        <i class="metismenu-icon pe-7s-display2"></i> Others
                    </a>
                </li> --}}

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
                <li class="app-sidebar__heading">Sales</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i> Invoice
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('sales.index') }}">
                                <i class="metismenu-icon">
                                    </i>Create Invoice 
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon">
                                    </i> Brand Managers
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('sales.index') }}">
                        <i class="metismenu-icon pe-7s-note2">
                            </i>Create Invoice 
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-eyedropper">
                            </i>Discounts
                    </a>
                </li>
                <li>
                    <a href="forms-validation.html">
                        <i class="metismenu-icon pe-7s-pendrive">
                            </i>Forms Validation
                    </a>
                </li>
                <li class="app-sidebar__heading">Charts</li>
                <li>
                    <a href="charts-chartjs.html">
                        <i class="metismenu-icon pe-7s-graph2">
                            </i>ChartJS
                    </a>
                </li>
                <li class="app-sidebar__heading">PRO Version</li>
                <li>
                    <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                        <i class="metismenu-icon pe-7s-graph2">
                            </i> Upgrade to PRO
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>