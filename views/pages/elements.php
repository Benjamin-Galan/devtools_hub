<main class="container">
    <section class="elements"></section>
    <div class="tabs categories">
        <button class="tab-button active" data-category-id="0">Todas<a href="/tools.php"></a></button>
        <?php foreach ($categories as $category) { ?>
            <button class="tab-button" data-category-id="<?php echo $category->id; ?>"><?php echo $category->name; ?></button>
        <?php } ?>
    </div>

    <?php include 'tools.php'?>
    </section>
</main>