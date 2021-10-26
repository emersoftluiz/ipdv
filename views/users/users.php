<?php
require_once('services/position/position.php');
require_once('services/department/department.php');
require_once('services/costcenter/costcenter.php');
require_once('services/factory.php');

function display_users_form($users = '', $details = '') {
	?>
    <script type="text/javascript" src="<?php echo HOSTNAME;?>js/jquery-1.12.0.js"></script>
	<script src="<?php echo HOSTNAME;?>js/cleave.min.js"></script>
	
    <script type="text/javascript">
	$(document).ready(function(){
		$("select[name=estado]").change(function(){
			$("select[name=cidade]").html('<option value="">Carregando...</option>');
            $.post("<?php echo HOSTNAME;?>services/ajax-city.php",
                    {estado:$(this).val()},
				    function(valor){
						$("select[name=cidade]").html(valor);
					}
                  )
         })
		 
		 $("select[name=costcenter_id]").change(function(){
			$("select[name=department_id]").html('<option value="">Carregando...</option>');
            $.post("<?php echo HOSTNAME;?>services/ajax-department.php",
                    {costcenter_id:$(this).val()},
				    function(valor){
						$("select[name=department_id]").html(valor);
					}
                  )
         })
	})
    </script>
    <?php
	$edit = is_array($users);
    ?>
	<form method="POST" action="<?php echo $edit ? HOSTNAME.'users/update' : HOSTNAME.'users/insert'; ?>">
	<?php
	if ($edit) {
		echo '<input type="hidden" name="id" value="'. htmlspecialchars($users['id']).'" />';
	}
	?>
	  <h5>Dados de Acesso</h5>
	  <hr />
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="name">Nome</label>
		  <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : ($edit ? $users['name'] : '')); ?>" required>
		</div>
		<div class="form-group col-md-6">
		  <label for="email">Email</label>
		  <input type="email" class="form-control" id="email" name="email" placeholder="Email"
		  <?php if($details||$edit) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ($edit ? $users['email'] : '')); ?>" required>
		</div>
	  </div>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="passwd">Senha</label>
		  <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Senha"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['passwd']) ? $_POST['passwd'] : ''); ?>" <?php echo $edit ? '' : 'required';?>>
		</div>
		<div class="form-group col-md-6">
		  <label for="passwd2">Repetir Senha</label>
		  <input type="password" class="form-control" id="passwd2" name="passwd2" placeholder="Repetir Senha"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['passwd2']) ? $_POST['passwd2'] : ''); ?>" <?php echo $edit ? '' : 'required';?>>
		</div>
	  </div>
	  <div class="form-row">
		  <div class="form-group col-md-4">
			<label for="costcenter_id">Centro de Custo</label>			
			<select id="costcenter_id" name="costcenter_id" class="form-control" <?php if($details) echo 'disabled';?> required>
		    <option value="">Selecione o Centro de Custo...</option>
			<?php
		    $estado_array=get_costcenters();
            foreach ($estado_array as $thiscat) {
                 echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
			     
				 if ((isset($_POST['costcenter_id'])) && ($thiscat['id'] == $_POST['costcenter_id'])) {
                     echo " selected";
                 } else if (($edit) && ($thiscat['id'] == $users['costcenter_id'])) {
                     echo " selected";
                 }
                 echo ">".htmlspecialchars($thiscat['name'])."</option>";
            }
		    ?>
			</select>
		  </div>
		  <div class="form-group col-md-4">
			<label for="department_id">Departamento</label>
			
			<select id="department_id" name="department_id" class="form-control" <?php if($details) echo 'disabled';?> required>
			<?php
			if (isset($_POST['costcenter_id'])) {
				
				$state_array=get_departments();
				foreach ($state_array as $thiscat) {
					 echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
					 if ((isset($_POST['costcenter_id'])) && ($thiscat['id'] == $_POST['department_id'])) {
						 echo " selected";
					 }
					 echo ">".htmlspecialchars($thiscat['name'])."</option>";
				}
			
			} else if ($edit) {
				
				$state_array=get_departments();
				foreach ($state_array as $thiscat) {
					 echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
					 if (($edit) && ($thiscat['id'] == $users['department_id'])) {
						 echo " selected";
					 }
					 echo ">".htmlspecialchars($thiscat['name'])."</option>";
				}
			
			} else {
				?>
                <option value="0" selected="selected">Aguardando Centro de Custo....</option>
                <?php
			}
		    ?>
			</select>
		  </div>
		  <div class="form-group col-md-4">
			<label for="position_id">Cargo</label>
			<select id="position_id" name="position_id" class="form-control" <?php if($details) echo 'disabled';?> required>
			  <option value="">Selecione...</option>
			  <?php
			  $activity_array=get_positions();
			  foreach ($activity_array as $thiscat) {
				   echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
				   if (($edit) && ($thiscat['id'] == $users['position_id'])) {
					   echo " selected";
				   }
				   echo ">".htmlspecialchars($thiscat['name'])."</option>";
			  }
			  ?>
			</select>
		  </div>
	  </div>
	  <hr />
	  <h5>Endereço Cadastral:</h5>
	  <hr />
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="endereco">Endereço</label>
		  <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Ex: Rua Barros Júnior, 1234"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['endereco']) ? $_POST['endereco'] : ($edit ? $users['endereco'] : '')); ?>" required>
		</div>
		<div class="form-group col-md-6">
		  <label for="complemento">Complemento</label>
		  <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['complemento']) ? $_POST['complemento'] : ($edit ? $users['complemento'] : '')); ?>">
		</div>
	  </div>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="bairro">Bairro</label>
		  <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['bairro']) ? $_POST['bairro'] : ($edit ? $users['bairro'] : '')); ?>" required>
		</div>
		<div class="form-group col-md-6">
		  <label for="cep">CEP</label>
		  <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['cep']) ? $_POST['cep'] : ($edit ? $users['cep'] : '')); ?>" required>
		</div>
		<script type="text/javascript">
			new Cleave('#cep', {
				blocks: [2, 3, 3],
				delimiters: ['.', '-'],
				numericOnly: true
			});
        </script>
	  </div>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="estado">Estado</label>
		  <select id="estado" name="estado" class="form-control" <?php if($details) echo 'disabled';?> required>
		    <option value="">Selecione o Estado...</option>
			<?php
		    $estado_array=get_states();
            foreach ($estado_array as $thiscat) {
                 echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
			     
				 if ((isset($_POST['estado'])) && ($thiscat['id'] == $_POST['estado'])) {
                     echo " selected";
                 } else if (($edit) && ($thiscat['id'] == $users['estado'])) {
                     echo " selected";
                 }
                 echo ">".htmlspecialchars($thiscat['nome'])."</option>";
            }
		    ?>
		  </select>
		</div>
		<div class="form-group col-md-6">		  
		  <label for="cidade">Cidade</label>
		  <select id="cidade" name="cidade" class="form-control" <?php if($details) echo 'disabled';?> required>
			<?php
			if (isset($_POST['estado'])) {
				
				$state_array=get_cities();
				foreach ($state_array as $thiscat) {
					 echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
					 if ((isset($_POST['estado'])) && ($thiscat['id'] == $_POST['cidade'])) {
						 echo " selected";
					 }
					 echo ">".htmlspecialchars($thiscat['nome'])."</option>";
				}
			
			} else if ($edit) {
				
				$state_array=get_cities();
				foreach ($state_array as $thiscat) {
					 echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
					 if (($edit) && ($thiscat['id'] == $users['cidade'])) {
						 echo " selected";
					 }
					 echo ">".htmlspecialchars($thiscat['nome'])."</option>";
				}
			
			} else {
				?>
                <option value="0" selected="selected">Aguardando Estado....</option>
                <?php
			}
		    ?>
		  </select>
		</div>
	  </div>
	  <hr />
	  <h5>Dados Complementares:</h5>
	  <hr />
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="telefone">Telefone</label>
		  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['telefone']) ? $_POST['telefone'] : ($edit ? $users['telefone'] : '')); ?>">
		</div>
		<script type="text/javascript">
			new Cleave('#telefone', {
				blocks: [2, 4, 4],
				delimiters: ['-', '-'],
				numericOnly: true
			});
        </script>
		<div class="form-group col-md-6">
		  <label for="telefone2">Telefone2</label>
		  <input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="Telefone2"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['telefone2']) ? $_POST['telefone2'] : ($edit ? $users['telefone2'] : '')); ?>">
		</div>
		<script type="text/javascript">
			new Cleave('#telefone2', {
				blocks: [2, 4, 4],
				delimiters: ['-', '-'],
				numericOnly: true
			});
        </script>
	  </div>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="celular">Celular</label>
		  <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['celular']) ? $_POST['celular'] : ($edit ? $users['celular'] : '')); ?>" required>
		</div>
		<script type="text/javascript">
			new Cleave('#celular', {
				blocks: [2, 5, 4],
				delimiters: ['-', '-'],
				numericOnly: true
			});
        </script>
		<div class="form-group col-md-6">
		  <label for="celular2">Celular2</label>
		  <input type="text" class="form-control" id="celular2" name="celular2" placeholder="Celular2"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['celular2']) ? $_POST['celular2'] : ($edit ? $users['celular2'] : '')); ?>">
		</div>
		<script type="text/javascript">
			new Cleave('#celular2', {
				blocks: [2, 5, 4],
				delimiters: ['-', '-'],
				numericOnly: true
			});
        </script>
	  </div>
	  <div class="form-row">
		<div class="form-group col-md-12">
		  <label for="informacoes_adicionais">Informações adicionais</label>
		  <textarea <?php if($details) echo 'disabled';?> class="form-control" id="informacoes_adicionais" name="informacoes_adicionais" rows="3" placeholder="Informações adicionais"><?php echo htmlspecialchars(isset($_POST['informacoes_adicionais']) ? $_POST['informacoes_adicionais'] : ($edit ? $users['informacoes_adicionais'] : '')); ?></textarea>
		</div>
	  </div>
	  <hr />
	  <?php
	  if($details){
		  ?><input type="button" class="btn btn-primary" onclick="location.href='<?php echo HOSTNAME;?>users/edit/<?php echo $users['id'];?>';" value="Alterar Usuário" /><?php
	  } else {
		  ?><button type="submit" class="btn btn-warning"><?php echo $edit ? 'Alterar' : 'Adicionar'; ?> Usuário</button><?php
	  }
	  if ($edit){
		  ?>
		  <input class="btn btn-danger" type="button" id="delete" value='Remover Usuário' />
		  <script type="text/javascript">
		  document.getElementById('delete').onclick = function () {
		      if (confirm('Deseja realmente Remover este Registro?')) {
		          parent.location="<?php echo HOSTNAME.'users/delete/'.$users['id']; ?>";
		      }
		  };
		  </script>
		  <?php
	  }	  
	  ?>
	</form>
	<hr />
	  <h5>Importar usuários de planilha:</h5>
	<hr />
	<form method="POST" action="<?php echo HOSTNAME.'users/insertplanilha'; ?>" enctype="multipart/form-data">
	  <div class="form-row">
		<div class="form-group col-md-12">
		  <label for="arquivo">Faça o upload do arquivo .xlsx</label>
		  <input type="file" class="form-control" id="arquivo" name="arquivo" required />
		</div>
	  </div>
	  <hr />
	  <button type="submit" class="btn btn-warning"><?php echo 'Importar'; ?> planilha</button>
	</form>
	<hr />
<?php
}

function display_users($cat_array) {
	if (!is_array($cat_array)) {
		do_html_mensagem('Nenhum Usuário foi encontrado na base de dados.', 'warning');
        return;
    }
    ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de Usuários</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
												<th>Email</th>
												<th>Departamento</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
												<th>Email</th>
												<th>Departamento</th>
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
												<td><?php echo $row['email'];?></td>
												<td><?php echo $row['departamento'];?></td>
                                                <td>
												<form id="form<?php echo $i;?>" method="post">
												    <input type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo HOSTNAME;?>users/details/<?php echo $row['id'];?>';" value="Detalhes" />
												    <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo HOSTNAME;?>users/edit/<?php echo $row['id'];?>';" value="Alterar" />
													<input class="btn btn-danger btn-sm" type="button" id="delete<?php echo $i;?>" value='Remover' />
													<script type="text/javascript">
													document.getElementById('delete<?php echo $i;?>').onclick = function () {
													    if (confirm('Deseja realmente Remover este Registro?')) {
													        parent.location="<?php echo HOSTNAME.'users/delete/'.$row['id']; ?>";
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
