<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Kalkulator Peluang Interaktif</h2>
            <p class="text-muted">Hitung berbagai jenis peluang dengan cepat dan mudah</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold mb-4 text-center">Masukkan Probabilitas Kejadian</h5>

                    <form id="eventForm">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="probA" class="form-label">P(A)</label>
                                <input type="number" step="0.01" min="0" max="1" class="form-control" id="probA" placeholder="0.0 - 1.0" required>
                            </div>
                            <div class="col-md-4">
                                <label for="probB" class="form-label">P(B)</label>
                                <input type="number" step="0.01" min="0" max="1" class="form-control" id="probB" placeholder="0.0 - 1.0" required>
                            </div>
                            <div class="col-md-4">
                                <label for="probAB" class="form-label">P(A ∩ B)</label>
                                <input type="number" step="0.01" min="0" max="1" class="form-control" id="probAB" placeholder="Opsional">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label fw-bold">Pilih Jenis Perhitungan</label>
                            <select class="form-select" id="calcType">
                                <option value="union">Gabungan (A ∪ B)</option>
                                <option value="intersection">Irisan (A ∩ B)</option>
                                <option value="complementA">Komplemen (¬A)</option>
                                <option value="conditional">Bersyarat P(A|B)</option>
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-pink btn-sm">Hitung</button>
                            <a href="<?= base_url('user/dashboard') ?>" class="btn btn-pink btn-sm mt-2">Kembali</a>
                        </div>
                    </form>

                    <div class="mt-4">
                        <h6 class="fw-bold">Hasil:</h6>
                        <p id="result" class="fs-5 text-primary"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const P_A = parseFloat(document.getElementById('probA').value);
        const P_B = parseFloat(document.getElementById('probB').value);
        const P_AB = parseFloat(document.getElementById('probAB').value) || 0;
        const calcType = document.getElementById('calcType').value;
        let result;

        // Validasi input
        if (P_A < 0 || P_A > 1 || P_B < 0 || P_B > 1 || P_AB < 0 || P_AB > 1) {
            Swal.fire({
                icon: 'error',
                title: 'Input tidak valid',
                text: 'Pastikan semua input berada di antara 0 dan 1'
            });
            return;
        }

        switch (calcType) {
            case 'union':
                result = P_A + P_B - P_AB;
                document.getElementById('result').innerText = `P(A ∪ B) = ${result.toFixed(2)}`;
                break;
            case 'intersection':
                result = P_AB;
                document.getElementById('result').innerText = `P(A ∩ B) = ${result.toFixed(2)}`;
                break;
            case 'complementA':
                result = 1 - P_A;
                document.getElementById('result').innerText = `P(¬A) = ${result.toFixed(2)}`;
                break;
            case 'conditional':
                if (P_B === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'P(B) = 0',
                        text: 'P(A|B) tidak dapat dihitung karena P(B) = 0'
                    });
                    return;
                }
                result = P_AB / P_B;
                document.getElementById('result').innerText = `P(A|B) = ${result.toFixed(2)}`;
                break;
            default:
                document.getElementById('result').innerText = '';
        }
    });
</script>

<?= $this->endSection() ?>