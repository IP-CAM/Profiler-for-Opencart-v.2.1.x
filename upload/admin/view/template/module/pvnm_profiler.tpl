<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $loadings; ?>" data-toggle="tooltip" title="<?php echo $button_loadings; ?>" class="btn btn-default"><i class="fa fa-tasks"></i></a>
				<a href="<?php echo $settings; ?>" data-toggle="tooltip" title="<?php echo $button_settings; ?>" class="btn btn-default active"><i class="fa fa-cogs"></i></a>
				<button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
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
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-settings" data-toggle="tab"><?php echo $tab_settings; ?></a></li>
						<li><a href="#tab-email" data-toggle="tab"><?php echo $tab_email; ?></a></li>
						<li><a href="#tab-help" data-toggle="tab"><?php echo $tab_help; ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab-settings">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm_profiler_status"><?php echo $entry_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_profiler_status == 1) { ?>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_status" value="2" autocomplete="off"><?php echo $text_catalog; ?></label>
										<?php } elseif ($pvnm_profiler_status == 2) { ?>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_status" value="2" autocomplete="off" checked="checked"><?php echo $text_catalog; ?></label>
										<?php } else { ?>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_status" value="2" autocomplete="off"><?php echo $text_catalog; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm_profiler_body_status"><?php echo $entry_body_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_profiler_body_status) { ?>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_body_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_body_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
										<?php } else { ?>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_body_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_body_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm_profiler_console_status"><?php echo $entry_console_status; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_profiler_console_status) { ?>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_console_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_console_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
										<?php } else { ?>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_console_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_console_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm_profiler_query_time"><?php echo $entry_query_time; ?></label>
								<div class="col-sm-10">
									<input type="text" name="pvnm_profiler_query_time" value="<?php echo $pvnm_profiler_query_time; ?>" id="input-pvnm_profiler_query_time" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm_profiler_page_time"><?php echo $entry_page_time; ?></label>
								<div class="col-sm-10">
									<input type="text" name="pvnm_profiler_page_time" value="<?php echo $pvnm_profiler_page_time; ?>" id="input-pvnm_profiler_page_time" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm_profiler_page_write"><?php echo $entry_page_write; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_profiler_page_write == 1) { ?>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_write" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_page_write" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_write" value="2" autocomplete="off"><?php echo $text_slow; ?></label>
										<?php } elseif ($pvnm_profiler_page_write == 2) { ?>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_write" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_write" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_page_write" value="2" autocomplete="off" checked="checked"><?php echo $text_slow; ?></label>
										<?php } else { ?>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_page_write" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_write" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_write" value="2" autocomplete="off"><?php echo $text_slow; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-email">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-pvnm_profiler_page_email"><?php echo $entry_page_email; ?></label>
								<div class="col-sm-10">
									<div class="btn-group" data-toggle="buttons">
										<?php if ($pvnm_profiler_page_email) { ?>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_email" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_page_email" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
										<?php } else { ?>
										<label class="btn btn-info active"><input type="radio" name="pvnm_profiler_page_email" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
										<label class="btn btn-info"><input type="radio" name="pvnm_profiler_page_email" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_macros; ?></label>
								<div class="col-sm-10">
									<div class="panel panel-default">
									<table class="table">
										<tr>
											<td>{url}</td>
											<td><?php echo $text_email_url; ?></td>
										</tr>
										<tr>
											<td>{date}</td>
											<td><?php echo $text_email_date; ?></td>
										</tr>
										<tr>
											<td>{time}</td>
											<td><?php echo $text_email_time; ?></td>
										</tr>
										<tr>
											<td>{queries}</td>
											<td><?php echo $text_email_queries; ?></td>
										</tr>
									</table>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs" id="language-email">
								<?php foreach ($languages as $language) { ?>
								<li><a href="#language-email<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language-email<?php echo $language['language_id']; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm_profiler_email_subject<?php echo $language['code']; ?>"><?php echo $entry_subject; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pvnm_profiler_email_subject[<?php echo $language['code']; ?>]" value="<?php echo isset($pvnm_profiler_email_subject[$language['code']]) ? $pvnm_profiler_email_subject[$language['code']] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-pvnm_profiler_email_subject<?php echo $language['code']; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pvnm_profiler_email_message<?php echo $language['code']; ?>"><?php echo $entry_message; ?></label>
										<div class="col-sm-10">
											<textarea name="pvnm_profiler_email_message[<?php echo $language['code']; ?>]" placeholder="<?php echo $entry_message; ?>" id="input-pvnm_profiler_email_message<?php echo $language['code']; ?>" class="form-control"><?php echo isset($pvnm_profiler_email_message[$language['code']]) ? $pvnm_profiler_email_message[$language['code']] : ''; ?></textarea>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="tab-pane" id="tab-help">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $text_documentation; ?></label>
								<div class="col-sm-10"><a href="https://github.com/p0v1n0m/opencart_profiler" target="_blank" class="btn">https://github.com/p0v1n0m/opencart_profiler</a></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $text_developer; ?></label>
								<div class="col-sm-10"><a href="mailto:p0v1n0m@gmail.com" class="btn btn-link">p0v1n0m@gmail.com</a></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
	$('#input-pvnm_profiler_email_message<?php echo $language['code']; ?>').summernote({
		height: 100
	});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
	$('#language-email a:first').tab('show');
//--></script>
<?php echo $footer; ?>