<main class="form-container">
    <a href="/admin" class="delete-btn cancel">Cancelar</a>
    <section class="form-section">
        <h2>Crear Nueva Categoría</h2>

        <?php foreach ($errors as $error) { // Muestra errores si los hay 
        ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form id="categoryForm" method="POST">
            <?php include __DIR__ . "/form.php"; ?>
            <button type="submit">Guardar/button>
        </form>
    </section>
</main>