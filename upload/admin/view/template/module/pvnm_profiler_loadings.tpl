<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $loadings; ?>" data-toggle="tooltip" title="<?php echo $button_loadings; ?>" class="btn btn-default active"><i class="fa fa-tasks"></i></a>
				<a href="<?php echo $settings; ?>" data-toggle="tooltip" title="<?php echo $button_settings; ?>" class="btn btn-default" style="margin-right: 30px;"><i class="fa fa-cogs"></i></a>
				<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
		<?php if ($success) { ?>
		<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-tasks"></i> <?php echo $text_list; ?></h3>
			</div>
			<div class="panel-body">
				<div class="well">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-url"><?php echo $entry_url; ?></label>
								<input type="text" name="filter_url" value="<?php echo $filter_url; ?>" placeholder="<?php echo $entry_url; ?>" id="input-url" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-time"><?php echo $entry_time; ?></label>
								<input type="text" name="filter_time" value="<?php echo $filter_time; ?>" placeholder="<?php echo $entry_time; ?>" id="input-time" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-date"><?php echo $entry_date; ?></label>
								<div class="input-group date">
									<input type="text" name="filter_date" value="<?php echo $filter_date; ?>" placeholder="<?php echo $entry_date; ?>" data-date-format="YYYY-MM-DD" id="input-date" class="form-control" />
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
							<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
						</div>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
									<td class="text-left"><?php if ($sort == 'l.url') { ?>
										<a href="<?php echo $sort_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_url; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_url; ?>"><?php echo $column_url; ?></a>
										<?php } ?>
									</td>
									<td class="text-center"><?php if ($sort == 'l.time') { ?>
										<a href="<?php echo $sort_time; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_time; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_time; ?>"><?php echo $column_time; ?></a>
										<?php } ?>
									</td>
									<td class="text-center"><?php if ($sort == 'query') { ?>
										<a href="<?php echo $sort_query; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_query; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_query; ?>"><?php echo $column_query; ?></a>
										<?php } ?>
									</td>
									<td class="text-center"><?php if ($sort == 'slow') { ?>
										<a href="<?php echo $sort_slow; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_slow; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_slow; ?>"><?php echo $column_slow; ?></a>
										<?php } ?>
									</td>
									<td class="text-right"><?php if ($sort == 'l.date') { ?>
										<a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
										<?php } else { ?>
										<a href="<?php echo $sort_date; ?>"><?php echo $column_date; ?></a>
										<?php } ?>
									</td>
								</tr>
							</thead>
							<tbody>
								<?php if ($pvnm_loadings) { ?>
								<?php foreach ($pvnm_loadings as $loading) { ?>
								<tr class="<?php if ($loading['time'] >= $slow_page) { ?>danger<?php } ?>">
									<td class="text-center">
										<?php if (in_array($loading['loading_id'], $selected)) { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $loading['loading_id']; ?>" checked="checked" />
										<?php } else { ?>
										<input type="checkbox" name="selected[]" value="<?php echo $loading['loading_id']; ?>" />
										<?php } ?>
									</td>
									<td class="text-left"><a href="<?php echo $loading['url']; ?>" target="_blank"><?php echo $loading['url']; ?></a></td>
									<td class="text-center"><?php echo $loading['time']; ?> <?php echo $text_seconds; ?></td>
									<td class="text-center"><a class="btn btn-default btn-xs" onclick="getQueries('<?php echo $loading['loading_id']; ?>');"><?php echo $loading['query']; ?></a></td>
									<td class="text-center"><span class="label label-<?php if ($loading['slow'] > 0) { ?>danger<?php } else { ?>success<?php } ?>"><?php echo $loading['slow']; ?></span></td>
									<td class="text-right"><?php echo $loading['date']; ?></td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</form>
				<div class="row">
					<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
					<div class="col-sm-6 text-right"><?php echo $results; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=module/pvnm_profiler/loadings&token=<?php echo $token; ?>';

	var filter_url = $('input[name=\'filter_url\']').val();

	if (filter_url) {
		url += '&filter_url=' + encodeURIComponent(filter_url);
	}

	var filter_time = $('input[name=\'filter_time\']').val();

	if (filter_time) {
		url += '&filter_time=' + encodeURIComponent(filter_time);
	}

	var filter_date = $('input[name=\'filter_date\']').val();

	if (filter_date) {
		url += '&filter_date=' + encodeURIComponent(filter_date);
	}

	location = url;
});
//--></script>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<script type="text/javascript"><!--
function getQueries(loading_id) {
	$('#modal-query').remove();

	$.ajax({
		url: 'index.php?route=module/pvnm_profiler/getQueries&token=<?php echo $token; ?>',
		type: 'post',
		data: 'loading_id=' + loading_id,
		dataType: 'json',
		success: function(json) {
			if (json['success']) {
				html  = '<div id="modal-query" class="modal">';
				html += '  <div class="modal-dialog modal-lg">';
				html += '    <div class="modal-content">';
				html += '      <div class="modal-header">';
				html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
				html += '        <h4 class="modal-title">' + json['title'] + '</h4>';
				html += '      </div>';
				html += '      <div class="modal-body">' + json['queries'] + '</div>';
				html += '    </div';
				html += '  </div>';
				html += '</div>';

				$('body').append(html);

				$('#modal-query').modal('show');
			}

			if (json['error']) {
				html  = '<div id="modal-query" class="modal">';
				html += '  <div class="modal-dialog modal-lg">';
				html += '    <div class="modal-content">';
				html += '      <div class="modal-header">';
				html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
				html += '        <h4 class="modal-title">' + json['title'] + '</h4>';
				html += '      </div>';
				html += '      <div class="modal-body">' + json['error'] + '</div>';
				html += '    </div';
				html += '  </div>';
				html += '</div>';

				$('body').append(html);

				$('#modal-query').modal('show');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
//--></script>
<?php echo $footer; ?>