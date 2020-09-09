<tr>
  <td><input type="checkbox" name="checklist" value="<?= $row->id; ?>"></td>
  <td><?= $row->count ?></td>
  <td style="min-width: 300px"> <?= $row->string . '' . $row->name; ?> </td>
  <td style="max-width: 150px; overflow: hidden;"><a href="<?= $row->link; ?>" ><?= $row->link ?></a></td>
  <td><a href="<?= $row->link_active; ?>" data-action="isMenu" rel="1" class="btn-status glyphicon <?= $row->icon_menu; ?>"></a></td>
  <td><a href="<?= $row->link_active; ?>" data-action="active" rel="1" class="btn-status glyphicon <?= $row->icon_active; ?>"></a></td>
  <td class="text-center"><a href="<?= $row->link_update; ?>" class="btn-action glyphicon glyphicon-pencil"> </a><a href="<?= $row->link_delete; ?>" class="btn-action glyphicon glyphicon-trash"></a>
  </td>
</tr>
   