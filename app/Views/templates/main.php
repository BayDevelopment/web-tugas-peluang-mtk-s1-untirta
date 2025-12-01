<!doctype html>
<html lang="en">

<?= $this->include('templates/header') ?>

<body>
    <!-- header -->
    <header>
        <?= $this->include('templates/navbar') ?>
    </header>
    <!-- main -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('templates/footer') ?>

    <?= $this->renderSection('scripts') ?>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

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

        // Ambil navbar
        const navbar = document.getElementById('mainNavbar');
        const navbarOffset = navbar.offsetTop;

        window.addEventListener('scroll', () => {
            if (window.scrollY > navbarOffset) {
                navbar.classList.add('fixed-top', 'shadow-sm');
                document.body.style.paddingTop = navbar.offsetHeight + 'px'; // agar konten tidak naik
            } else {
                navbar.classList.remove('fixed-top', 'shadow-sm');
                document.body.style.paddingTop = '0';
            }
        });
    </script>

</body>

</html>