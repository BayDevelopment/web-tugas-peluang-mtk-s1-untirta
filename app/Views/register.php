<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">

    <style>
        .btn-outline-pink {
            border: 2px solid #ff4da6;
            color: #ff4da6;
            font-weight: 600;
            border-radius: 10px;
            transition: 0.25s ease;
        }

        .btn-outline-pink:hover {
            background: #ff4da6;
            color: #fff;
            box-shadow: 0 0 10px rgba(255, 77, 166, 0.6);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="login-card">

        <div class="logo-area">
            <div class="logo-circle"><i class="fa-solid fa-user-plus"></i></div>
        </div>

        <h3 class="text-center login-title mb-4">Register</h3>

        <?php $validation = session()->get('validation'); ?>

        <form action="<?= base_url('auth/register') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="row">
                <!-- Username -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <label class="form-label input-label">Username</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        value="<?= old('username') ?>"
                        placeholder="Masukkan username">
                    <?php if (isset($validation) && $validation->hasError('username')): ?>
                        <div class="text-danger small"><?= $validation->getError('username') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <label class="form-label input-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= old('email') ?>"
                        placeholder="Masukkan email">
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="text-danger small"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <label class="form-label input-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password">
                    <?php if (isset($validation) && $validation->hasError('password')): ?>
                        <div class="text-danger small"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Konfirmasi Password -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <label class="form-label input-label">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirm"
                        class="form-control"
                        placeholder="Ulangi password">
                    <?php if (isset($validation) && $validation->hasError('password_confirm')): ?>
                        <div class="text-danger small"><?= $validation->getError('password_confirm') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <button type="submit" class="btn btn-pink w-100 mt-2">Daftar</button>

            <div class="text-center mt-3">
                <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-pink w-100">
                    Sudah punya akun? Masuk
                </a>
            </div>
        </form>

    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "<?= session()->getFlashdata('success'); ?>",
                timer: 4000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "<?= session()->getFlashdata('error'); ?>",
                timer: 4000,
                showConfirmButton: false
            });
        <?php endif; ?>

        const form = document.querySelector("form");
        const submitBtn = document.querySelector("button[type='submit']");
        const inputs = document.querySelectorAll("input");

        form.addEventListener("submit", function() {
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2"></span>
                Memproses...
            `;
            submitBtn.disabled = true;
            inputs.forEach(input => input.setAttribute("readonly", true));
        });
    </script>

</body>

</html>