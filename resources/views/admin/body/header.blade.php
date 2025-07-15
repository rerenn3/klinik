<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm-light" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo-light" height="40">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>

        </div>

        <div class="d-flex">

            <!-- Fullscreen Button -->
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <!-- 🔔 Notifikasi Stok Menipis -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notification-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    @if(isset($totalStockAlerts) && $totalStockAlerts > 0)
                        <span class="badge bg-danger rounded-pill">{{ $totalStockAlerts }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notification-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifikasi Stok </h6>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        {{-- Menampilkan produk stok menipis --}}
                        @if(isset($lowStockItems) && $lowStockItems->count())
                            @foreach($lowStockItems as $item)
                                <a href="#" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-warning rounded-circle font-size-16">
                                                <i class="ri-capsule-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">{{ $item->name }}</h6>
                                            <div class="font-size-12 text-muted">
                                                Sisa stok: <strong>{{ $item->current_stock }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        {{-- Menampilkan produk out of stock --}}
                        @if(isset($outOfStockItems) && $outOfStockItems->count())
                            @foreach($outOfStockItems as $item)
                                <a href="#" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                <i class="ri-capsule-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">{{ $item->name }}</h6>
                                            <div class="font-size-12 text-muted text-danger">
                                                <strong>Stok Habis!</strong>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        {{-- Jika tidak ada notifikasi --}}
                        @if(
                            (!isset($lowStockItems) || !$lowStockItems->count()) &&
                            (!isset($outOfStockItems) || !$outOfStockItems->count())
                        )
                            <div class="text-center text-muted p-3">
                                Semua stok aman 👍
                            </div>
                        @endif
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 w-100 text-center" href="{{ route('stock.report') }}">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> Lihat Semua Stok
                        </a>
                    </div>
                </div>
            </div>
            <!-- 🔔 END Notifikasi -->


            @php
            $id = Auth::user()->id;
            $adminData = App\Models\User::find($id);
            @endphp

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ $adminData->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                            class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('change.password') }}"><i
                            class="ri-wallet-2-line align-middle me-1"></i> Change Password</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>
