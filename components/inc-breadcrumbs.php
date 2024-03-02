<?php if(function_exists('bcn_display')) : ?>

	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
		<div class="container">
            <div class="breadcrumbs-col">
	            <?php bcn_display(); ?>
            </div>
		</div>
	</div>

<?php endif; ?>