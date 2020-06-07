<div class="container">


    <?php


    if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="pageheadingcontainer">
                <div class="pageborder"></div>
                <h1><?php the_title(); ?></h1>
            </div>

        <?php endwhile;
    else : ?>

    <?php endif; ?>

<?php
    if( have_rows('tradgardstips') ):

// loop through the rows of data
while ( have_rows('tradgardstips') ) : the_row();
$title = get_sub_field('titel');
$text = get_sub_field('text');
$image = get_sub_field('bild');
$link = get_sub_field('lank');

?>
 <div class="tradgardstipsbox">
        <div class="imgcontainer">
            <img src="<?php echo $image['url']?>" alt="bild för <?php echo $title ?>">

        </div>

        <div class="textcontainer">

            <h2><?php echo $title ?></h2>
            <p>
               <?php echo $text?>
            </p>
<?php if($link != null) 
     echo "<a href='".$link."'><button>
                Läs mer
        </button></a>";
       

?>  

</div>
    </div>
<?php
endwhile;

else :

// no rows found

endif;

?>

   



</div>