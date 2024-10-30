<?php
/*
$AGENDA_args = array(
    'post_type' => 'agenda',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC'
);

$AGENDA_query = new WP_Query( $AGENDA_args );


if ( $AGENDA_query->have_posts() ) : ?>

    <section id="agenda-home">
        <h2 class="section-title">Agenda</h2>
        <!-- ul class="agenda-home-list flex CSScarousel">
        <?php
        while ( $AGENDA_query->have_posts() ) : $AGENDA_query->the_post();
            setlocale(LC_ALL, 'it_IT');
            $inizio = get_field('aai_agenda_data_inizio');
            $fine = get_field('aai_agenda_data_fine');
            echo '<li class="agenda-home-item CSScarouselItem">';
            echo '<p class="agenda-item-citta">'.get_field('aai_agenda_citta_it').'</p>';
            echo '<p class="agenda-item-sede">'.get_field('aai_agenda_citta_sede').'</p>';
            echo '<h3 class="agenda-item-title">'.get_the_title().'</h3>';
            echo '<p class="agenda-item-date">'.date('j F Y', strtotime($inizio)).' – '.date('j F Y', strtotime($fine)).'</p>';
            echo '</li>';
        endwhile;
        ?>
        </ul -->
    </section>
<?php    
endif;

wp_reset_postdata();
*/
?>


<?php 

// echo get_field('banda'.$banda.'_text',6069);
// echo get_field('banda'.$banda.'_link',6069);

if (get_field('fascia1_text',6069)) { ?>
    <section id="agenda-home">
        <h2 class="section-title">
            <a href="<?php echo get_field('banda'.$banda.'_link',6069) ?>"><?php echo get_field('banda'.$banda.'_text',6069) ?></a>
        </h2>
    </section>
<?php } ?>

