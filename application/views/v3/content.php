<div id="food" class="tutorial">
    <header>
        <h2><?php echo $food['food']; ?></h2>
        <time pubdate datetime="2012-08-31"></time>
    </header>
    <article class="simple">
        <div class="image">
            <div class="imageWrapper">
                <img src="<?php echo $food['image_url']; ?>" alt="<?php echo $food['food']; ?>" title="<?php echo $food['food']; ?>" />
            </div>
        </div>
    </article>
    <h3 style="text-decoration:line-through">Senast serverad:</h3>
    <ul class="historyWrapper">
        <?php //echo $foodHistory; ?>
    </ul>
</div>
<div id="veg" class="tutorial">
    <div class="borderleft">
        <h2><?php echo $veg['food']; ?></h2>
        <article class="simple">
            <div class="image">
                <div class="imageWrapper">
                    <img src="<?php echo $veg['image_url']; ?>" alt="<?php echo $veg['food']; ?>" title="<?php echo $veg['food']; ?>" />
                </div>
            </div>
        </article>
        <h3 style="text-decoration:line-through">Senast serverad:</h3>
        <ul class="historyWrapper">
        <?php //echo $vegHistory; ?>
        </ul>
    </div>
</div>