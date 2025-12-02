<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Modul Ajar</h2>
            <p class="text-muted">Modul ajar Kurikulum Merdeka dalam Materi Peluang</p>
        </div>

        <div class="row g-4">
            <!-- Card Bahan Ajar -->
            <div class="col-lg-4 col-md-4">
                <div class="card shadow-sm rounded-4 p-3 h-100">
                    <h5 class="fw-bold mb-3">Modul Ajar PPM</h5>
                    <p class="text-muted mb-4">Modul ajar Kurikulum Merdeka dalam Materi Peluang</p>
                    <div class="d-flex gap-2 mt-auto">
                        <button class="btn btn-pink btn-sm flex-fill" onclick="togglePreview('preview1')">Lihat Langsung</button>
                        <a href="<?= base_url('assets/uploads/doc/MODUL AJAR MATEMATIKA_PPM.pdf') ?>" class="btn btn-outline-secondary btn-sm flex-fill" target="_blank">Lihat Lainnya</a>
                    </div>

                    <div id="preview1" class="mt-3" style="display:none;">
                        <iframe src="<?= base_url('assets/uploads/doc/MODUL AJAR MATEMATIKA_PPM.pdf') ?>" width="100%" height="400px"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card shadow-sm rounded-4 p-3 h-100">
                    <h5 class="fw-bold mb-3">Lampiran PPM</h5>
                    <p class="text-muted mb-4">Data Lampiran PPM</p>
                    <div class="d-flex gap-2 mt-auto">
                        <button class="btn btn-pink btn-sm flex-fill" onclick="togglePreview('preview2')">Lihat Langsung</button>
                        <a href="<?= base_url('assets/uploads/doc/LAMPIRAN PPM.pdf') ?>" class="btn btn-outline-secondary btn-sm flex-fill" target="_blank">Lihat Lainnya</a>
                    </div>

                    <div id="preview2" class="mt-3" style="display:none;">
                        <iframe src="<?= base_url('assets/uploads/doc/LAMPIRAN PPM.pdf') ?>" width="100%" height="400px"></iframe>
                    </div>
                </div>
            </div>



            <!-- Tambahkan card lain sesuai kebutuhan -->
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    function togglePreview(id) {
        const allPreviews = document.querySelectorAll("[id^='preview']");
        const target = document.getElementById(id);

        // Tutup semua preview lain dulu
        allPreviews.forEach(p => {
            if (p.id !== id) p.style.display = "none";
        });

        // Toggle preview yang diklik
        const isHidden = target.style.display === "none" ||
            window.getComputedStyle(target).display === "none";

        if (isHidden) {
            target.style.display = "block";
            target.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        } else {
            target.style.display = "none";
        }
    }
</script>
<?= $this->endSection() ?>