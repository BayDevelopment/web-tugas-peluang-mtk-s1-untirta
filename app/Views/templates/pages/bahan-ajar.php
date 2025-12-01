<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Bahan Ajar</h2>
            <p class="text-muted">Materi pelajaran lengkap dan mudah diakses</p>
        </div>

        <div class="row g-4">
            <!-- Card Bahan Ajar -->
            <div class="col-lg-4 col-md-4">
                <div class="card shadow-sm rounded-4 p-3 h-100">
                    <h5 class="fw-bold mb-3">Bahan Ajar PPM</h5>
                    <p class="text-muted mb-4">Materi lengkap PPM untuk pembelajaran interaktif</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-pink btn-sm flex-fill" onclick="togglePreview('preview1')">Lihat Langsung</button>
                        <a href="<?= base_url('assets/uploads/doc/BAHAN-AJAR-PPM.pdf') ?>" class="btn btn-outline-secondary btn-sm flex-fill" target="_blank">Lihat Lainnya</a>
                    </div>

                    <!-- Preview PDF -->
                    <div id="preview1" class="mt-3" style="display:none;">
                        <iframe src="<?= base_url('assets/uploads/doc/BAHAN-AJAR-PPM.pdf') ?>" width="100%" height="400px"></iframe>
                    </div>
                </div>
            </div>


            <!-- Tambahkan card lain sesuai kebutuhan -->
        </div>
    </div>
</section>

<script>
    function togglePreview(id) {
        const preview = document.getElementById(id);
        if (preview.style.display === 'none') {
            preview.style.display = 'block';
            preview.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        } else {
            preview.style.display = 'none';
        }
    }
</script>

<?= $this->endSection() ?>