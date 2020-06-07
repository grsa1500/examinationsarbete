
<div class="container">


<?php


if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php if ( $post->post_parent ) { ?>
 <a class="backlink" href="<?php echo get_permalink( $post->post_parent ); ?>" >
    <?php echo '<i class="fas fa-chevron-left"></i> Tillbaka till '. get_the_title( $post->post_parent ); ?>
 </a>
<?php } ?>
      <div class="pageheadingcontainer">
            <div class="pageborder"></div>
<h1><?php the_title(); ?></h1>
        </div> 

<div class="pagecontainer">   


  <div class="pagecontent">
          
        <?php the_content(); ?>


  </div>


        
                      <?php

                        if (has_post_thumbnail()) :
                            echo '<div class="post-thumbnail">';
                            the_post_thumbnail();
                            echo '</div>';
                        endif;
                        ?> 

                    
                </div>

    <?php endwhile;
else : ?>

<?php endif; ?>

<?php
if( have_rows('bildspel') ):
?>
<h3>Bilder</h3>
<p><i class="fas fa-search-plus"></i> Klicka för att förstora</p>
<div class="lightboxcontainer">
    
<?php
while ( have_rows('bildspel') ) : the_row();

$image = get_sub_field('bild');



?>


<a href="<?= $image['url'] ?>" data-lightbox="roadtrip"><img src="<?= $image['url'] ?>" alt="bildspel"></a>


<?php


endwhile;
?>
</div>
<?php
else :

// no rows found

endif;

?>

</div>