<!-- [START]  -->
<div style="clear:both;height: 25px;"></div>
<div class="ui pointing secondary menu">
	<a class="active item" data-tab="first">GLOBAL SETTINGS</a>
	<a class="item" data-tab="second" id="config_pages">CONFIG PAGES/MODULES</a>
</div>
<input type="hidden" name="selected_store_id" value="<?php echo $store_id?>">
<div class="ui active tab segment" data-tab="first">
	<!-- STARTING SPLIT COLUMNS -->
	<div class="ui grid">
		<!-- STARTING SPLIT ROW -->
		<!-- ROW FOR CONFIG LAYOUT -->
        <div class="ui grid column centered">
            <div class="column">
                <table class="ui very basic table">
                    <tbody>
                    <tr>
                        <td class="right aligned">
                            <label  for="">Enable cached</label>
                        </td>
                        <td>
                            <div class="ui toggle checkbox">
                                <input type="checkbox" name="ocivity3_kuteshop_theme[cached]?>]" value="1" <?php echo (isset($enable_cached) && $enable_cached ? 'checked="checked"' : '')?>>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="right aligned">
                            <label  for="">Use layout</label>
                        </td>
                        <td>
                            <div class="ui column search selection dropdown choose-layout">
                                <input type="hidden" name="ocivity3_kuteshop_theme[layout_id]" value="<?php echo (isset($current_layout_id) ? $current_layout_id : 1)?>">
                                <i class="dropdown icon"></i>
                                <div class="default text">Select layout</div>
                                <div class="menu">
                                    <?php foreach($layouts as $layout_id => $layout_name) { ?>
                                        <div class="item" data-value="<?php echo $layout_id?>"><?php echo $layout_name?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
<div class="ui tab segment setting-layout-pages" data-tab="second">
	<div class="ui grid">
		<div class="ui two column centered grid">
		<?php echo $translator->_('Please select layout')?>
		</div>
	</div>
</div>

<script type="text/javascript">
	var url_load_pages = '<?php echo html_entity_decode($url_load_pages)?>';
	j$original('.choose-layout').dropdown('set selected', '<?php echo (isset($current_layout_id) ? $current_layout_id : 1)?>');

	loadLayout(<?php echo (isset($setting_info['ocivity3_kuteshop_theme']['layout_id']) ? $setting_info['ocivity3_kuteshop_theme']['layout_id'] : 1)?>);

	j$original('.choose-layout').dropdown({
		onChange: function(value, text, $selectedItem){
			loadLayout(value);
		}
	});

	function loadLayout(value){
		j$original(".setting-layout-pages").html('<?php echo $translator->_('Huh? Network? Slowly? Waiting pls ...')?>');
		j$original("#config_pages").find("i").remove();
		j$original("#config_pages").append('<i class="spinner loading icon"></i>');
		j$original.ajax({
			type: 'POST',
			url: url_load_pages,
			dataType: 'json',
			data: 'layout_id=' + value,
			success: function (data) {
				j$original("#config_pages").find("i").remove();
				if(!data.html){
					j$original(".setting-layout-pages").html('<?php echo $translator->_('Empty layout')?>');
				}else{
					j$original(".setting-layout-pages").html(data.html);
					refreshUI();
				}
			},
			error: function(){
				j$original("#config_pages").find("i").remove();
			}
		});
	}

	function refreshUI(){
		j$original('.ui.checkbox').checkbox();
		j$original('.menu .item').tab();
	}
	refreshUI();
</script>