<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package DocPress
 */
?>


<?php

		/**
		 *
		 * Get Categories
		 *
		 * @since 1.0.0
		 */

		$dp_categories = get_categories();

 ?>

		<nav class="nav-main" id="nav" role="navigation">
		    <ul class="main-menu">

		    <?php
		    		/**
		    		 *
		    		 * List all categories as main-menu-item
		    		 *
		    		 */
		    		foreach ($dp_categories as $dp_category) {
		    			?>
							<li>
							    <a href="#" class="menu-item">
							        <span class="main-menu-item">
							            <i class="glyphicon glyphicon-cog"></i><?php echo $dp_category->name; ?><span class="glyphicon glyphicon-chevron-right"></span>
							        </span>
							    </a>


								<ul class="sub-menu">
									<?php

										/**
										 *
										 * Query all the post titles in particular category
										 *
										 */
										$dp_cat_id = $dp_category->term_id;

										/**
										 * Query the category in question
										 *
										 */
										$dp_loop_args = array(

											'cat'   => $dp_cat_id,
											'order' => 'ASC'
										);

										$dp_cat_post_titles = new WP_Query( $dp_loop_args );

										while ( $dp_cat_post_titles->have_posts() ) : $dp_cat_post_titles->the_post();

									 ?>

								        <li><a class="sub-menu-item" href="#dp_<?php the_id(); ?>"><?php the_title(); ?></a></li>

									<?php endwhile; ?>

							    </ul>
							</li>

		    			<?php

		    		}

		     ?>



		    </ul>
		</nav>
