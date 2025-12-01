<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Simulasi Dadu & Koin</h2>
            <p class="text-muted">Simulasikan lemparan dadu dan koin, lihat hasil dan peluangnya</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold mb-4 text-center">Pengaturan Simulasi</h5>

                    <form id="simulationForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="numDice" class="form-label">Jumlah Dadu (1-2)</label>
                                <input type="number" min="1" max="2" class="form-control" id="numDice" value="1" required>
                            </div>
                            <div class="col-md-6">
                                <label for="numCoins" class="form-label">Jumlah Koin (1-2)</label>
                                <input type="number" min="1" max="2" class="form-control" id="numCoins" value="1" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label for="numRolls" class="form-label">Jumlah Lemparan</label>
                                <input type="number" min="1" max="1000" class="form-control" id="numRolls" value="10" required>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-pink btn-sm">Mulai Simulasi</button>
                            <a href="<?= base_url('user/dashboard') ?>" class="btn btn-pink btn-sm mt-2">Kembali</a>
                        </div>
                    </form>
                    <div class="mt-4">
                        <h6 class="fw-bold">Keterangan Koin:</h6>
                        <p class="mb-1"><strong>H</strong> : Head / Kepala</p>
                        <p class="mb-1"><strong>T</strong> : Tail / Ekor</p>
                    </div>


                    <div class="mt-4">
                        <h6 class="fw-bold">Hasil Simulasi:</h6>
                        <div id="results" class="mb-3"></div>
                        <canvas id="chartResults" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById('simulationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const numDice = parseInt(document.getElementById('numDice').value);
        const numCoins = parseInt(document.getElementById('numCoins').value);
        const numRolls = parseInt(document.getElementById('numRolls').value);

        let resultsHTML = '';
        let freqMap = {};

        for (let i = 0; i < numRolls; i++) {
            // Simulasi dadu
            let diceRolls = [];
            for (let d = 0; d < numDice; d++) {
                const roll = Math.floor(Math.random() * 6) + 1;
                diceRolls.push(roll);
            }

            // Simulasi koin
            let coinRolls = [];
            for (let c = 0; c < numCoins; c++) {
                const flip = Math.random() < 0.5 ? 'H' : 'T';
                coinRolls.push(flip);
            }

            const key = `Dadu: ${diceRolls.join(', ')} | Koin: ${coinRolls.join(', ')}`;
            freqMap[key] = (freqMap[key] || 0) + 1;

            resultsHTML += `<p>Roll ${i+1}: ${key}</p>`;
        }

        document.getElementById('results').innerHTML = resultsHTML;

        // Chart hasil frekuensi
        const ctx = document.getElementById('chartResults').getContext('2d');
        const chartLabels = Object.keys(freqMap);
        const chartData = Object.values(freqMap);

        // Hapus chart lama jika ada
        if (window.simChart) window.simChart.destroy();

        window.simChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Frekuensi',
                    data: chartData,
                    backgroundColor: 'rgba(255, 105, 180, 0.7)',
                    borderColor: 'rgba(255, 105, 180, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 0
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>