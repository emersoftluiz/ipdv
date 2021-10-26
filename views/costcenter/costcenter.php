<?php
function display_costcenter_form($costcenter = '', $details = '') {
	$edit = is_array($costcenter);
    ?>
	<form method="POST" action="<?php echo $edit ? HOSTNAME.'costcenter/update' : HOSTNAME.'costcenter/insert'; ?>">
	<?php
	if ($edit) {
		echo '<input type="hidden" name="id" value="'. htmlspecialchars($costcenter['id']).'" />';
	}
	?>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="name">Nome</label>
		  <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
		  <?php if($details) echo 'readonly';?> value="<?php echo htmlspecialchars($edit ? $costcenter['name'] : ''); ?>"  required>
		</div>
	  </div>
	  <?php
	  if($details){
		  ?><input type="button" class="btn btn-primary" onclick="location.href='<?php echo HOSTNAME;?>costcenter/edit/<?php echo $costcenter['id'];?>';" value="Alterar Centro de Custo" /><?php
	  } else {
		  ?><button type="submit" class="btn btn-warning"><?php echo $edit ? 'Alterar' : 'Adicionar'; ?> Centro de Custo</button><?php
	  }
	  if ($edit){
		  ?>
		  <input class="btn btn-danger" type="button" id="delete" value='Remover Centro de Custo' />
		  <script type="text/javascript">
		  document.getElementById('delete').onclick = function () {
		      if (confirm('Deseja realmente Remover este Registro?')) {
		          parent.location="<?php echo HOSTNAME.'costcenter/delete/'.$costcenter['id']; ?>";
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

function display_costcenters($cat_array) {
	if (!is_array($cat_array)) {
		do_html_mensagem('Nenhum Centro de Custo foi encontrada na base de dados.', 'warning');
        return;
    }
    ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de Centro de Custos</div>
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
												    <input type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo HOSTNAME;?>costcenter/details/<?php echo $row['id'];?>';" value="Detalhes" />
												    <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo HOSTNAME;?>costcenter/edit/<?php echo $row['id'];?>';" value="Alterar" />
													<input class="btn btn-danger btn-sm" type="button" id="delete<?php echo $i;?>" value='Remover' />
													<script type="text/javascript">
													document.getElementById('delete<?php echo $i;?>').onclick = function () {
													    if (confirm('Deseja realmente Remover este Registro?')) {
													        parent.location="<?php echo HOSTNAME.'costcenter/delete/'.$row['id']; ?>";
													    }
													};
													</script>
													<input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo HOSTNAME;?>costcenter/departments/<?php echo $row['id'];?>';" value="Departamentos" />
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
