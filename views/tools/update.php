<main class="form-container">
    <a href="/admin" class="delete-btn cancel">Cancelar</a>
    <section class="form-section">
        <h2>Actualizar Herramienta</h2>

        <?php
        foreach ($errors as $error) { ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php }
        ?>

        <form class="form" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . '/form.php'; ?>
            <button type="submit">Guardar</button>
        </form>
    </section>
</main>