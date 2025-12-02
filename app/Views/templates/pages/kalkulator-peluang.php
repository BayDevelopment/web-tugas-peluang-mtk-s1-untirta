<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Kalkulator Peluang Interaktif</h2>
            <p class="text-muted">Hitung berbagai jenis peluang dengan cepat dan mudah</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-4 border-0 p-4">
                    <h2 class="h4 fw-bold">Kalkulator Peluang</h2>
                    <p class="text-muted mb-2">Hitung peluang berdasarkan kejadian & ruang sampel.</p>

                    <hr>

                    <div class="row g-3">

                        <!-- Input A -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kejadian A (numerator)</label>
                            <input id="num" type="number" class="form-control" value="1" min="0">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total kejadian (denominator)</label>
                            <input id="den" type="number" class="form-control" value="2" min="1">
                        </div>

                        <!-- Buttons -->
                        <div class="col-12 d-flex flex-wrap gap-2 mt-2">

                            <button id="calcBtn" class="btn btn-primary px-4">Hitung</button>

                            <div class="btn-group">
                                <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                    Contoh Cepat
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" data-num="1" data-den="2">Koin (angka)</a></li>
                                    <li><a class="dropdown-item" data-num="1" data-den="6">Dadu (4)</a></li>
                                    <li><a class="dropdown-item" data-num="13" data-den="52">Kartu (hati)</a></li>
                                </ul>
                            </div>

                            <button id="clearBtn" class="btn btn-outline-danger px-4">Reset</button>
                        </div>

                        <!-- Hasil -->
                        <div class="col-12 mt-3">
                            <div id="resultBox" class="p-3 border rounded bg-white">
                                <div id="fraction" class="fs-5 fw-bold mb-2">-- / --</div>
                                <div id="percent" class="text-primary fw-semibold mb-2">--%</div>
                                <div id="steps" class="small text-muted">Langkah perhitungan muncul di sini.</div>
                            </div>
                        </div>

                        <!-- Fitur lanjutan -->
                        <div class="col-12 mt-4">
                            <h5 class="fw-semibold">Fitur Lanjutan</h5>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <button id="compBtn" class="btn btn-outline-primary w-100">Komplement (1 - P)</button>
                                </div>
                                <div class="col-md-4">
                                    <button id="andBtn" class="btn btn-outline-success w-100">AND (A × B)</button>
                                </div>
                                <div class="col-md-4">
                                    <button id="orBtn" class="btn btn-outline-warning w-100">OR (A + B)</button>
                                </div>
                            </div>
                        </div>

                        <!-- Input B -->
                        <div class="col-12 mt-3" id="andOrInputs" style="display:none;">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Kejadian B (numerator)</label>
                                    <input id="numB" type="number" min="0" value="1" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Kejadian B (denominator)</label>
                                    <input id="denB" type="number" min="1" value="2" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="<?= base_url('user/dashboard') ?>" class="btn btn-pink btn-sm mt-2">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    // Protect
    function protect() {
        if (!localStorage.getItem("loggedIn")) {
            location.replace("login.html");
        }
    }

    // Math utilities
    function gcd(a, b) {
        while (b) {
            [a, b] = [b, a % b]
        }
        return a;
    }

    function simplify(a, b) {
        let g = gcd(a, b);
        return [a / g, b / g];
    }

    function showResult(n, d, stepTxt) {
        const [sn, sd] = simplify(n, d);
        fraction.innerHTML = `<strong>${sn}</strong>/<strong>${sd}</strong>`;
        percent.textContent = ((n / d) * 100).toFixed(4) + "%";
        steps.textContent = stepTxt;
    }

    // Actions
    calcBtn.onclick = () => {
        const n = Number(num.value);
        const d = Number(den.value || 1);
        const [sn, sd] = simplify(n, d);
        showResult(n, d, `P(A) = ${n}/${d} = ${sn}/${sd}`);
    };

    clearBtn.onclick = () => {
        num.value = 1;
        den.value = 2;
        andOrInputs.style.display = "none";
        showResult(1, 2, "");
    };

    document.querySelectorAll(".dropdown-item").forEach(item => {
        item.onclick = () => {
            num.value = item.dataset.num;
            den.value = item.dataset.den;
            calcBtn.click();
        };
    });

    compBtn.onclick = () => {
        const n = Number(num.value);
        const d = Number(den.value);
        showResult(d - n, d, `P(¬A) = ${d-n}/${d}`);
    };

    andBtn.onclick = () => {
        andOrInputs.style.display = "block";
        const nA = Number(num.value),
            dA = Number(den.value);
        const nB = Number(numB.value),
            dB = Number(denB.value);
        showResult(nA * nB, dA * dB, `P(A∩B) = ${nA*nB}/${dA*dB}`);
    };

    orBtn.onclick = () => {
        andOrInputs.style.display = "block";
        const nA = Number(num.value),
            dA = Number(den.value);
        const nB = Number(numB.value),
            dB = Number(denB.value);
        const L = Math.abs(dA * dB) / gcd(dA, dB);
        const A = nA * (L / dA);
        const B = nB * (L / dB);
        showResult(A + B, L, `P(A)+P(B) = ${A+B}/${L}`);
    };
</script>
<?= $this->endSection() ?>