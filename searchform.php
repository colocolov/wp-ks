<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" class="form-group search">
  <input type="text" placeholder="поиск" class="form-control" value="<?php echo get_search_query() ?>" name="s" id="s" />
  <button type="submit" id="searchsubmit" value=""/>
    <i class="fa fa-search"></i>
  </button>
</form>