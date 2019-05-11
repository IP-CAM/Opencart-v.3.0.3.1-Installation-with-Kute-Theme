<?php echo $header; ?>
<div id="columns" class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>

  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> page-content"><?php echo $content_top; ?>
    <h2 class="page-heading"><span class="page-heading-title"><?php echo $heading_title; ?></span></h2>
      <div class="row login">
        <div class="col-sm-6">
          <div class="box-authentication">
            <h3><?php echo $text_new_customer; ?></h3>
            <p><?php echo $text_register_account; ?></p>
            <a href="<?php echo $register; ?>" class="btn button"><i class="fa fa-user"></i> Create an account</a>
          </div> 
        </div>
        <div class="col-sm-6">
          <div class="box-authentication">
            <h3><?php echo $text_returning_customer; ?></h3>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div>
                <label for="input-email"><?php echo $entry_email; ?></label>
                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
              </div>
              <div>
                <label for="input-password"><?php echo $entry_password; ?></label>
                <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                <p class="forgot-pass"><a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a></p>
              </div>
              
              <button type="submit" class="button"><i class="fa fa-lock"></i> <?php echo $button_login; ?></button>
              <?php if ($redirect) { ?>
              <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
              <?php } ?>
            </form>
          </div>
        </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>