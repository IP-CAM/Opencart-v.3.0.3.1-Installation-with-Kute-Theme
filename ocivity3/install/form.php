<head><!---->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Install KUTESHOP Theme</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="lib/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="lib/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="lib/AdminLTE/dist/css/skins/skin-black-light.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue">
<div class="wrapper">
    <section class="conten">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="box box-danger">
                    <!--<div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>--><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" onsubmit="return false;">
                        <div class="box-body main">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Admin folder</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="admin_folder" id="admin_folder" placeholder="Enter your admin folder">
                                </div>
                            </div>
                            <div class="form-group enter-purchased-code">
                                <label for="" class="col-sm-3 control-label">Purchased code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="purchased_code" placeholder="Enter your purchased code">
                                </div>
                            </div>
                            <?php if($enable_import_sample) { ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="icl_sample_data"> Install sample data <i>(please backup your database before import sample data)</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group choose-theme" style="display:none">
                                    <label for="" class="col-sm-3 control-label">Which theme to import?</label>
                                    <div class="col-sm-9">
                                        <select name="option_id" class="form-control" id="">
                                            <option value="1">Demo theme 1</option>
                                            <option value="2">Demo theme 2</option>
                                            <option value="5">Demo theme 5</option>
                                            <option value="6">Demo theme 6</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger install">Install Now</button>
                            <span class="loading" style="display:none"><i class="fa fa-spinner fa-pulse fa-1x fa-fw margin-bottom"></i></span>
                        </div><!-- /.box-footer -->
                        <div class="box-body message">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function(){
        $(".install").on('click', function(){
            var data_form = $("form").serialize();
            var container_footer    = $(".box-footer");
            var container_main      = $(".box-body.main");
            var container_message   = $(".box-body.message");
            var self                = this;

            container_footer.find(".loading").show();
            container_message.show().html("");
            $.ajax({
                type: "POST",
                url: "index.php",
                data: data_form,
                success: function(data){
                    container_message.show().html(data);
                    container_footer.find(".loading").hide();
                },
                error: function(){
                    container_footer.find(".loading").hide();
                }
            });
            return false;
        });

        $("input[name=icl_sample_data]").on("change", function(){
            var self = $(this);
            var container_choose_theme = $(".choose-theme");
            var container_enter_pscode = $(".enter-purchased-code");

            if (self.is(':checked')) {
                container_choose_theme.slideDown();
                container_enter_pscode.slideDown();
            } else {
                container_choose_theme.slideUp();
                container_enter_pscode.slideUp();
            }
        });
    });
</script>
</body>
