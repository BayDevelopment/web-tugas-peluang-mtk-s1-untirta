<nav id="mainNavbar" class="navbar navbar-expand-lg bg-native">
    <div class="container">
        <a class="navbar-brand fs-4" href="<?= base_url('/') ?>">
            <i class="fa-brands fa-centercode me-2"></i>PMath
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (session()->get('role') === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $navlink === 'dashboard' ? 'active fw-semibold' : '' ?>" aria-current="page" href="<?= base_url('user/dashboard') ?>">Dashboard</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $navlink === 'dashboard' ? 'active fw-semibold' : '' ?>" aria-current="page" href="<?= base_url('user/dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $navlink === 'tentang saya' ? 'active fw-semibold' : '' ?>" href="<?= base_url('user/tentang-saya') ?>">Tentang Saya</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- User Avatar + Dropdown -->
            <div class="dropdown ms-auto">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Avatar bulat, inisial nama depan -->
                    <div class="rounded-circle text-dark bg-light d-flex justify-content-center align-items-center"
                        style="width: 40px; height: 40px; font-weight: bold;">
                        <?= strtoupper(substr(esc($user['username']), 0, 1)) ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('/auth/logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>