<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<style>
    /* AREA ICON */
    .icon-board img {
        width: 55px;
        margin: 6px;
        animation: pop 0.3s ease;
    }

    @keyframes pop {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* GLOW EFFECT KHUSUS KOIN */
    .coin-glow {
        animation: coinGlow 2s ease-in-out infinite alternate;
    }

    @keyframes coinGlow {
        0% {
            filter: drop-shadow(0 0 6px rgba(255, 215, 0, 0.4));
            transform: scale(1);
        }

        100% {
            filter: drop-shadow(0 0 14px rgba(255, 215, 0, 0.9));
            transform: scale(1.1);
        }
    }

    /* GAME AREA */
    .game-area {
        transition: 0.3s;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .game-area:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
    }

    /* STATS */
    .stats-box {
        border-left: 4px solid #0d6efd;
    }

    .stats-box.coin {
        border-left: 4px solid #28a745;
    }
</style>

<section class="py-5 ">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Simulasi Dadu & Koin</h2>
            <p class="text-muted">Simulasikan lemparan dadu dan koin, lihat hasil dan peluangnya</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4 p-4 border-0">

                    <div class="row g-4">

                        <!-- ============================
                             DADU
                        ============================ -->
                        <div class="col-md-6">
                            <div class="game-area p-3 bg-white rounded-4 shadow-sm h-100">

                                <h5 class="fw-semibold text-dark">Dadu 🎲</h5>
                                <p class="text-muted small">Atur jumlah dadu, lalu lempar untuk melihat statistik.</p>

                                <label class="form-label fw-semibold small">Jumlah Dadu</label>
                                <input type="number" id="diceCount" value="1" min="1"
                                    class="form-control form-control-sm mb-3" style="max-width:130px;">

                                <div id="diceArea" class="icon-board text-center py-4 rounded bg-light">
                                    <span class="text-muted">Belum ada pelemparan.</span>
                                </div>

                                <button class="btn btn-primary mt-3 w-100" onclick="rollDice()">Lempar Dadu</button>

                                <div id="diceStats" class="stats-box bg-light rounded p-3 mt-3">
                                    <h6 class="fw-semibold">Statistik Dadu</h6>
                                    <div class="text-muted small">Hasil: -</div>
                                    <div class="text-muted small">Jumlah: -</div>
                                    <div class="text-muted small">Produk: -</div>
                                    <div class="text-muted small">Rata-rata: -</div>
                                </div>

                            </div>
                        </div>

                        <!-- ============================
                             KOIN
                        ============================ -->
                        <div class="col-md-6">
                            <div class="game-area p-3 bg-white rounded-4 shadow-sm h-100">

                                <h5 class="fw-semibold text-dark">Koin 🪙</h5>
                                <p class="text-muted small">Lempar beberapa koin, lalu lihat frekuensi Angka & Gambar.</p>

                                <label class="form-label fw-semibold small">Jumlah Koin</label>
                                <input type="number" id="coinCount" value="1" min="1"
                                    class="form-control form-control-sm mb-3" style="max-width:130px;">

                                <div id="coinArea" class="icon-board text-center py-4 rounded bg-light">
                                    <span class="text-muted">Belum ada pelemparan.</span>
                                </div>

                                <button class="btn btn-success mt-3 w-100" onclick="flipCoins()">Lempar Koin</button>

                                <div id="coinStats" class="stats-box coin bg-light rounded p-3 mt-3">
                                    <h6 class="fw-semibold">Statistik Koin</h6>
                                    <div class="text-muted small">Hasil: -</div>
                                    <div class="text-muted small">Jumlah: -</div>
                                    <div class="text-muted small">Produk: -</div>
                                    <div class="text-muted small">Rata-rata: -</div>
                                    <div class="text-muted small">Peluang eksperimen Angka / Gambar: -</div>
                                </div>

                            </div>
                        </div>

                    </div><!-- end row -->
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    /* ================= LOGIN PROTECT ================= */
    function protect() {
        if (!localStorage.getItem("loggedIn")) {
            location.replace("login.html");
        }
    }

    /* ================== DADU ================== */
    function rollDice() {
        const count = Number(document.getElementById("diceCount").value || 1);
        const diceArea = document.getElementById("diceArea");
        const statsBox = document.getElementById("diceStats");

        diceArea.innerHTML = "<span class='text-muted'>Mengocok dadu...</span>";
        diceArea.classList.add("shake");

        const images = [
            "https://raw.githubusercontent.com/tewarig/Dice_IMG/main/1.png",
            "https://raw.githubusercontent.com/tewarig/Dice_IMG/main/2.png",
            "https://raw.githubusercontent.com/tewarig/Dice_IMG/main/3.png",
            "https://raw.githubusercontent.com/tewarig/Dice_IMG/main/4.png",
            "https://raw.githubusercontent.com/tewarig/Dice_IMG/main/5.png",
            "https://raw.githubusercontent.com/tewarig/Dice_IMG/main/6.png",
        ];

        setTimeout(() => {
            diceArea.classList.remove("shake");
            diceArea.innerHTML = "";

            let values = [];
            let sum = 0;
            let prod = 1;

            for (let i = 0; i < count; i++) {
                const val = Math.floor(Math.random() * 6) + 1;
                values.push(val);
                sum += val;
                prod *= val;

                const img = document.createElement("img");
                img.src = images[val - 1];
                img.className = "dice-img";
                diceArea.appendChild(img);
            }

            const avg = (sum / count).toFixed(2);

            statsBox.innerHTML = `
            <h6 class="fw-semibold">Statistik Dadu</h6>
            <div class="text-muted small">Hasil: ${values.join(", ")}</div>
            <div class="text-muted small">Jumlah: ${sum}</div>
            <div class="text-muted small">Produk: ${prod}</div>
            <div class="text-muted small">Rata-rata: ${avg}</div>
        `;
        }, 850);
    }

    /* ================== KOIN ================== */
    function flipCoins() {
        const count = Number(document.getElementById("coinCount").value || 1);
        const coinArea = document.getElementById("coinArea");
        const statsBox = document.getElementById("coinStats");

        coinArea.innerHTML = "<span class='text-muted'>Memutar koin...</span>";
        coinArea.classList.add("flip");

        setTimeout(() => {
            coinArea.classList.remove("flip");
            coinArea.innerHTML = "";

            let results = [];
            let angka = 0,
                gambar = 0;

            for (let i = 0; i < count; i++) {
                let side = Math.random() < 0.5 ? "Angka" : "Gambar";
                results.push(side);

                if (side === "Angka") angka++;
                else gambar++;

                const chip = document.createElement("div");
                chip.className = side === "Angka" ? "coin-chip coin-angka" : "coin-chip coin-gambar";
                chip.textContent = side === "Angka" ? "A" : "G";
                coinArea.appendChild(chip);
            }

            const total = angka + gambar;
            const produk = angka;
            const rata = (produk / total).toFixed(2);

            statsBox.innerHTML = `
            <h6 class="fw-semibold">Statistik Koin</h6>
            <div class="text-muted small">Hasil: ${results.join(", ")}</div>
            <div class="text-muted small">Jumlah: ${total}</div>
            <div class="text-muted small">Produk: ${produk}</div>
            <div class="text-muted small">Rata-rata: ${rata}</div>
            <div class="text-muted small">Peluang eksperimen Angka / Gambar: ${(angka/total).toFixed(2)} / ${(gambar/total).toFixed(2)}</div>
        `;
        }, 850);
    }
</script>
<?= $this->endSection() ?>