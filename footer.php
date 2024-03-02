</div><!--End Sticky Footer-->

<?php
$opt_back_to_top = basictheme_get_option( 'opt_general_back_to_top', '1' );

get_template_part('components/inc','loading');

if ( $opt_back_to_top == '1' ) :
?>
    <div id="back-top">
        <a href="#">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
<?php
endif;

if ( !is_404() ) :
?>
    <footer class="global-footer">
        <?php
        get_template_part( 'components/footer/inc','column' );

        get_template_part( 'components/footer/inc','copyright' );
        ?>
    </footer>
<?php
endif;

wp_footer();
?>

</body>
</html>
