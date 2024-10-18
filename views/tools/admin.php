<main class="container admin">
    <h1>Panel de Administración</h1>

    <?php
    if ($result) {
        $message = showAlerts(intval($result));
        if ($message) { ?>
            <p class="alerta exito"><?php echo s($message); ?></p>
    <?php }
    }
    ?>

    <p class="description">Gestiona las herramientas y categorías del DevTools Hub.</p>

    <section>
        <h2>Lista de Herramientas</h2>
        <a href="/tools/create" class="new-category-btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 5px;">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                <path d="M9 12h6" />
                <path d="M12 9v6" />
            </svg>
            Nueva Herramienta
        </a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Enlace</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tools as $tool) { ?>
                        <tr>
                            <td><?php echo $tool->id; ?></td>
                            <td><?php echo $tool->name; ?></td>
                            <td><img src="/images/<?php echo $tool->image; ?>" alt=""></td>
                            <td><?php echo $tool->description; ?></td>
                            <td><?php echo $tool->url; ?></td>
                            <td><?php echo $tool->category_id; ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="update-btn"><a href="/tools/update?id=<?php echo $tool->id; ?>">Actualizar</a></button>
                                    <form method="POST" action="/tools/delete" class="delete-form">
                                        <input type="hidden" name="id" value="<?php echo $tool->id; ?>">
                                        <input type="hidden" name="type" value="tool">
                                        <button type="submit" class="delete-btn">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <p class="description">Gestiona las herramientas y categorías del DevTools Hub.</p>

    <section>
        <h2>Lista de Categorías</h2>
        <a href="/categories/create" class="new-category-btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 5px;">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                <path d="M9 12h6" />
                <path d="M12 9v6" />
            </svg>
            Nueva Categoría
        </a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td><?php echo $category->id ?></td>
                            <td><?php echo $category->name ?></td>
                            <td><?php echo $category->description ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="update-btn"><a href="/categories/update?id=<?php echo $category->id; ?>">Actualizar</a></button>
                                    <form action="/categories/delete" method="POST" class="delete-form">
                                        <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                                        <input type="hidden" name="type" value="category">
                                        <button type="submit" class="delete-btn">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>