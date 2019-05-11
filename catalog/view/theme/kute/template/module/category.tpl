<div class="list-group block left-module">
	<p class="title_block"><?php echo $translator->_('Categories')?></p>
	<div class="block_content">
        <div class="layered layered-category">
        	<div class="layered-content">
				<ul class="tree-menu">
					  <?php foreach ($categories as $category) { ?>
					  <?php if ($category['category_id'] == $category_id) { ?>
					  <li class="active"><span></span><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
					  <?php if ($category['children']) { ?>
					  <?php foreach ($category['children'] as $child) { ?>
					  <?php if ($child['category_id'] == $child_id) { ?>
					  <li class="active"><span></span><a href="<?php echo $child['href']; ?>">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a></li>
					  <?php } else { ?>
					  <li><span></span><a href="<?php echo $child['href']; ?>">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a></li>
					  <?php } ?>
					  <?php } ?>
					  <?php } ?>
					  <?php } else { ?>
					  <li><span></span><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
					  <?php } ?>
					  <?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
