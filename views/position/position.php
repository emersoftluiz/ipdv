<?php
function display_position_form($position = '', $details = '') {
	$edit = is_array($position);
    ?>
	<form method="POST" action="<?php echo $edit ? HOSTNAME.'position/update' : HOSTNAME.'position/insert'; ?>">
	<?php
	if ($edit) {
		echo '<input type="hidden" name="id" value="'. htmlspecialchars($position['id']).'" />';
	}
	?>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="name">Nome</label>
		  <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
		  <?php if($details) echo 'readonly';?> value="<?php echo htmlspecialchars($edit ? $position['name'] : ''); ?>"  required>
		</div>
	  </div>
	  <?php
	  if($details){
		  ?><input type="button" class="btn btn-primary" onclick="location.href='<?php echo HOSTNAME;?>position/edit/<?php echo $position['id'];?>';" value="Alterar Cargo" /><?php
	  } else {
		  ?><button type="submit" class="btn btn-warning"><?php echo $edit ? 'Alterar' : 'Adicionar'; ?> Cargo</button><?php
	  }
	  if ($edit){
		  ?>
		  <input class="btn btn-danger" type="button" id="delete" value='Remover Cargo' />
		  <script type="text/javascript">
		  document.getElementById('delete').onclick = function () {
		      if (confirm('Deseja realmente Remover este Registro?')) {
		          parent.location="<?php echo HOSTNAME.'position/delete/'.$position['id']; ?>";
		      }
		  };
		  </script>
		  <?php
	  }	  
	  ?>
	</form>
	<hr />
<?php
}

function display_positions($cat_array) {
	if (!is_array($cat_array)) {
		do_html_mensagem('Nenhum Cargo foi encontrada na base de dados.', 'warning');
        return;
    }
    ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de Cargos</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Menu</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
										$i = 0;
                                        foreach ($cat_array as $row) {
											$i = $i + 1;
		                                    ?>
                                            <tr>
                                                <td><?php echo $row['id'];?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td>
												<form id="form<?php echo $i;?>" method="post">
												    <input type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo HOSTNAME;?>position/details/<?php echo $row['id'];?>';" value="Detalhes" />
												    <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo HOSTNAME;?>position/edit/<?php echo $row['id'];?>';" value="Alterar" />
													<input class="btn btn-danger btn-sm" type="button" id="delete<?php echo $i;?>" value='Remover' />
													<script type="text/javascript">
													document.getElementById('delete<?php echo $i;?>').onclick = function () {
													    if (confirm('Deseja realmente Remover este Registro?')) {
													        parent.location="<?php echo HOSTNAME.'position/delete/'.$row['id']; ?>";
													    }
													};
													</script>
												</form>
                                                </td>
                                            </tr>
		                                    <?php
	                                    }
	                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
	                    <?php
}
?>
