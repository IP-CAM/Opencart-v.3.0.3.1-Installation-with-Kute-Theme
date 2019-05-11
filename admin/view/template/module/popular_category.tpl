<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                </div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_category_1; ?></label>
            <div class="col-sm-10">
              <input type="text" name="" value="<?php echo $category_1st_name; ?>" data-name="category_1st" placeholder="<?php echo $entry_category_1; ?>" class="form-control select-category" />
              <input type="hidden" name="category_1st_id" value="<?php echo $category_1st_id; ?>" />
              <input type="hidden" name="category_1st_name" value="<?php echo $category_1st_name; ?>" />
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_category_2; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="" value="<?php echo $category_2nd_name; ?>" data-name="category_2nd" placeholder="<?php echo $entry_category_2; ?>" class="form-control select-category" />
                    <input type="hidden" name="category_2nd_id" value="<?php echo $category_2nd_id; ?>" />
                    <input type="hidden" name="category_2nd_name" value="<?php echo $category_2nd_name; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_category_3; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="" value="<?php echo $category_3rd_name; ?>" data-name="category_3rd" placeholder="<?php echo $entry_category_3; ?>" class="form-control select-category" />
                    <input type="hidden" name="category_3rd_id" value="<?php echo $category_3rd_id; ?>" />
                    <input type="hidden" name="category_3rd_name" value="<?php echo $category_3rd_name; ?>" />
                </div>
            </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
  // Category
  $('.select-category').autocomplete({
      'source': function(request, response) {
          var self = $(this);
          $.ajax({
              url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
              dataType: 'json',
              success: function(json) {
                  response($.map(json, function(item) {
                      return {
                          container: self,
                          label: item['name'],
                          value: item['category_id']
                      }
                  }));
              }
          });
      },
      'select': function(item) {
          var form_group = item.container.closest('div');
          var data_id = item.container.attr('data-name');
          form_group.find("input[name='"+data_id+"_id']").val(item.value);
          form_group.find("input[name='"+data_id+"_name']").val(item.label);
          item.container.val(item.label);
      }
  });
//--></script></div>
<?php echo $footer; ?>