<tr>
	<td><input type="checkbox" name="checklist"  value="<?= $row->id; ?>"></td>
	<td><?= $row->count; ?></td>
	<td> <?= $row->string . ' ' . $row->name ?>
		<p style="margin-top: 10px; padding-left:20px; font-size: 13px;">Link:
		<a target="_bank" href="<?= $row->link ?>"> <?= $row->link ?></a>
		</p>
	</td>
	<td> <?= $row->module_name ?></td>
	<td>
		<a href="<?= $row->link_active ?>" data-action="isHome" rel="<?= $row->isHome ?>" class="btn-status glyphicon <?= $row->icon_home ?>"></a>
	</td>
	<td>
		<a href="<?= $row->link_active ?>" data-action="isHighlight" rel="<?= $row->isHighlight ?>" class="btn-status glyphicon <?= $row->icon_highlight ?>"></a>
	</td>
	<td>
		<a href="<?= $row->link_active ?>" data-action="active" rel="1" class="btn-status glyphicon <?= $row->icon_active ?>"></a>
	</td>
	<td class="text-center">
		<a href="<?= $row->link_update ?>" class="btn-action glyphicon glyphicon-pencil"></a>
		<a href="<?= $row->link_delete ?>" class="btn-action glyphicon glyphicon-trash"></a>
	</td>
</tr>