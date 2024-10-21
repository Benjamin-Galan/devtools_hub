<div id="toolsContainer" class="tools-grid">
    <?php foreach ($tools as $tool) { ?>
        <div class="card" data-category-id="<?php echo $tool->category_id; ?>">
            <h3><?php echo $tool->name; ?></h3>
            <img loading="lazy" src="/images/<?php echo $tool->image; ?>" alt="">
            <p><?php echo $tool->description; ?></p>
            <a href="<?php echo $tool->url; ?>" target="_blank"  class="button">Explorar</a>
        </div>
    <?php } ?>
</div>
