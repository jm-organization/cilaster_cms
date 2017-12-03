<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 20.08.2017
 * @Time: 18:33
 */

require_once __DIR__ . '\..\vendor\cilaster\MVC\Application\ApplicationView.php';

use Cilaster\MVC\Application\ApplicationView;

$view = new ApplicationView();
?>

<div class="alert alert-success install-alert" role="alert" >
	<h4 class="alert-heading status"></h4>
	<p class="message"></p>
	<hr>
	<p class="mb-0">
		<a class="btn btn-outline-success btn-sm" data-href="<?=$view->url( '/install.php', [
			'product' => $product,
			'step' => $query_step+1,
		])?>" id="save-next" style="cursor: pointer" role="button">Сохранить и продолжить</a>
	</p>
</div>

<div class="alert alert-warning install-alert alert-dismissible fade show" role="alert" >
	<button type="button" class="close" aria-label="Close" onclick="$('.alert').animate({ top: '-155px' }, 500)">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="alert-heading status"></h4>
	<p class="message"></p>
</div>

<div class="card">
	<div class="card-body">
		<h4 class="card-title"><?=$view->getTitle()?></h4>
		<h6 class="card-subtitle mb-2 text-muted"><?=$step?></h6>
		<div class="card-text">
			<p><?=$description?></p>

			<?php ($form)?$view->insert($form,'.html'):null; ?>
			<?php ($form_php)?$view->insert($form_php,'.php'):null; ?>

			<?php if ($is_main) { ?>
			<form role="form" method="get" action="<?=$view->url( '/install.php')?>">
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="select-product" style="line-height: 40px">Продукт:</label>
						<select class="custom-select" name="product" id="select-product" style="float: right; height: 40px">
							<option selected>Выбирите тип продукта</option>
							<option value="module">Модуль</option>
						</select>
					</div>

					<div class="form-group col-md-4">
						<label class="custom-file">
							<input type="file" id="file2" class="custom-file-input" accept="application/json">
							<span class="custom-file-control" data-file="Выбирите файл..."></span>
						</label>
					</div>

					<div class="form-group col-md-3">
						<button type="submit" class="btn btn-primary btn-block">Установить</button>
					</div>
				</div>
			</form>
			<?php } ?>

			<?php if ($table) { ?>
			<table class="table table-sm">
				<thead class="thead-default">
				<tr>
					<th>#</th>
					<th>Требование</th>
					<th class="text-right">Статус</th>
					<th>Значение</th>
				</tr>
				</thead>
				<tbody id="server-validation-result">
				<?php $iteration_id = 0;
				foreach ($table as $key => $value) {
					$iteration_id++?>
				<tr class="<?php if ($value || $value == 1){?>active<?php } else {?>disabled<?php } ?>">
					<th scope="row"><?=$iteration_id?></th>
					<td class="border border-right-0 border-bottom-0"><?=$key?></td>
					<td class="border border-left-0 border-bottom-0 text-right">
						<?=($value || $value == 1)?'<b class="text-success">Да</b>':'<b class="text-danger">Нет</b>'?>
					</td>
					<td><?=($value != 1)?$value:null?></td>
				</tr>
				<?php } ?>
				</tbody>
			</table>

			<p style="margin-top: 15px; margin-bottom: 0;">
				<button type="button" class="btn btn-outline-secondary"  onclick="document.location.reload()">Обновить</button>
				<a href="#" onclick="return false" data-href="<?=$view->url( '/install.php', [
					'product' => $product,
					'step' => $query_step+1,
				])?>" id="next-button" class="btn btn-primary disabled" role="button" style="float: right;">Продолжить</a>
			</p>

			<script type="application/javascript">
				$(document).ready(function () {
					var element_sum = $('#server-validation-result > tr.disabled').length;

					if (element_sum > 0) {
						$('#next-button').addClass('disabled');
					} else {
						$('#next-button').removeClass('disabled');
					}

					$('#next-button').click(function () {
						$.cookie("step2", 'true', { path: '/install.php', expires: 2});

						var href = $(this).data('href');

						document.location.href = href;
					});
				});
			</script>
			<?php } ?>

		</div>
	</div>
</div>

<script type="application/javascript">
	$(document).ready(function () {
		$('input[type=file]').on('change', function(){
			var filename = $(this).val().split('\\');
			filename = filename[filename.length - 1];

			$('.custom-file-control').attr('data-file', filename);
		});
	});
</script>
