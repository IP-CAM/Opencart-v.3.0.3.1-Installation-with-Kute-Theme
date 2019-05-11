<!-- block filter -->
<div class="block left-module advanced_category_filter">
	<p class="title_block"><?php echo $translator->_('Filter selection')?></p>
	<div class="block_content">
		<!-- layered -->
		<div class="layered layered-filter-price">
			<!-- filter categgory -->
			<!--<div class="layered_subtitle"><?php echo $translator->_('CATEGORIES')?></div>
			<div class="layered-content">
				<ul class="check-box-list">
					<?php foreach($categories as $category){ ?>
					<li>
						<input type="checkbox" id="c<?php echo $category['category_id']?>" value="<?php echo $category['category_id']?>" name="category[]" <?php echo (in_array($category['category_id'], $selected_category_ids) ? 'checked="checked"' : '')?>/>
						<label for="c<?php echo $category['category_id']?>">
							<span class="button"></span>
							<?php echo $category['name']?>
						</label>
					</li>
					<?php } ?>
				</ul>
			</div>-->
			<!-- ./filter categgory -->
			<!-- filter price -->
			<div class="layered_subtitle"><?php echo $translator->_('price')?></div>
			<div class="layered-content slider-range">

				<div
                    data-label-reasult="<?php echo $translator->_('Range:')?>"
                    data-min="<?php echo $range_price['min']?>"
                    data-max="<?php echo $range_price['max']?>"
                    data-unit="<?php echo $currency_code?>" class="slider-range-price"
                    data-value-min="<?php echo (!empty($selected_prices_range[0]) ?$selected_prices_range[0] : $range_price['min'])?>"
                    data-value-max="<?php echo (!empty($selected_prices_range[1]) ?$selected_prices_range[1] : $range_price['max'])?>"></div>
				<div class="amount-range-price"><?php echo $translator->_('Range:')?> <?php echo $currency_code?><?php echo (!empty($selected_prices_range[0]) ?$selected_prices_range[0] : $range_price['min'])?> - <?php echo $currency_code?><?php echo (!empty($selected_prices_range[1]) ?$selected_prices_range[1] : $range_price['max'])?></div>
				<!--@TODO: Do in next phase -->
				<!--<ul class="check-box-list">
					<li>
						<input type="checkbox" id="p1" name="cc" />
						<label for="p1">
							<span class="button"></span>
							$20 - $50<span class="count">(0)</span>
						</label>
					</li>
					<li>
						<input type="checkbox" id="p2" name="cc" />
						<label for="p2">
							<span class="button"></span>
							$50 - $100<span class="count">(0)</span>
						</label>
					</li>
					<li>
						<input type="checkbox" id="p3" name="cc" />
						<label for="p3">
							<span class="button"></span>
							$100 - $250<span class="count">(0)</span>
						</label>
					</li>
				</ul>-->
			</div>
			<!-- ./filter price -->
            <!-- ./filter brand -->
            <?php if(!empty($manufacturers)) { ?>
            <div class="layered_subtitle"><?php echo $translator->_('Brand')?></div>
            <div class="layered-content filter-brand">
                <ul class="check-box-list">
                    <?php foreach($manufacturers as $brand){ ?>
                        <li>
                            <input type="checkbox" id="brand<?php echo $brand['manufacturer_id']?>" name="manufacturer[]" value="<?php echo $brand['manufacturer_id']?>" <?php echo (in_array($brand['manufacturer_id'], $selected_manufacturer_ids) ? 'checked="checked"' : '')?>/>
                            <label for="brand<?php echo $brand['manufacturer_id']?>">
                                <span class="button"></span>
                                <?php echo $brand['name']?><!--<span class="count">(0)</span>-->
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
            <!-- ./filter brand -->
			<!-- filter color -->
            <?php if(!empty($final_options_color)) { ?>
            <?php foreach($final_options_color as $option) { ?>
			<div class="layered_subtitle"><?php echo $translator->_($option['name'])?></div>
			<div class="layered-content filter-color">
				<ul class="check-box-list">
                    <?php foreach($option['option_value'] as $option_value_id => $optv) {?>
					<li>
						<input type="checkbox" id="option<?php echo $option_value_id?>" name="option[]" value="<?php echo $optv['option_value_id']?>" <?php echo (in_array($optv['option_value_id'], $selected_option_ids) ? 'checked="checked"' : '')?>/>
						<label style=" background:url('<?php echo HTTP_SERVER."image/".$optv['image']?>');" for="option<?php echo $option_value_id?>"><span class="button"></span></label>
					</li>
                    <?php } ?>
				</ul>
			</div>
            <?php } ?>
            <?php } ?>
			<!-- ./filter color -->
			<!-- ./filter size -->
            <?php if(!empty($final_options)) { ?>
                <?php foreach($final_options as $option) { ?>
                <div class="layered_subtitle"><?php echo $translator->_($option['name'])?></div>
                <div class="layered-content filter-<?php echo strtolower($option['name'])?>">
                    <ul class="check-box-list">
                        <?php foreach($option['option_value'] as $optv) {?>
                        <li>
                            <input type="checkbox" id="option<?php echo $optv['option_value_id']?>" name="option[]" value="<?php echo $optv['option_value_id']?>" <?php echo (in_array($optv['option_value_id'], $selected_option_ids) ? 'checked="checked"' : '')?>/>
                            <label for="option<?php echo $optv['option_value_id']?>">
                                <span class="button"></span><?php echo $optv['name']?>
                            </label>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            <?php } ?>
			<!-- ./filter size -->
		</div>
		<!-- ./layered -->

	</div>
</div>

<!-- ./block filter  -->
<script type="text/javascript">
    var current_params = '<?php echo $params?>';
</script>
<script src="media/advanced_category_filter/js/main.js" type="text/javascript"></script>
