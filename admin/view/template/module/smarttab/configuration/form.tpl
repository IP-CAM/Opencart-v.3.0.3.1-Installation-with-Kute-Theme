<!-- [START] List all modules was created -->

<table class="ui celled striped table list-modules">
	<thead>
		<th>Category</th>
		<th>Category</th>
		<th>Store</th>
		<!--<th class="center aligned">MostViewed</th>
		<th class="center aligned">BestSeller</th>
		<th class="center aligned">MReview</th>
		<th class="center aligned">NewArrival</th>
		<th class="center aligned">Special</th>-->
		<th class="center aligned">#</th>
	</thead>
	<tbody>
		<?php if(count($modules)) { ?>
			<?php foreach($modules as $module) { ?>
			<tr data-module-id="<?php echo $module['module_id']?>">
				<td class="collapsing"><?php echo $module['name']?></td>
				<td class="collapsing"><?php echo $module['category_name']?></td>
				<td class="collapsing center aligned"><?php echo ucwords($model_store->getStore($module['store_id'], 'name'))?></td>
				<!--<td class="collapsing center aligned">
					<i class="circle toggle large <?php echo (isset($module['status_most_viewed']) ? 'on green' : 'off')?> icon"></i>
				</td>
				<td class="collapsing center aligned">
					<i class="circle toggle large <?php echo (isset($module['status_best_seller']) ? 'on green' : 'off')?> icon"></i>
				</td>
				<td class="collapsing center aligned">
					<i class="circle toggle large <?php echo (isset($module['status_most_review']) ? 'on green' : 'off')?> icon"></i>
				</td>
				<td class="collapsing center aligned">
					<i class="circle toggle large <?php echo (isset($module['status_new_arrivals']) ? 'on green' : 'off')?> icon"></i>
				</td>
				<td class="collapsing center aligned">
					<i class="circle toggle large <?php echo (isset($module['status_special']) ? 'on green' : 'off')?> icon"></i>
				</td>-->
				<td class="collapsing center aligned">
					<a target="_blank" href="index.php?route=module/smarttab&token=<?php echo $token?>&module_id=<?php echo $module['module_id']?>"><i class="zoom icon large blue" style="cursor: pointer"></i></a>
					<i class="trash large red icon remove-category" style="cursor: pointer"></i>
				</td>
			</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
			<td colspan="8">Empty data</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<!-- [END] List all modules was created -->
<div class="ui grid centered select-category-step1">
	<div class="four wide column ">
		<div class="ui fluid search selection dropdown choose-category">
			<input type="hidden" name="category_id">
			<i class="dropdown icon"></i>
			<div class="default text">Select Category</div>
			<div class="menu">
				<?php foreach($categories as $category) { ?>
				<div class="item" data-value="<?php echo $category['category_id']?>"><?php echo $category['name']?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="four wide column">
		<div class="ui positive teal labeled icon button add-category">
			<i class="icon add"></i>
			Add
		</div>
	</div>
</div>
<!-- [START]  -->
<div style="clear:both;height: 25px;"></div>
<div class="ui grid design-smarttab hide">
	<div class="ui form">
		<div class="ui tabular menu">
			<div class="item active" data-tab="tab-configuration">Configuration</div>
			<div class="item" data-tab="tab-banner">Sale Banners</div>
			<div class="item" data-tab="tab-sub-categories">On/Off Sub category</div>
		</div>
		<!-- TAB CONFIGURATION -->
		<div class="ui tab active" data-tab="tab-configuration">
			<div class="ui grid column centered">
				<div class="column">
					<input type="hidden" name="status" value="1">
					<table class="ui very basic table">
						<tbody>
							<!-- CONFIG LAYOUT -->
							<tr>
								<td class="right aligned"><label for="">Store</label></td>
								<td>
									<div class="ui two selection dropdown choose-store">
										<input type="hidden" name="store_id" value=">">
										<i class="dropdown icon"></i>
										<div class="default text">Select Store</div>
										<div class="menu">
											<?php foreach($stores as $store) { ?>
											<div class="item" data-value="<?php echo $store['store_id']?>"><?php echo $store['name']?></div>
											<?php } ?>
										</div>
									</div>
									<a href="javascript:;" target="_blank"><i class="help circle icon"></i></a>
								</td>
                                <td class="right aligned"><label for="">Limit product</label></td>
                                <td>
                                    <input type="text" name="limit_product" style="width:85px;" placeholder="6" value="">
                                </td>
								<td class="right aligned" style="display: none"><label for="">Layout</label></td>
								<td style="display: none">
									<div class="ui two selection dropdown choose-layout disabled">
										<input type="hidden" name="layout_id" value="">
										<i class="dropdown icon"></i>
										<div class="default text">Select Layout</div>
										<div class="menu">
											<?php foreach($layouts as $layout_id => $layout_name) { ?>
											<div class="item" data-value="<?php echo $layout_id?>"><?php echo $layout_name?></div>
											<?php } ?>
										</div>
									</div>
									<a href="javascript:;" target="_blank"><i class="help circle icon"></i></a>
								</td>
							</tr>
							<!-- CONFIG SHOW MANUFACTURER FOR LAYOUT ID: 2 -->
							<tr>
								<td class="one column wide  right aligned"><label for="">Show list BRAND</label></td>
								<td class="one column wide">
									<div class="ui fitted toggle checkbox">
										<input type="checkbox" name="status_box_list_brand">
									</div>
								</td>
								<td class="one column wide right aligned"><label for="">Show latest deal</label></td>
								<td class="one column wide">
									<div class="ui fitted toggle checkbox">
										<input type="checkbox" name="status_box_last_deal">
									</div>
								</td>
							</tr>
							<tr>
								<td class="one right aligned"><label for="">Color</label></td>
								<td class="one column wide">
									<!--<input type="text" class="color" style="width:85px;" name="color_id">-->
									<div class="ui selection search dropdown choose-color">
										<input type="hidden" name="color_id">
										<i class="dropdown icon"></i>
										<div class="default text">Select style color</div>
										<div class="menu">
											<div class="item" data-value="red"><span class="style-color" style="background: #ff3366;"></span><?php echo 'red'?></div>
											<div class="item" data-value="green"><span class="style-color" style="background: #339966;"></span><?php echo 'green'?></div>

											<div class="item" data-value="blue"> <span class="style-color" style="background: #3366cc;"></span><?php echo 'blue'?></div>
											<div class="item" data-value="blue2"><span class="style-color" style="background: #669900;"></span><?php echo 'blue 2'?></div>
											<div class="item" data-value="gray"><span class="style-color" style="background: #6c6856;"></span><?php echo 'gray'?></div>
											<div class="item" data-value="orange"><span class="style-color" style="background: #0090c9;"></span><?php echo 'bright blue'?></div>
										</div>
									</div>
								</td>
								<td class="one right aligned"><label for="">Icon</label></td>
								<td class="one wide column">
									<div class="ui selection search dropdown choose-icon">
										<input type="hidden" name="icon_id">
										<i class="dropdown icon"></i>
										<div class="default text">Select Icon</div>
										<div class="menu">
											<?php foreach($icons as $icon) { ?>
											<div class="item" data-value="<?php echo $icon?>"><i class="fa <?php echo $icon?>"></i> <?php echo $icon?></div>
											<?php } ?>
										</div>
									</div>
									<a href="http://bit.ly/1VwOWEp" target="_blank"><i class="help circle icon"></i></a>
								</td>
							</tr>
							<tr>
								<td class="right aligned"><label for="">Most Viewed</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_most_viewed">
									</div>
								</td>
							</tr>
							<tr>
								<td class="right aligned"><label>Best Seller</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_best_seller">
									</div>
								</td>
							</tr>
							<tr>
								<td class="right aligned"><label>Most Review</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_most_review">
									</div>
								</td>
							</tr>
							<tr>
								<td class="right aligned"><label>New Arrivals</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_new_arrivals">
									</div>
								</td>
							</tr>
							<tr>
								<td class="right aligned"><label>Special</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_special">
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- TAB BANNER -->
		<div class="ui tab" data-tab="tab-banner">
			<div class="ui grid column centered">
				<div class="column">
					<table class="ui very basic table">
						<tbody>
						<tr>
							<td class="two right aligned"><label for="">Top Left</label></td>
							<td class="one column wide">
								<a href="" id="thumb-image-top-left" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $no_image; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_top_left" value="" id="input-image-top-left" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_top_left">
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_top_left" placeholder="LINK TOP LEFT" style="width: 200px;">
							</td>
							<td class="two right aligned"><label for="">Top Right</label></td>
							<td class="one column wide">
								<a href="" id="thumb-image-top-right" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $no_image; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_top_right" value="" id="input-image-top-right" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_top_right">
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_top_right" placeholder="LINK TOP RIGHT" style="width: 200px;">
							</td>
						</tr>
						<tr>
							<td class="right aligned"><label>Right</label></td>
							<td>
								<a href="" id="thumb-image-right" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $no_image; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_right" value="" id="input-image-right" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_right">
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_right" placeholder="LINK RIGHT" style="width: 200px;">
							</td>
						</tr>
						<tr>
							<td class="right aligned"><label>Bottom</label></td>
							<td>
								<a href="" id="thumb-image-bottom" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $no_image; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_bottom" value="" id="input-image-bottom" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_bottom">
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_bottom" placeholder="LINK BOTTOM" style="width: 200px;">
							</td>
						</tr>
						</tr>
						<tr>
							<td class="right aligned"><label>Left</label></td>
							<td>
								<a href="" id="thumb-image-left" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $no_image; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_left" value="" id="input-image-left" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_left">
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_left" placeholder="LINK LEFT" style="width: 200px;">
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- TAB SUB CATEGORY -->
		<div class="ui tab" data-tab="tab-sub-categories">
			<div class="ui grid column centered">
				<div class="ui grid centered">
					<div class="four wide column">
						<div class="ui fluid search selection dropdown choose-sub-category">
							<input type="hidden" name="subcategory_id">
							<i class="dropdown icon"></i>
							<div class="default text">Select Subcategory</div>
							<div class="menu">
								<div class="item" data-value=""></div>
							</div>
						</div>
					</div>
					<div class="four wide column">
						<div class="ui positive teal labeled icon button add-sub-category">
							<i class="icon add"></i>
							Add
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="ui six column grid centered">
                        <div class="fluid ">
                            <table class="ui very basic table active-subcategories">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var url_remove_module = '<?php echo html_entity_decode($url_remove_module)?>';
	var url_load_subcategory = '<?php echo html_entity_decode($url_load_subcategory)?>';
	j$original('.choose-category').dropdown();
	j$original('.choose-store').dropdown();
	j$original('.choose-layout').dropdown();
	j$original('.choose-icon').dropdown();
	j$original('.choose-color').dropdown();
	j$original('.ui.checkbox').checkbox();
	j$original('.tabular.menu .item').tab();
</script>