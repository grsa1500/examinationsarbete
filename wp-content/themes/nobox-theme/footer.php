<footer id="footer" class="site-footer" role="contentinfo">
   <div class="footercontent"> 

   

<div class="footerflex">
    <div class="logo">
        
    <a href="<?= get_home_url();?>">
    <img src="<?= get_template_directory_uri();?>/dist/images/logotype.png" />
    
    </a>
    <a target="_blank"  href="<?php echo get_field('facebook', 'option') ?>"><i class="fab fa-facebook"></i></a>
    <a target="_blank"  href="<?php echo get_field('instagram', 'option') ?>"><i class="fab fa-instagram"></i></a> 
    </div>

    <div class="opening">
<h4>Öppettider</h4>
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
    </div>

    <div class="footercontact">
    <h4>Kontakt</h4>

    <p>
      <b>Besöksadress:</b>  <?php echo get_field('adress', 'option') ?> <br>
     <b>Telefon:</b> <a href="tel:<?php echo get_field('telefonnummer', 'option') ?>"><?php echo get_field('telefonnummer', 'option') ?></a> <br>
     <b>E-post: </b><a href="mailto:<?php echo antispambot(get_field('e-postadress', 'option')) ?>"><?php echo antispambot(get_field('e-postadress', 'option')) ?></a>  <br>
   <br>


    </p>
    </div>
</div>

 <div class="container">
        <div class="site-footer__copyright">
            <span class="site-footer__copy">&copy; <?= esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?></span>
            <span class="site-footer__produced-by"><?= wp_kses_post(get_option('horizon_footer_text')) ?></span>
        </div>
    </div></div>
</footer>

<script>
    /* eslint-disable */
    (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
    (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
    l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-140967719-12', 'pomonadalen.com');
    ga('send', 'pageview');
</script>


<?php
wp_footer();
