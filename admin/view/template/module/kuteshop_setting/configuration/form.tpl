<div class="ui grid centered">
	<div class="four wide column ">
		<div class="ui fluid search selection dropdown choose-store">
			<input type="hidden" name="store_id">
			<i class="dropdown icon"></i>
			<div class="default text"><?php echo $translator->_('Select Store')?></div>
			<div class="menu">
				<?php foreach($stores as $store) { ?>
				<div class="item" data-value="<?php echo $store['store_id']?>"><?php echo $store['name']?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="four wide column">
		<div class="ui facebook teal labeled icon button select-store">
			<i class="icon plug"></i>
			ENTER
		</div>
	</div>
</div>

<script type="text/javascript">
	j$original('.choose-store').dropdown();
</script>