<div>
    <label for="name">Nombre de la Categoría:</label>
    <input type="text" id="categoryName" name="category[name]" value="<?php echo s($category->name);?>">
</div>
<div>
    <label for="description">Descripcion:</label>
    <textarea  id="categoryDesc" name="category[description]"><?php echo s($category->description);?></textarea>
</div>