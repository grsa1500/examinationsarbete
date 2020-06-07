<div class="container">


    <?php
    $id =  get_the_ID();

    if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="pageheadingcontainer">
                <div class="pageborder"></div>
                <h1><?php the_title(); ?></h1>
        
            </div>

        <?php endwhile;
    else : ?>

    <?php endif; ?>

    <?php
$args = array(
    'post_parent' => $id,
    'post_type' => 'page',
 
);

$child_query = new WP_Query( $args );
?>
<div class="sortimentcontainer">


<?php while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
<a class="sortimentbox" <?php  
        if ( has_post_thumbnail() ) {
            echo "style='background-image: url(".get_the_post_thumbnail_url().")'"; 
        }
        ?> href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
   
        <div class="overlay"></div>
     
        <h3><?php the_title(); ?></h3>
     
        
    </a>
<?php endwhile; ?>
</div>
<?php
wp_reset_postdata();
?>

</div>