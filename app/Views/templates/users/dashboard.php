<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<?php if (session()->get('role') === 'admin') : ?>
<?php else: ?>
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item fs-5 active" aria-current="page">Silahkan pilih fitur yang ingin diakses!</li>
            </ol>
        </nav>

        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 mb-2">
                        <div class="card shadow-sm rounded-4 p-4 h-100 text-center">
                            <h6 class="judul fw-bold mb-2">Kalkulator Peluang</h6>
                            <p class="paragraft text-muted mb-4">Kalkulator Peluang Dasar dan Lanjutan</p>
                            <div class="d-grid mt-auto">
                                <a class="btn btn-pink btn-sm" href="<?= base_url('user/kalkulator-peluang') ?>" role="button">Mulai Kalkulator</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="card shadow-sm rounded-4 p-4 h-100 text-center">
                            <h6 class="judul fw-bold mb-2">Simulasi Dadu & Koin</h6>
                            <p class="paragraft text-muted mb-4">Simulasi Probabilitas Interaktif</p>
                            <div class="d-grid mt-auto">
                                <a class="btn btn-pink btn-sm" href="<?= base_url('user/simulasi-dadu-koin') ?>" role="button">Mulai</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="card shadow-sm rounded-4 p-4 h-100 text-center">
                            <h6 class="judul fw-bold mb-2">Bahan Ajar</h6>
                            <p class="paragraft text-muted mb-4">Materi Peluang Lengkap dan Mudah Dipahami</p>
                            <div class="d-grid mt-auto">
                                <a class="btn btn-pink btn-sm" href="<?= base_url('user/bahan-ajar') ?>" role="button">Mulai </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="card shadow-sm rounded-4 p-4 h-100 text-center">
                            <h6 class="judul fw-bold mb-2">Modul Ajar</h6>
                            <p class="paragraft text-muted mb-4">Panduan Belajar Lengkap dan Terstruktur</p>
                            <div class="d-grid mt-auto">
                                <a class="btn btn-pink btn-sm" href="<?= base_url('user/modul-ajar') ?>" role="button">Mulai</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="card shadow-sm rounded-4 p-4 h-100 text-center">
                            <h6 class="judul fw-bold mb-2">LKPD Siap Cetak</h6>
                            <p class="paragraft text-muted mb-4">Kerjakan LKPD Secara Digital</p>
                            <div class="d-grid mt-auto">
                                <a class="btn btn-pink btn-sm" href="<?= base_url('user/lkpd-digital') ?>" role="button">Mulai</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="card shadow-sm rounded-4 p-4 h-100 text-center">
                            <h6 class="judul fw-bold mb-2">Quiz</h6>
                            <p class="paragraft text-muted mb-4">Uji Pemahamanmu disini</p>
                            <div class="d-grid mt-auto">
                                <a class="btn btn-pink btn-sm" href="<?= base_url('user/quiz') ?>" role="button">Mulai </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>