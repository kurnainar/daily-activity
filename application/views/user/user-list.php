<div id="content">
	<table id="data-list" class="table table-bordered table-striped" style="width:100%;">
		<thead>
			<tr>
				<th>No.</th>
				<th>ID Pengguna</th>
				<th>Nama Lengkap</th>
				<th>Nama Departemen</th>
				<th>Status Aktifitas</th>
				<th>Status Pengguna</th>
				<th>Hak Akses Pengguna</th>
				<th>Tanggal Akhir Masuk</th>
				<th>Tanggal Akhir Keluar</th>
			</tr>
		</thead>
		<tbody id="show_data">
			
		</tbody>
	</table>
	<div id="ModalUser"></div>
</div>
<?php $this -> load -> view('user/user-js'); ?>