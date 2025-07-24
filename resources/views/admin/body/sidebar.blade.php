<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                
                <li>
                    <a href="{{ url('/dashboard') }}" class="waves-effect">
                        <i class="ri-home-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @role('admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-hotel-fill"></i>
                        <span>Manage Suppliers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('supplier.all') }}">All Supplier</a></li>

                    </ul>
                </li>
                @endrole

                @if(auth()->user()->hasAnyRole(['admin','user']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shield-user-fill"></i>
                        <span>Manage Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if(auth()->user()->hasAnyRole(['admin']))
                        <li><a href="{{ route('customer.all') }}">All Customers</a></li>
                        @endif

                        @if(auth()->user()->hasAnyRole(['user']))
                            <li><a href="{{ route('credit.customer') }}">Credit Customers</a></li>
                            <li><a href="{{ route('paid.customer') }}">Paid Customers</a></li>
                            <li><a href="{{ route('customer.wise.report') }}">Customer Report</a></li>
                        @endif

                    </ul>
                </li>
                @endif

                @role('admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-delete-back-fill"></i>
                        <span>Manage Units</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('unit.all') }}">All Unit</a></li>

                    </ul>
                </li>
                @endrole

                @role('admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>Manage Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('category.all') }}">All Category</a></li>

                    </ul>
                </li>
                @endrole


                @role('admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-reddit-fill"></i>
                        <span>Manage Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('product.all') }}">All Product</a></li>

                    </ul>
                </li>
                @endrole

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-oil-fill"></i>
                        <span>Manage Purchase</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('purchase.all') }}">All Purchase</a></li>
                        @if(auth()->user()->hasAnyRole(['user','staff']))
                            <li><a href="{{ route('purchase.pending') }}">Approval Purchase</a></li>
                            <li><a href="{{ route('daily.purchase.report') }}">Daily Purchase Report</a></li>
                        @endif

                    </ul>
                </li>

                @if(auth()->user()->hasAnyRole(['admin','user']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-compass-2-fill"></i>
                        <span>Manage Sales</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('invoice.all') }}">All Sales</a></li>
                        @if(auth()->user()->hasAnyRole(['user']))
                            <li><a href="{{ route('invoice.pending.list') }}">Approval Sales</a></li>
                        @endif
                        @if(auth()->user()->hasAnyRole(['admin']))
                        <li><a href="{{ route('print.invoice.list') }}">Print Sales List</a></li>
                        <li><a href="{{ route('daily.invoice.report') }}">Daily Sales Report</a></li>
                        @endif
                    </ul>  
                </li>
                @endif






                @if(auth()->user()->hasAnyRole(['admin','staff']))
                <li class="menu-title">Stock</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-gift-fill"></i>
                        <span>Manage Stock</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stock.report') }}">Stock Report</a></li>
                        <li><a href="{{ route('stock.supplier.wise') }}">Supplier / Product Wise </a></li>

                    </ul>
                </li>
                @endif


                @if (Auth::user()->role == 'user')
                <li class="menu-title">User</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-user-fill"></i>
                        <span>Manage User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('user.all') }}">All User</a></li>
                    </ul>
                </li>
                @endif





            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
