<table id="data-list" class="table table-bordered table-striped" style="width:100%;">
	<thead>
		<tr>
			<th>No.</th>
			<th>Grup Menu</th>
			<th>Sub Menu</th>
			<th>Hak Akses Menu</th>
			<th>Dibagikan Oleh</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			if(is_array($List)) {
				foreach($List as $data => $rows) {
		?>
		<tr id="assignmenulist" class="assignmenulist" data-id="<?php echo $rows['AssignMenuId']; ?>" style="cursor: pointer;">
			<td class="tengah"><?php echo $no; ?></td>
			<td class="kiri"><?php echo $rows['GroupMenuName']; ?></td>
			<td class="kiri"><?php echo $rows['SubMenuName']; ?></td>
			<td class="kiri"><?php echo $rows['UserGroupName']; ?></td>
			<td class="kiri"><?php echo $rows['UserFullName']; ?></td>
		</tr>
		<?php
					$no++;
				}
			}
		?>
	</tbody>
</table>
<div id="ModalAssign"></div>
<?php $this -> load -> view('assignmenu/assignmenu-js'); ?>