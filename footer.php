</div><!--End Sticky Footer-->

<?php
$opt_back_to_top = healthnews_get_option( 'opt_general_back_to_top', '1' );

get_template_part('components/inc','loading');

if ( $opt_back_to_top == '1' ) :
?>
    <div id="back-top">
        <a class="btn-back-top" href="#">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
<?php
endif;

if ( !is_404() ) :
?>
    <footer class="global-footer">
        <?php
        get_template_part( 'components/footer/inc','nav' );
        get_template_part( 'components/footer/inc','column' );
        ?>
    </footer>
<?php
	get_template_part('components/inc','menu-mobile');
	get_template_part('components/inc','chat-with-us');
	get_template_part('components/inc','contact-us-mobile');
	get_template_part('components/inc','modal-medical-appointment');
endif;

wp_footer();
?>

</body>
</html>
