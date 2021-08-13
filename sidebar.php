<?php

// if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
// 	return;
// }
?>

<aside id="secondary" class="col-lg-4">

		<?php if ( ! dynamic_sidebar('sidebar-blog')) : dynamic_sidebar('sidebar-blog'); endif; ?> 

		<div class="sidebar-widget download">
							<h5 class="mb-4">Полезные файлы</h5>
							<a href="#"> <i class="fa fa-file-pdf"></i>Презентация Promodise</a>
							<a href="#"> <i class="fa fa-file-pdf"></i>10 источников бесплатного SEO</a>
					</div>

</aside><!-- #secondary -->
