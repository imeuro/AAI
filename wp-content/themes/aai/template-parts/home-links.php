<?php 
// echo get_field('banda'.$banda.'_text',6069);
// echo get_field('banda'.$banda.'_link',6069);
if (get_field('banda'.$banda.'_text',6069)) { ?>
    <section class="banda-home">
        <h2 class="section-title serif">
            <a href="<?php echo get_field('banda'.$banda.'_link',6069) ?>"><?php echo get_field('banda'.$banda.'_text',6069) ?> &raquo;</a>
        </h2>
    </section>
<?php } ?>

