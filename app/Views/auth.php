<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- external css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>

<body>
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
    <div class="login-card">

        <div class="logo-area">
            <div class="logo-circle"><i class="fa-brands fa-centercode"></i></div>
        </div>

        <h3 class="text-center login-title mb-4">Login</h3>

        <?php $validation = session()->get('validation'); ?>
        <form action="<?= base_url('auth/login') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label input-label">Username</label>
                <input
                    type="text"
                    name="username"
                    class="form-control"
                    value="<?= old('username') ?>"
                    placeholder="Masukkan username">
                <?php if (isset($validation) && $validation->hasError('username')): ?>
                    <div class="text-danger small">
                        <?= $validation->getError('username') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label input-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password">
                <?php if (isset($validation) && $validation->hasError('password')): ?>
                    <div class="text-danger small">
                        <?= $validation->getError('password') ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-pink w-100 mt-2">Masuk</button>

            <div class="text-center mt-3">
                <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-pink w-100">
                    Buat Akun Baru
                </a>
            </div>
        </form>


    </div>

    <!-- Load SweetAlert2 dulu -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "<?= session()->getFlashdata('success'); ?>",
                showConfirmButton: false,
                timer: 4000
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "<?= session()->getFlashdata('error'); ?>",
                showConfirmButton: false,
                timer: 4000
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('warning')) : ?>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "warning",
                title: "<?= session()->getFlashdata('warning'); ?>",
                showConfirmButton: false,
                timer: 4000
            });
        <?php endif; ?>

        const form = document.querySelector("form");
        const submitBtn = document.querySelector("button[type='submit']");
        const inputs = document.querySelectorAll("input");

        form.addEventListener("submit", function(e) {

            // Tombol berubah menjadi loading
            submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            Memproses...
        `;
            submitBtn.disabled = true;

            // Semua input jadi readonly
            inputs.forEach(input => input.setAttribute("readonly", true));
        });
    </script>


</body>

</html>