<?php if(!isset($ajax)) { ?>
    <?php echo $header; ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $column_left; ?>
<?php } ?>
<?php if(!isset($ajax)) { ?>
<div id="content" class="theme-setting">
<form name="form-setting" method="post" class="form-horizontal form-label-left">
<div class="nav-md">
    <div class="container body">
        <div class="main_container">
<?php } ?>
            <?php if(!isset($ajax)) { ?>
            <div class="row">
                <div class="col-xs-12">
                    <?php if ($error_warning) { ?>
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $error_warning; ?>
                            <?php foreach($errors as $k => $error){ ?>
                                <?php if($k != 'warning'){ ?>
                                    <li><?php echo $error?></li>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($success) { ?>
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <?php echo $success; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-6">
                        <br>
                        <div class="col-md-3">
                            <select name="language_id" id="language_id" class="form-control selection-img">
                                <?php foreach($languages as $language) { ?>
                                    <option value="<?php echo $language['code']?>" <?php echo ($current_language == $language['code'] ? 'selected="selected"' : '')?> data-image="<?php echo HTTP_CATALOG."image/flags/".$language['image']?>"><?php echo $language['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php if(is_array($stores) && count($stores) > 0) { ?>
                        <div class="col-md-3">
                            <select name="store_id" class="form-control selection-store">
                                <?php foreach($stores as $_store) { ?>
                                    <option value="<?php echo $_store['store_id']?>" <?php echo ($current_store == $_store['store_id'] ? 'selected="selected"' : '')?>>Store <?php echo $_store['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } else { ?>
                            <input type="hidden" name="store_id" value="0">
                        <?php } ?>
                    </div>
                    <div class="col-md-6 pull-right">
                        <br>
                        <button type="button" class="btn btn btn-primary pull-right save">Save setting</button>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row" style="position: relative">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-xs-12">
                            <div class="col-xs-9">
                                <!-- Tab panes -->
                                <div class="main tab-content block-content">
                                    <?php foreach($tabs as $tab) {?>
                                    <div class="tab-pane <?php echo (isset($tab['active']) && $tab['active'] ? 'active' : '')?>" id="<?php echo $tab['tab_id']?>"><?php echo $tab['html']?></div>
                                    <?php } ?>
                                </div>

                            </div>

                            <div class="col-xs-3">
                                <!-- required for floating -->
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-right">
                                    <?php foreach($tabs as $tab) {?>
                                        <li class="<?php echo (isset($tab['active']) && $tab['active'] ? 'active' : '')?>"><a href="#<?php echo $tab['tab_id']?>" data-toggle="tab"><i class="<?php echo (isset($tab['icon']) ? $tab['icon'] : '')?>"></i> <?php echo $tab['title']?></a></li>
                                    <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php if(!isset($ajax)) { ?>
        </div>
    </div>
</div>
</form>
</div>
<?php } ?>
<?php if(!isset($ajax)) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            loadJSSwitch();
            var container_theme = $(".theme-setting");
            $(".colorpicker-element").colorpicker();

            container_theme.find("button.save").on("click", function(){
                var form = $("form[name=form-setting]");
                var vertical_menu_data = $('#domenu-1').domenu('serialize');
                $("input[type=hidden][name=kutetheme_setting_vertical_menu]").val(JSON.stringify(vertical_menu_data));
                form.submit();
            });
            $(".selection-store").select2({}).on('change', function(e){
                getHtmlConfiguration('store_id', $(e.currentTarget).val());
            });
            $(".selection-img").select2({
                templateResult: formatImgItem,
                templateSelection: formatSelectedItem
            }).on('change', function(e){
                getHtmlConfiguration('language', $(e.currentTarget).val());
            });

            function getHtmlConfiguration(field, value){
                <?php if(!$is_duplicated) { ?>
                var container_content = $(".theme-setting .main_container");
                var spiner_html = '<span class="mif-spinner mif-ani-spin" style="position: absolute;top: 30%; left:50%;z-index:9999;font-size: 6em;"></span>';

                container_content.find(".row:eq(2)").prepend(spiner_html);
                container_content.find(".row:eq(2)").find(".x_panel").css("opacity", "0.2");
                $.ajax({
                    type: 'GET',
                    url: 'index.php?route=module/kuteshop_setting_v2&token=<?php echo $token?>',
                    data: 'ajax=true&'+field+'='+value,
                    success: function(data){
                        container_content.find(".row:eq(2)").remove();
                        $(".theme-setting .main_container").append(data);
                        container_content.find(".row:eq(2)").find(".x_panel").css("opacity", "1");
                        container_content.find(".row:eq(2)").find(".mif-spinner").remove();
                        loadJSSwitch();
                    }
                });
                <?php } ?>
            }

            function formatImgItem (state) {
                if (!state.id) { return state.text; }
                var $state = $(
                    '<span><img src="' + $(state.element).data('image') + '" class="" /> ' + state.text + '</span>'
                );
                return $state.html();
            }

            function formatSelectedItem(e){
                return '<span><img src="' + $(e.element).data('image') + '" class="" /> ' + e.text + '</span>';
            }
        });
    </script>
    <?php echo $footer; ?>
<?php } ?>
