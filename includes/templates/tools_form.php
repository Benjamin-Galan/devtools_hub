<div>
    <label for="name">Nombre de la Herramienta:</label>
    <input type="text" id="toolName" name="tool[name]" value="<?php echo  s($tool->name); ?>">
</div>
<div>
    <label for="description">Descripción:</label>
    <textarea id="toolDescription" name="tool[description]"><?php echo s($tool->description); ?></textarea>
</div>
<div>
    <label for="url">Enlace (opcional):</label>
    <input type="url" id="toolLink" name="tool[url]" value="<?php echo s($tool->url); ?>">
</div>
<div>
    <label for="image">Imagen (opcional):</label>
    <input type="file" id="toolImage" name="tool[image]">

    <?php if ($tool->image) { ?>
        <img src="/images/<?php echo $tool->image; ?>" alt="">
    <?php } ?>
</div>
<div>
    <label for="toolCategory">Categoría:</label>
    <select id="toolCategory" name="tool[category_id]">
        <option value="">Selecciona una categoría</option>
        <?php foreach ($categories as $category) { ?>
            <option 
                <?php echo $tool->category_id === $category->id ? 'selected' : ''; ?>
                value="<?php echo s($category->id);?>"> 
                <?php echo s($category->name) ?></option>
        <?php } ?>
    </select>
</div>