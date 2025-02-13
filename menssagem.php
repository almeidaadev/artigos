<?php if (isset($_SESSION['mensagem'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: '<?= $_SESSION['mensagem']['tipo'] ?>', // success, error, warning, info
                title: '<?= ($_SESSION['mensagem']['tipo'] == 'success') ? 'Sucesso!' : 'Erro!' ?>',
                text: '<?= $_SESSION['mensagem']['texto'] ?>',
                timer: 3000, // Fecha automaticamente em 3 segundos
                showConfirmButton: true
            });
        });
    </script>
    <?php unset($_SESSION['mensagem']); // Limpa a sessão após exibir a mensagem ?>
<?php endif; ?>