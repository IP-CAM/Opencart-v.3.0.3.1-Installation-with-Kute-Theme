<div class="col-sm-2 manufacture-list">
	<div class="manufacture-waper">
		<div class="owl-carousel-vertical" data-items="1" data-autoplay="false" data-nav="true" data-dots="false" data-loop="true" >
			<div class="item">
				<ul >
					<?php foreach($brands as $brand) { ?>
					<li><a href="<?php echo $brand['href']?>"><img src="<?php echo $brand['thumb']?>" alt="<?php echo $brand['name']?>"></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="item">
				<ul >
					<?php foreach($brands as $brand) { ?>
					<li><a href="<?php echo $brand['href']?>"><img src="<?php echo $brand['thumb']?>" alt="<?php echo $brand['name']?>"></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>