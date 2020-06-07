<div class="banner"  style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
<div class="overlay">

</div>    

<h1><?php echo get_the_title(); ?></h1>
</div>
<div class="start">

<img class="backgroundimage" src="<?= get_template_directory_uri();?>/dist/images/background.svg" alt="bakgrund"/> 

<div class="introduction animatedParent animateOnce" data-sequence="500">
    <div class="textbox animated fadeIn" data-id="1">


        <h2>
        <?php echo get_field("titel") ?>
        </h2>
        <p>
        <?php echo get_field("text") ?>
        </p>
    </div>

    <img class="animated fadeIn" data-id="1" src="<?php echo get_field("bild")['url'] ?>" alt="header för Pomondalens Handelsträdgård">
</div>



<div class="news  animatedParent animateOnce" >


<?php

// check if the repeater field has rows of data
if( have_rows('info') ):

 	// loop through the rows of data
    while ( have_rows('info') ) : the_row();
    $title = get_sub_field('title');
    $text = get_sub_field('text');
    $image = get_sub_field('bild');
    $link = get_sub_field('lank');

    ?>
   <div class="newsbox animated fadeIn" data-id="1"> 
        <div class="border">

        </div>
        <div class="content">
            <div class="textbox">

                <h2>
                    <span>
                       <?php echo $title ?>
                    </span>
                </h2>
                <p>
                <?php echo $text ?>
                </p>

                <?php if($link != null) 
     echo "<a href='".$link."'><button>
                Läs mer
        </button></a>";
       

?>  
            </div>
            <div class="imgbox">
                <img src="<?php echo $image['url'] ?>" alt="<?php echo $title ?>">


            </div>

        </div>
    </div>

<?php
    endwhile;

else :

    // no rows found

endif;

?>

</div>
 

    <?php
    // while (have_posts()) :
    //     the_post();
    //     if (!is_front_page()) {
    //         get_template_part('parts/page', 'header');
    //     }

    //     get_template_part('parts/page', 'content');
    // endwhile;

    ?>
</div> 

<div class="outercontact">
<img class="backgroundimagelarge" src="<?= get_template_directory_uri();?>/dist/images/background.svg" alt="bakgrund"/>

<div class="contact">

<div class="left">

<h3>Öppettider</h3>
<div class="openinghours">

<?php if( have_rows('times', 'option') ):

 	// loop through the rows of data
    while ( have_rows('times', 'option') ) : the_row();
    $time = get_sub_field('time', 'option');
    $day = get_sub_field('day', 'option');
   

    ?>


<div class="row"><b><?php echo $day?></b> <span><?php echo $time?></span></div>


<?php
    endwhile;

else :

    // no rows found

endif;

?>


</div>

<img src="<?php echo get_field("imagehouse")['url'] ?>" alt="Pomondalens handelsträdgård">

</div>

<div class="right">
<h3>Facebook</h3>
<?php echo do_shortcode('[custom-facebook-feed]') ?>
</div>

</div>
</div>
<div class="instagram">
<h3>Instagram</h3>
<div class="instagramcontainer">

<?php echo do_shortcode('[instagram-feed]') ?>

</div>
</div>

  