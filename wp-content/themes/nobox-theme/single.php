
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
  </div>


        <div class="post-thumbnail">
                        <?php

                        if (has_post_thumbnail()) :
                            the_post_thumbnail();
                        endif;
                        ?>

                    </div>
                </div>

    <?php endwhile;
else : ?>

<?php endif; ?>

</div>