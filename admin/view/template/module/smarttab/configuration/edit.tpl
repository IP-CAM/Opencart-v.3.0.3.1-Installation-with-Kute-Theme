<input type="hidden" name="module_id" value="<?php echo $module_id?>">
<input type="hidden" name="category_id" value="<?php echo $module['category_id']?>">
<input type="hidden" name="name" value="<?php echo $module['name']?>">
<input type="hidden" name="status" value="1">
<!-- [START]  -->
<div style="clear:both;height: 25px;"></div>
<div class="ui grid design-smarttab">
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
					<table class="ui very basic table">
						<tbody>
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
                                <input type="text" name="limit_product" style="width:85px;" placeholder="6" value=" <?php echo (isset($module['limit_product']) ? $module['limit_product'] : '6')?>">
                            </td>
							<!-- CONFIG LAYOUT -->
							<tr>
								<td style="display: none" class="right aligned"><label for="">Layout</label></td>
								<td style="display: none">
									<div class="ui fitted two selection dropdown disabled choose-layout">
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
										<input type="checkbox" name="status_box_list_brand" <?php echo (isset($module['status_box_list_brand']) ? 'checked="true"' : '')?>>
									</div>
								</td>
								<td class="one column wide right aligned"><label for="">Show latest deal</label></td>
								<td class="one column wide">
									<div class="ui fitted toggle checkbox">
										<input type="checkbox" name="status_box_last_deal" <?php echo (isset($module['status_box_last_deal']) ? 'checked="true"' : '')?>>
									</div>
								</td>
							</tr>
							<tr>
								<td class="one  right aligned"><label for="">Color</label></td>
								<td class="one column wide">
									<!--<<input type="text" class="color" style="width:85px;" name="color_id" value="<?php echo $module['color_id']?>">-->
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
								<td class="one  right aligned"><label for="">Icon</label></td>
								<td class="one ">
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
								<td class=" right aligned"><label for="">Most Viewed</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_most_viewed" <?php echo (isset($module['status_most_viewed']) ? 'checked="true"' : '')?>>
									</div>
								</td>
							</tr>
							<tr>
								<td class=" right aligned"><label>Best Seller</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_best_seller" <?php echo (isset($module['status_best_seller']) ? 'checked="true"' : '')?>>
									</div>
								</td>
							</tr>
							<tr>
								<td class=" right aligned"><label>Most Review</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_most_review" <?php echo (isset($module['status_most_review']) ? 'checked="true"' : '')?>>
									</div>
								</td>
							</tr>
							<tr>
								<td class=" right aligned"><label>New Arrivals</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_new_arrivals" <?php echo (isset($module['status_new_arrivals']) ? 'checked="true"' : '')?>>
									</div>
								</td>
							</tr>
							<tr>
								<td class=" right aligned"><label>Special</label></td>
								<td colspan="3">
									<div class="ui toggle checkbox">
										<input type="checkbox" name="status_special" <?php echo (isset($module['status_special']) ? 'checked="true"' : '')?>>
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
							<td class="two  right aligned"><label for="">Top Left</label></td>
							<td class="one column wide">
								<a href="" id="thumb-image-top-left" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $module['thumb_banner_top_left']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_top_left" value="<?php echo $module['banner_top_left']?>" id="input-image-top-left" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_top_left" <?php echo (isset($module['status_banner_top_left']) ? 'checked="true"' : '')?>>
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_top_left" value="<?php echo (isset($module['url_banner_top_left']) ? $module['url_banner_top_left'] : '')?>" placeholder="LINK TOP LEFT" style="width: 200px;">
							</td>
							<td class="two  right aligned"><label for="">Top Right</label></td>
							<td class="one column wide">
								<a href="" id="thumb-image-top-right" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $module['thumb_banner_top_right']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_top_right" value="<?php echo $module['banner_top_right']?>" id="input-image-top-right" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_top_right" <?php echo (isset($module['status_banner_top_right']) ? 'checked="true"' : '')?>>
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_top_right"  value="<?php echo (isset($module['url_banner_top_right']) ? $module['url_banner_top_right'] : '')?>" placeholder="LINK TOP RIGHT" style="width: 200px;">
							</td>
						</tr>
						<tr>
							<td class=" right aligned"><label>Right</label></td>
							<td>
								<a href="" id="thumb-image-right" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $module['thumb_banner_right']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_right" value="<?php echo $module['banner_right']?>" id="input-image-right" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_right" <?php echo (isset($module['status_banner_right']) ? 'checked="true"' : '')?>>
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_right"  value="<?php echo (isset($module['url_banner_right']) ? $module['url_banner_right'] : '')?>" placeholder="LINK RIGHT" style="width: 200px;">
							</td>
						</tr>
						<tr>
							<td class=" right aligned"><label>Bottom</label></td>
							<td>
								<a href="" id="thumb-image-bottom" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $module['thumb_banner_bottom']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_bottom" value="<?php echo $module['banner_bottom']?>" id="input-image-bottom" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_bottom" <?php echo (isset($module['status_banner_bottom']) ? 'checked="true"' : '')?>>
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_bottom"  value="<?php echo (isset($module['url_banner_bottom']) ? $module['url_banner_bottom'] : '')?>" placeholder="LINK BOTTOM" style="width: 200px;">
							</td>
						</tr>
						<tr>
							<td class=" right aligned"><label>Left</label></td>
							<td>
								<a href="" id="thumb-image-left" data-toggle="image" class="img-thumbnail">
									<img src="<?php echo $module['thumb_banner_left']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder_image; ?>" />
								</a>
								<input type="hidden" name="banner_left" value="<?php echo $module['banner_left']?>" id="input-image-left" />
							</td>
							<td class="one column wide">
								<div class="ui toggle checkbox">
									<input type="checkbox" name="status_banner_left" <?php echo (isset($module['status_banner_left']) ? 'checked="true"' : '')?>>
								</div>
							</td>
							<td class="one column wide">
								<input type="text" name="url_banner_left"  value="<?php echo isset($module['url_banner_left']) ? $module['url_banner_left'] : ''?>" placeholder="LINK LEFT" style="width: 200px;">
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
					<div class="four wide column ">
						<div class="ui fluid search selection dropdown choose-sub-category">
							<input type="hidden" name="subcategory_id">
							<i class="dropdown icon"></i>
							<div class="default text">Select Subcategory</div>
							<div class="menu">
								<?php foreach($subcategories as $sub){ ?>
								<div class="item" data-value="<?php echo $sub['category_id']?>"><?php echo $sub['name']?></div>
								<?php } ?>
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
                        <div class="fluid  ">
                            <table class="ui very basic table active-subcategories">
                                <tbody>
                                <?php if(isset($module['subcategory'])){ ?>
                                    <?php foreach($module['subcategory'] as $sub){ ?>
                                        <tr>
                                            <td class="three  right aligned"><label><?php echo $sub['name']?></label>
                                                <input type="hidden" name="subcategory[<?php echo $sub['id']?>][id]" value="<?php echo $sub['id']?>">
                                                <input type="hidden" name="subcategory[<?php echo $sub['id']?>][name]" value="<?php echo $sub['name']?>">
                                            </td>
                                            <td class="three ">
                                                <div class="ui toggle checkbox">
                                                    <input type="checkbox" name="subcategory[<?php echo $sub['id']?>][status]" <?php echo (isset($sub['status']) ? 'checked="checked"' : '')?>>
                                                </div>
                                                <i class="trash large red icon remove-sub-category" style="cursor: pointer"></i>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
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
	j$original('.choose-sub-category').dropdown();
	j$original('.choose-color').dropdown('set selected', "<?php echo $module['color_id']?>");
	j$original('.choose-store').dropdown('set selected', "<?php echo $module['store_id']?>");
	j$original('.choose-layout').dropdown('set selected', "<?php echo $layout_id?>");
	//j$original('.choose-layout').dropdown('set selected', "<?php echo $module['layout_id']?>");
	j$original('.choose-icon').dropdown('set selected', "<?php echo $module['icon_id']?>");
	j$original('.ui.checkbox').checkbox();
	j$original('.tabular.menu .item').tab();
</script>