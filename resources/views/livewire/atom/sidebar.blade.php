<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-home"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">PRODUCT</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('products') }}" wire:navigate aria-expanded="false">
                <span>
                    <i class="ti ti-package"></i>
                </span>
                <span class="hide-menu">Products</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('categories') }}" wire:navigate aria-expanded="false">
                <span>
                    <i class="ti ti-list"></i>
                </span>
                <span class="hide-menu">Categories</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">ORDER</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" wire:navigate href="{{ route('list.orders') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Orders</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" wire:navigate href="{{ route('transactions') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-wallet"></i>
                </span>
                <span class="hide-menu">Transactions</span>
            </a>
        </li>
    </ul>
</nav>