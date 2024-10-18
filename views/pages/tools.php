<div id="toolsContainer" class="tools-grid blur">
    <?php foreach ($tools as $tool) { ?>
        <div class="card" data-category-id="<?php echo $tool->category_id; ?>">
            <h3><?php echo $tool->name; ?></h3>
            <img class="border" src="/images/<?php echo $tool->image; ?>" alt="">
            <p><?php echo $tool->description; ?></p>
            <a href="<?php echo $tool->url; ?>" class="button">Explorar</a>
        </div>
    <?php } ?>
</div>
