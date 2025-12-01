<!-- Footer -->
<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">
            <!-- Tentang -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Tentang Saya</h5>
                <p>Saya seorang Data Analyst, Design Enthusiast & Matematika Enthusiast. Fokus pada Design, Data clean</p>
            </div>

            <!-- Link Cepat -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Link Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url('/') ?>" class="text-light text-decoration-none">Beranda</a></li>
                    <?php if (session()->get('role') === 'admin'): ?>
                    <?php else: ?>
                        <li><a href="<?= base_url('/user/tentang-saya') ?>" class="text-light text-decoration-none">Tentang Saya</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Sosial Media -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Sosial Media</h5>
                <a href="#" class="text-light me-3 fs-5"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-light me-3 fs-5"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light me-3 fs-5"><i class="fab fa-linkedin"></i></a>
                <a href="#" class="text-light fs-5"><i class="fab fa-github"></i></a>
            </div>
        </div>

        <hr class="border-light">

        <div class="text-center">
            <p class="mb-0">&copy; <?= date('Y') ?> Tiara Nur Diyanti. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    /* Hover tombol/link */
    footer a:hover {
        color: #ff69b4 !important;
        /* pink modern */
        text-decoration: underline;
    }

    /* Footer sticky di layar besar */
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
        /* biar main ikut stretch */
    }

    /* Footer styling tambahan */
    footer {
        flex-shrink: 0;
    }

    /* Responsive adjustments untuk PC / Laptop besar */
    @media (min-width: 992px) {
        footer .row>div {
            padding-right: 2rem;
            padding-left: 2rem;
        }
    }
</style>