<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<style>
    /* ======================= MODERN STYLING ======================= */
    .quiz-wrapper {
        background: linear-gradient(135deg, #f8f6ff, #ffffff);
        border-radius: 28px;
        padding: 35px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    /* Dekorasi lembut */
    .quiz-wrapper::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        background: rgba(255, 100, 180, 0.12);
        border-radius: 50%;
        top: -40px;
        right: -60px;
        filter: blur(40px);
    }

    .quiz-wrapper::after {
        content: "";
        position: absolute;
        width: 140px;
        height: 140px;
        background: rgba(132, 92, 255, 0.15);
        border-radius: 50%;
        bottom: -50px;
        left: -40px;
        filter: blur(40px);
    }

    .badge-level {
        background: #ff98c5ff;
        color: white;
        padding: 6px 14px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .btn-main {
        background-color: #ff7cf4ff;
        border: none;
        color: white;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-main:hover {
        opacity: 0.85;
        transform: translateY(-2px);
    }

    #question-text {
        line-height: 1.5;
    }

    .option-item {
        background: white;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid #ebe8f5;
        margin-bottom: 8px;
        cursor: pointer;
        transition: 0.2s;
    }

    .option-item:hover {
        background: #fff7fd;
        border-color: #ffb3d8;
    }

    .chip-good {
        background: #d5f7df;
        color: #217a39;
        padding: 5px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .result-score {
        font-size: 2.8rem;
        font-weight: 800;
        color: #ff2a86;
        line-height: 1;
    }

    /* PILIHAN JAWABAN */
    .option {
        display: flex;
        align-items: center;
        gap: 12px;
        background: white;
        border: 1px solid #e7e4f3;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .option:hover {
        background: #fff1fa;
        border-color: #ff9cd6;
    }

    .option.selected {
        border-color: #ff2a86;
        background: #ffe4f3;
    }

    .option.correct {
        border-color: #16a34a;
        background: #e7fbe9;
    }

    .option.wrong {
        border-color: #dc2626;
        background: #ffe6e6;
    }

    .option-index {
        font-weight: 700;
        color: #ff2a86;
    }

    .option-text {
        flex: 1;
        color: #3a3745;
        font-size: 0.95rem;
    }
</style>

<section class="py-5 bg-light">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:#2f2b3a;">Hasil Quiz</h2>
            <p class="text-muted">Ringkasan jawaban & skor kamu</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="quiz-wrapper">

                    <div class="quiz-card">

                        <!-- ================= INTRO ================= -->
                        <div id="intro-screen">
                            <span class="badge-level">
                                Quiz Dasar-Dasar Peluang • Level SMP IX
                            </span>

                            <h1 class="mt-3 mb-3" style="font-size:1.7rem;font-weight:800;color:#322f40;">
                                Siap Uji Skill Peluangmu?
                            </h1>

                            <p class="text-muted mb-2">
                                Kamu akan menjawab soal mengenai ruang sampel, peluang dasar, dan analisis sederhana berbasis konteks.
                            </p>

                            <ul class="text-muted small">
                                <li>Pertanyaan bertingkat: diagnostik hingga sumatif.</li>
                                <li>Mengukur pemahaman konsep dasar peluang.</li>
                                <li>Ada simulasi berbasis media digital.</li>
                                <li>Disusun sesuai modul pembelajaran.</li>
                            </ul>

                            <button class="btn-main mt-2" onclick="showDiagnostikInfo()">Asesmen Diagnostik</button>
                            <button class="btn-main mt-2" onclick="showSumatifInfo()">Asesmen Sumatif</button>
                        </div>

                        <!-- ================= DIAGNOSTIK INFO ================= -->
                        <div id="diagnostik-info" style="display:none;">
                            <span class="badge-level">Asesmen Diagnostik</span>

                            <h2 class="mt-3" style="font-weight:800;color:#2f2b3a;">Asesmen Diagnostik</h2>

                            <p class="text-muted">
                                Mengidentifikasi pemahaman dasar sebelum masuk ke materi lebih lanjut.
                            </p>

                            <ul class="text-muted small">
                                <li>Baca pertanyaan dengan cermat.</li>
                                <li>Pilih opsi yang paling tepat.</li>
                                <li>Total: 5 soal pilihan ganda.</li>
                            </ul>

                            <button class="btn-main mt-3" onclick="startDiagnostikQuiz()">Mulai Sekarang</button>
                            <button class="btn-main btn-sm" onclick="backToIntro()">Kembali</button>
                        </div>

                        <!-- ================= QUIZ ================= -->
                        <div id="quiz-screen" style="display:none;">

                            <div class="text-end mb-2 fw-bold" style="color:#ff2a86;">
                                Waktu tersisa: <span id="timer">01:00</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge-level" id="quiz-badge">Diagnostik</span>
                                <span class="tiny">
                                    <span id="question-number">1</span> / <span id="total-questions">0</span>
                                </span>
                            </div>

                            <h2 id="question-text" class="mb-3" style="font-size:1.15rem;font-weight:700;"></h2>

                            <div id="options-container" class="mb-2"></div>

                            <div id="explanation-box" class="explanation tiny" style="display:none;"></div>

                            <div class="d-flex justify-content-between mt-3">
                                <span class="tiny" id="live-score">Skor sementara: 0</span>
                                <button id="next-btn" class="btn-main" onclick="nextQuestion()" disabled>
                                    Lanjut
                                </button>
                            </div>
                        </div>

                        <!-- ================= RESULT ================= -->
                        <div id="result-screen" style="display:none;">

                            <span id="result-chip" class="result-chip chip-good">Keren!</span>

                            <h2 class="mt-2 mb-2 fw-bold" id="result-title">
                                Hasil Diagnostik
                            </h2>

                            <div class="d-flex gap-4 mb-3">
                                <div>
                                    <div id="result-score" class="result-score">0</div>
                                    <div class="tiny">
                                        Dari <span id="result-total">0</span> soal
                                    </div>
                                </div>

                                <div class="tiny mt-2">
                                    <div><strong>Benar:</strong> <span id="result-correct">0</span></div>
                                    <div><strong>Salah:</strong> <span id="result-wrong">0</span></div>
                                </div>
                            </div>

                            <p class="tiny mb-3" id="result-message"></p>

                            <button class="btn-main me-2" onclick="restartQuiz()">Coba Lagi</button>
                            <button class="btn-main btn-sm" onclick="backToIntro()">Kembali</button>

                            <hr>

                            <h5 class="mt-2">Detail Jawaban</h5>
                            <div id="final-answers" class="tiny mt-2"></div>
                        </div>

                        <!-- ================= SUMATIF INFO ================= -->
                        <div id="sumatif-info" style="display:none;">
                            <span class="badge-level">Asesmen Sumatif</span>

                            <h1 class="mt-3 mb-3 fw-bold" style="font-size:1.7rem;">Asesmen Sumatif</h1>

                            <p class="text-muted">
                                Mengukur penguasaan konsep dan kemampuan analisis secara menyeluruh.
                            </p>

                            <ul class="text-muted small">
                                <li>Pertanyaan pilihan ganda & uraian.</li>
                                <li>Kerjakan secara teliti.</li>
                                <li>Total: 2 PG + 2 uraian.</li>
                            </ul>

                            <button class="btn-main mt-3" onclick="startSumatifQuiz()">Mulai Sekarang</button>
                            <button class="btn-main btn-sm" onclick="backToIntro()">Kembali</button>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</section>


<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    /* FUNGSI YANG HILANG — WAJIB ADA */
    function startDiagnostikQuiz() {
        startQuiz("diagnostik");
    }

    function startSumatifQuiz() {
        startQuiz("sumatif");
    }
    /* ===============================
       DATA SOAL
    =============================== */
    const quizDataDiagnostik = [{
            type: "pg",
            question: "Ruang sampel lempar 1 koin adalah …",
            options: ["{1}", "{1,2,3,4,5,6}", "{A, G}", "{A saja}"],
            answer: 2,
            explanation: "Satu koin memiliki dua sisi: Angka (A) dan Gambar (G), jadi S = {A, G}."
        },
        {
            type: "pg",
            question: "Kejadian mustahil adalah kejadian yang …",
            options: ["Memiliki peluang 1", "Tidak mungkin terjadi", "Selalu terjadi", "Paling mungkin terjadi"],
            answer: 1,
            explanation: "Kejadian mustahil memiliki peluang 0."
        },
        {
            type: "pg",
            question: "Nilai peluang suatu kejadian berada di antara …",
            options: ["1 dan 10", "–1 dan 1", "0 dan 100", "0 dan 1"],
            answer: 3,
            explanation: "Peluang selalu berada di 0 ≤ P(A) ≤ 1."
        },
        {
            type: "pg",
            question: "Pada rumus P(A) = n(A) / n(S), n(S) menunjukkan …",
            options: ["Banyak kejadian", "Banyak anggota ruang sampel", "Banyak peluang", "Jumlah kejadian tidak terjadi"],
            answer: 1,
            explanation: "n(S) = banyaknya anggota ruang sampel."
        },
        {
            type: "pg",
            question: "Banyak ruang sampel dari lempar 2 koin adalah …",
            options: ["2", "3", "4", "6"],
            answer: 2,
            explanation: "Hasil: (A,A),(A,G),(G,A),(G,G) → total 4."
        }
    ];

    const quizDataSumatif = [{
            type: "pg",
            question: "Ruang sampel lempar dua dadu adalah …",
            options: ["{(1,1),(1,2),(1,3)}", "{(1),(2),(3),(4),(5),(6)}", "36 pasangan bilangan terurut", "6 saja"],
            answer: 2,
            explanation: "Dua dadu: 6×6 = 36 kemungkinan."
        },
        {
            type: "pg",
            question: "Peluang muncul mata dadu genap adalah …",
            options: ["1/6", "2/6", "3/6", "4/6"],
            answer: 2,
            explanation: "Genap: {2,4,6} → 3/6."
        },
        {
            type: "uraian",
            question: "Mengapa peluang mustahil = 0? Tuliskan nilai peluangnya.",
            correctDisplay: "0",
            explanation: "Kejadian mustahil memiliki n(A)=0 → P(A)=0."
        },
        {
            type: "uraian",
            question: "Dalam kotak terdapat 4 bola biru dan 6 merah. Peluang ambil biru?",
            correctDisplay: "4/10 atau 0,4",
            explanation: "Total 10, biru 4 → 4/10 = 0,4."
        }
    ];

    /* ===============================
       STATE
    =============================== */
    let currentMode = "diagnostik";
    let currentIndex = 0,
        score = 0;
    let selectedOptionIndex = null;
    let revealedThisQuestion = false;
    let chosenAnswers = [];
    let quizFinished = false;

    const DIAG_DURATION = 120;
    const SUM_DURATION = 120;
    let timerInterval = null;
    let timeLeft = 120;

    /* ===============================
       ELEMENT
    =============================== */
    const introScreen = document.getElementById("intro-screen");
    const diagnostikInfo = document.getElementById("diagnostik-info");
    const sumatifInfo = document.getElementById("sumatif-info");
    const quizScreen = document.getElementById("quiz-screen");
    const resultScreen = document.getElementById("result-screen");

    const qNumberEl = document.getElementById("question-number");
    const totalQuestionsEl = document.getElementById("total-questions");
    const qTextEl = document.getElementById("question-text");
    const optionsContainer = document.getElementById("options-container");
    const explanationBox = document.getElementById("explanation-box");
    const nextBtn = document.getElementById("next-btn");
    const liveScoreEl = document.getElementById("live-score");
    const quizBadge = document.getElementById("quiz-badge");

    const resultScore = document.getElementById("result-score");
    const resultTotal = document.getElementById("result-total");
    const resultCorrect = document.getElementById("result-correct");
    const resultWrong = document.getElementById("result-wrong");
    const resultMessage = document.getElementById("result-message");
    const finalAnswersDiv = document.getElementById("final-answers");
    const resultTitle = document.getElementById("result-title");

    /* ===============================
       HELPER
    =============================== */
    const getData = () => currentMode === "diagnostik" ? quizDataDiagnostik : quizDataSumatif;

    /* ===============================
       NAVIGASI
    =============================== */
    function showDiagnostikInfo() {
        currentMode = "diagnostik";
        introScreen.style.display = "none";
        sumatifInfo.style.display = "none";
        resultScreen.style.display = "none";
        quizScreen.style.display = "none";
        diagnostikInfo.style.display = "block";
    }

    function showSumatifInfo() {
        currentMode = "sumatif";
        introScreen.style.display = "none";
        diagnostikInfo.style.display = "none";
        quizScreen.style.display = "none";
        resultScreen.style.display = "none";
        sumatifInfo.style.display = "block";
    }

    function startQuiz(mode) {
        currentMode = mode;
        diagnostikInfo.style.display = "none";
        sumatifInfo.style.display = "none";
        resultScreen.style.display = "none";
        quizScreen.style.display = "block";

        quizBadge.textContent = mode === "diagnostik" ? "Asesmen Diagnostik" : "Asesmen Sumatif";
        resultTitle.textContent = mode === "diagnostik" ? "Hasil Asesmen Diagnostik" : "Hasil Asesmen Sumatif";

        resetState();
        totalQuestionsEl.textContent = getData().length;
        startTimer(mode === "diagnostik" ? DIAG_DURATION : SUM_DURATION);
        loadQuestion();
    }

    function resetState() {
        currentIndex = 0;
        score = 0;
        selectedOptionIndex = null;
        quizFinished = false;
        revealedThisQuestion = false;
        chosenAnswers = [];
        liveScoreEl.textContent = "Skor sementara: 0";
    }

    /* ===============================
       TIMER
    =============================== */
    function updateTimer() {
        const m = String(Math.floor(timeLeft / 60)).padStart(2, "0");
        const s = String(timeLeft % 60).padStart(2, "0");
        document.getElementById("timer").textContent = `${m}:${s}`;
    }

    function startTimer(dur) {
        clearInterval(timerInterval);
        timeLeft = dur;
        updateTimer();
        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimer();
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                showResult();
            }
        }, 1000);
    }

    /* ===============================
       LOAD SOAL
    =============================== */
    function loadQuestion() {
        const data = getData();
        const item = data[currentIndex];

        selectedOptionIndex = null;
        revealedThisQuestion = false;

        qNumberEl.textContent = currentIndex + 1;
        qTextEl.textContent = item.question;
        optionsContainer.innerHTML = "";
        explanationBox.style.display = "none";

        nextBtn.disabled = true;
        nextBtn.textContent = (currentIndex === data.length - 1) ? "Lihat Hasil" : "Soal Berikutnya";

        if (item.type === "pg") {
            item.options.forEach((opt, idx) => {
                const div = document.createElement("div");
                div.className = "option";
                div.innerHTML = `
                    <div class="option-index">${String.fromCharCode(65 + idx)}</div>
                    <div class="option-text">${opt}</div>`;
                div.onclick = () => chooseOption(idx);
                optionsContainer.appendChild(div);
            });
        } else {
            const wrap = document.createElement("div");
            wrap.innerHTML = `
                <div class="tiny mb-1">Tulis jawaban di bawah:</div>
                <input id="uraian-input" type="text" class="form-control" placeholder="Masukkan jawaban">`;
            wrap.querySelector("input").oninput = e => {
                nextBtn.disabled = e.target.value.trim() === "";
            };
            optionsContainer.appendChild(wrap);
        }
    }

    /* ===============================
       PILIHAN GANDA
    =============================== */
    function chooseOption(idx) {
        if (revealedThisQuestion) return;
        selectedOptionIndex = idx;
        document.querySelectorAll(".option").forEach((el, i) => {
            el.classList.toggle("selected", i === idx);
        });
        nextBtn.disabled = false;
    }

    /* ===============================
       URAIAN
    =============================== */
    function checkUraian(idx, val) {
        const cleaned = val.trim().replace(/\s+/g, "").replace(",", ".");
        if (idx === 2) return cleaned === "0" || cleaned === "0.0";
        if (idx === 3) return ["4/10", "0.4", "0.40", "2/5"].includes(cleaned);
        return false;
    }

    /* ===============================
       NEXT SOAL
    =============================== */
    function nextQuestion() {
        const data = getData();
        const item = data[currentIndex];

        if (!revealedThisQuestion) {
            let correct = false;
            let record = {
                type: item.type,
                selectedIndex: null,
                text: null,
                isCorrect: false
            };

            if (item.type === "pg") {
                if (selectedOptionIndex === null) return;
                correct = selectedOptionIndex === item.answer;
                record.selectedIndex = selectedOptionIndex;
                document.querySelectorAll(".option").forEach((el, i) => {
                    if (i === item.answer) el.classList.add("correct");
                    if (i === selectedOptionIndex && i !== item.answer) el.classList.add("wrong");
                });
            } else {
                const val = document.getElementById("uraian-input").value.trim();
                correct = checkUraian(currentIndex, val);
                record.text = val;
            }

            record.isCorrect = correct;
            chosenAnswers[currentIndex] = record;

            if (correct) {
                score++;
                liveScoreEl.textContent = `Skor sementara: ${score}`;
            }

            explanationBox.innerHTML = `<strong>Penjelasan:</strong><br>${item.explanation}`;
            explanationBox.style.display = "block";
            revealedThisQuestion = true;
            nextBtn.disabled = false;

        } else {
            if (currentIndex < data.length - 1) {
                currentIndex++;
                loadQuestion();
            } else {
                showResult();
            }
        }
    }

    /* ===============================
       HASIL QUIZ
    =============================== */
    function showResult() {
        clearInterval(timerInterval);
        quizFinished = true;

        quizScreen.style.display = "none";
        resultScreen.style.display = "block";

        const data = getData();
        const total = data.length;
        const correct = score;
        const wrong = total - correct;
        const nilai = Math.round((correct / total) * 100);

        resultScore.textContent = nilai;
        resultTotal.textContent = total;
        resultCorrect.textContent = correct;
        resultWrong.textContent = wrong;

        resultMessage.textContent =
            nilai === 100 ? "Hebat! Semua benar." :
            nilai >= 80 ? "Memahami sebagian besar konsep." :
            nilai >= 60 ? "Cukup baik, tingkatkan lagi." :
            nilai >= 40 ? "Perlu banyak latihan." :
            "Pelajari dari dasar, kamu pasti bisa.";

        let html = "";
        data.forEach((q, i) => {
            const ca = chosenAnswers[i] || {};
            if (q.type === "pg") {
                const u = ca.selectedIndex != null ? String.fromCharCode(65 + ca.selectedIndex) : "-";
                const c = String.fromCharCode(65 + q.answer);
                html += `<div><strong>${i + 1}.</strong> ${u} — ${
                    ca.isCorrect ? "<span style='color:#16a34a'>Benar</span>" :
                                   `<span style='color:#dc2626'>Salah</span> (Seharusnya ${c})`
                }</div>`;
            } else {
                const u = ca.text || "-";
                html += `<div><strong>${i + 1}.</strong> Jawabanmu: ${u} — ${
                    ca.isCorrect ? "<span style='color:#16a34a'>Benar</span>" :
                                   `<span style='color:#dc2626'>Salah</span> (Seharusnya ${q.correctDisplay})`
                }</div>`;
            }
        });

        finalAnswersDiv.innerHTML = html;
    }

    /* ===============================
       KEMBALI
    =============================== */
    const backToIntro = () => {
        quizScreen.style.display = "none";
        resultScreen.style.display = "none";
        diagnostikInfo.style.display = "none";
        sumatifInfo.style.display = "none";
        introScreen.style.display = "block";
    };
</script>
<?= $this->endSection() ?>