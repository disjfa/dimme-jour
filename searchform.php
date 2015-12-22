<form action="<?php echo home_url( '/' ); ?>" method="get" class="form">
    <div class="form-group">
		<div class="input-group">
			<input type="text" name="s" id="search" placeholder="<?php _e("Search", "dimme-jour"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary"><?php _e("Search", "dimme-jour"); ?></button>
			</span>
		</div>
    </div>
</form>