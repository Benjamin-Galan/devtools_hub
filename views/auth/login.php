<main class="form-container">
    <section class="form-section">
        <h2>Inicio de sesion</h2>

        <?php foreach ($errors as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form id="categoryForm" action="/login" method="POST">
            <div>
                <label for="name">Nombre de Usuario</label>
                <input type="text" id="categoryName" name="email" value="">
            </div>
            <div>
                <label for="description">Contraseña</label>
                <input type="password" id="categoryDesc" name="password">
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </section>
</main>