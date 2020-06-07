
<div class="container">


<?php


if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="pageheadingcontainer">
            <div class="pageborder"></div>
<h1><?php the_title(); ?></h1>
        </div>
<div class="pagecontainer">
  <div class="pagecontent">
      
        <?php the_content(); ?>

        <p>
      
     <b>Telefon:</b>  <a href="tel:<?php echo get_field('telefonnummer', 'option') ?>"><?php echo get_field('telefonnummer', 'option') ?></a> <br>
     <b>E-post: </b><a href="mailto:<?php echo antispambot(get_field('e-postadress', 'option')) ?>"><?php echo antispambot(get_field('e-postadress', 'option')) ?></a>  <br>
    
     <a target="_blank"  href="<?php echo get_field('facebook', 'option') ?>"><i class="fab fa-facebook"></i></a>
    <a target="_blank"  href="<?php echo get_field('instagram', 'option') ?>"><i class="fab fa-instagram"></i></a> <br>
<p>Samt via <a href="#form">formuläret nedan.</a> </p>

    </p>
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



</div>

<div class="form">



    <div class="inner"> 
        <div id="form" class="formcontainer">

   
<h2>Kontakta oss:</h2>




<?php echo do_shortcode('[contact-form-7 id="167" title="Kontakformulär"]') ?>
     </div>

<div class="map">
<h2>Hitta hit:</h2>

<?php 
$location = get_field('map');
if( $location ): ?>
    <div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<?php endif; ?>
<b>Besöksadress:</b>  <?php echo get_field('adress', 'option') ?> <br>
</div>


    </div>
    
    
    
</div>


</div>
    </div>

    
</div>

