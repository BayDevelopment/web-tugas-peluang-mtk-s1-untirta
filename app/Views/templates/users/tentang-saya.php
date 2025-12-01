<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Tentang Saya</h2>
            <p class="text-muted">Kenali lebih jauh tentang saya dan pekerjaan saya</p>
        </div>

        <div class="row g-4">
            <!-- Kolom Kiri: Foto, Nama, Pendidikan, Skill -->
            <div class="col-lg-4">
                <div class="card shadow-sm rounded-4 p-4 text-center h-100">
                    <img src="<?= base_url('assets/img/user.png') ?>"
                        alt="Avatar"
                        class="rounded-circle mb-3 mx-auto d-block"
                        style="width:120px; height:120px; object-fit:cover;">

                    <h5 class="fw-bold mb-2">Tiara Nur Diyanti</h5>
                    <p class="text-muted mb-3">Data Analyst, Design Enthusiast</p>

                    <hr class="my-3">

                    <h6 class="fw-bold">Pendidikan</h6>
                    <p class="text-muted mb-3">S1 Matematika</p>

                    <h6 class="fw-bold">Skill</h6>
                    <p class="text-muted mb-3">Canva, Ms.Word, Ms.Excel</p>

                    <a href="#" class="btn btn-pink btn-sm mt-3">Hubungi Saya</a>
                </div>

            </div>

            <!-- Kolom Kanan: Tentang Saya / Deskripsi -->
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4 p-4 h-100">
                    <h4 class="fw-bold mb-3">Tentang Saya</h4>
                    <p class="mb-4">Saya senang membuat design, terutama menggunakan canva, di tiap design nya memiliki arti. Berpengalaman membuat proyek web modern, kalkulator matematika, dan dashboard administrasi dengan fitur modern dan user-friendly.</p>

                    <h5 class="fw-bold mb-2">Proyek & Minat</h5>
                    <ul class="list-unstyled mb-4">
                        <li>✅ Aplikasi Web Interaktif dengan CodeIgniter 4</li>
                        <li>✅ Dashboard Admin & Sistem Manajemen</li>
                        <li>✅ Kalkulator dan Simulasi Matematika</li>
                        <li>✅ Optimasi UI/UX Responsif</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>