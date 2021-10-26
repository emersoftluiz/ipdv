<?php
require_once('services/costcenter/costcenter.php');

function display_department_form($department = '', $details = '') {
	$edit = is_array($department);
    ?>
	<form method="POST" action="<?php echo $edit ? HOSTNAME.'department/update' : HOSTNAME.'department/insert'; ?>">
	<?php
	if ($edit) {
		echo '<input type="hidden" name="id" value="'. htmlspecialchars($department['id']).'" />';
	}
	?>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="name">Nome</label>
		  <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
		  <?php if($details) echo 'readonly';?> value="<?php echo htmlspecialchars($edit ? $department['name'] : ''); ?>"  required>
		</div>
		<div class="form-group col-md-6">
			<label for="costcenter_id">Centro de Custo</label>
			<select id="costcenter_id" name="costcenter_id" class="form-control" <?php if($details) echo 'disabled';?> required>
			  <option value="">Selecione...</option>
			  <?php
			  $activity_array=get_costcenters();
			  foreach ($activity_array as $thiscat) {
				   echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
				   if (($edit) && ($thiscat['id'] == $department['costcenter_id'])) {
					   echo " selected";
				   }
				   echo ">".htmlspecialchars($thiscat['name'])."</option>";
			  }
			  ?>
			</select>
		  </div>
	  </div>
	  <hr />
	  <?php
	  if($details){
		  ?><input type="button" class="btn btn-primary" onclick="location.href='<?php echo HOSTNAME;?>department/edit/<?php echo $department['id'];?>';" value="Alterar Departamento" /><?php
	  } else {
		  ?><button type="submit" class="btn btn-warning"><?php echo $edit ? 'Alterar' : 'Adicionar'; ?> Departamento</button><?php
	  }
	  if ($edit){
		  ?>
		  <input class="btn btn-danger" type="button" id="delete" value='Remover Departamento' />
		  <script type="text/javascript">
		  document.getElementById('delete').onclick = function () {
		      if (confirm('Deseja realmente Remover este Registro?')) {
		          parent.location="<?php echo HOSTNAME.'department/delete/'.$department['id']; ?>";
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

function display_departments($cat_array) {
	if (!is_array($cat_array)) {
		do_html_mensagem('Nenhum Departamento foi encontrado na base de dados.', 'warning');
        return;
    }
    ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de Departamentos</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
												<th>Centro de Custo</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
												<th>Centro de Custo</th>
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
												<td><?php echo $row['costcenter'];?></td>
                                                <td>
												<form id="form<?php echo $i;?>" method="post">
												    <input type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo HOSTNAME;?>department/details/<?php echo $row['id'];?>';" value="Detalhes" />
												    <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo HOSTNAME;?>department/edit/<?php echo $row['id'];?>';" value="Alterar" />
													<input class="btn btn-danger btn-sm" type="button" id="delete<?php echo $i;?>" value='Remover' />
													<script type="text/javascript">
													document.getElementById('delete<?php echo $i;?>').onclick = function () {
													    if (confirm('Deseja realmente Remover este Registro?')) {
													        parent.location="<?php echo HOSTNAME.'department/delete/'.$row['id']; ?>";
													    }
													};
													</script>
													<input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo HOSTNAME;?>department/users/<?php echo $row['id'];?>';" value="Usuários" />
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