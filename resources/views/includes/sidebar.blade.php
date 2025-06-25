<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="index.html">Admin Dashboard</a></li>
                        <li><a href="teacher-dashboard.html">Teacher Dashboard</a></li>
                        <li><a href="student-dashboard.html">Student Dashboard</a></li>
                    </ul>
                </li>

                {{-- brand --}}
                <li class="submenu {{ set_active(['brands.create','brands.index']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Brand</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('brands.create') }}" class="{{set_active('brands.create')}}">Brand Add</a></li>
                        <li><a href="{{ route('brands.index') }}" class="{{set_active('brands.index')}}">Brand List</a></li>

                    </ul>
                </li>
                {{-- category --}}
                <li class="submenu {{ set_active(['categories.create','categories.index']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Category</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('categories.create') }}" class="{{set_active('categories.create')}}">Category Add</a></li>
                        <li><a href="{{ route('categories.index') }}" class="{{set_active('categories.index')}}">Category List</a></li>

                    </ul>
                </li>
                {{-- supplier --}}
                <li class="submenu {{ set_active(['suppliers.create','suppliers.index']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Supplier</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('suppliers.create') }}" class="{{set_active('suppliers.create')}}">Supplier Add</a></li>
                        <li><a href="{{ route('suppliers.index') }}" class="{{set_active('suppliers.index')}}">Supplier List</a></li>

                    </ul>
                </li>
                {{-- customer --}}
                <li class="submenu {{ set_active(['customers.create','customers.index']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Customer</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('customers.create') }}" class="{{set_active('customers.create')}}">Customer Add</a></li>
                        <li><a href="{{ route('customers.index') }}" class="{{set_active('customers.index')}}">Customer List</a></li>

                    </ul>
                </li>
                {{-- product --}}
                <li class="submenu {{ set_active(['products.create']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Product</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('products.create') }}" class="{{set_active('products.create')}}">Product Add</a></li>
                        <li><a href="{{ route('products.index') }}" class="{{set_active('products.index')}}">Product List</a></li>

                    </ul>
                </li>

                {{-- product --}}
                <li class="submenu {{ set_active(['purchases.create']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Purchases</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('purchases.create') }}" class="{{set_active('purchases.create')}}">Purchase Add</a></li>
                        <li><a href="{{ route('purchases.index') }}" class="{{set_active('purchases.index')}}">Purchase List</a></li>

                    </ul>
                </li>

                <li class="submenu {{ set_active(['sales.create']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span>Sales</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('sales.create') }}" class="{{set_active('sales.create')}}">Sale Add</a></li>
                    </ul>
                </li>


                <li class="submenu {{ set_active(['current-stocks.index']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Current Stock</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('current-stocks.index') }}" class="{{set_active('current-stocks.index')}}">Current Stock List</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
