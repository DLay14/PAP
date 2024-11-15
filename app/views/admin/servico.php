<?php 

$this->view( "_includes/admin_header", $data); 

?>

<body>

<div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start 
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
         Spinner End -->


        <!-- Sidebar Start -->
        <?php
            $this->view( "_includes/admin_sidebar", $data); 
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <?php
            $this->view( "_includes/navbar", $data);
        ?>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Serviços</h6>
                        <button type="button" class="btn btn-link m-2 " data-bs-toggle="modal" data-bs-target="#servicoModal"><i class="fa fa-plus"></i> Adicionar novo</button>
                    </div>
                    <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">Serviço</th>
                                    <th scope="col">Data Inicio</th>
                                    <th scope="col">Data Fim</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php if (!empty($data['TipoServico'])): ?> 
                                    
                                    <?php foreach ($data['TipoServico'] as $index => $servico): ?>
                                        <?php $status = $servico['status'] ? "Inativo" : "Ativo"; ?>
                                    <td><?php echo $index +1; ?></td>
                                    <td><?php echo htmlspecialchars($servico['TipoServico']); ?></td>
                                    <td> 
                                        <?php
                                         //Supondo que $product['date'] está no formato Y-m-d H:i:s
                                            $date = new DateTime($servico['DataInicio']);
                                            echo htmlspecialchars($date->format('jS M, Y'));
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                         //Supondo que $product['date'] está no formato Y-m-d H:i:s
                                            $date = new DateTime($servico['DataFim']);
                                            echo htmlspecialchars($date->format('jS M, Y'));
                                        ?>
                                    </td>
                                    <?php if ($servico['status']): ?>

                                        <td><span class="label label-warning label-mini" style="cursor:pointer"
                                        onclick="disabled_row(<?php echo $servico ['idService'];?>,<?php echo $servico['status'];?>)">Inativo</span></td>

                                    <?php else: ?>
                                    
                                        <td><span class="label label-warning label-mini" style="cursor:pointer"
                                        onclick="disabled_row(<?php echo $servico ['idService'];?>,<?php echo $servico['status'];?>)">Ativo</span></td>

                                    <?php endif; ?>
                                    <td><div class="btn-group" role="group">
                                        <button type="button" href="<?= ROOT ?>category/edit" class="btn btn-outline-primary"
                      
                                        onclick="openEditModal(<?php echo htmlspecialchars($servico['idService']);?>,
                                            '<?php echo htmlspecialchars($servico['TipoServico']); ?>',
                                            '<?php echo htmlspecialchars($servico['DataInicio']); ?>',
                                            '<?php echo htmlspecialchars($servico['DataFim']); ?>',)">Editar</button>
                                        <?php if ($servico['status'] == 1) :?>
                                        <button type="button" href="<?= ROOT ?>category/delete" class="btn btn-outline-primary"
                                            onclick="openDeleteModal(<?php echo htmlspecialchars($servico['idService']);?>)">Deletar</button>
                                        <?php else: ?>
                                            <button type="button" href="<?= ROOT ?>category/delete" class="btn btn-outline-primary"
                                            onclick="deleteError()">Deletar</button>
                                        <?php endif; ?>
                                    </div></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

            
<!-- ADD service -->
<div class="modal fade " id="servicoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo serviço</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="categoryoForm">
          <div class="mb-3">
            <label for="category-name" class="col-form-label">Tipo de Serviço:</label>
            <input  type="text" class="form-control" id="category-name" name="category">
            <label for="category-name" class="col-form-label">Data Inicio:</label>
            <input type="date" class="form-control" id="data-inicio" name="category">
            <label for="category-name" class="col-form-label">Data Fim:</label>
            <input type="date" class="form-control" id="data-fim" name="category">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="get_data()">Send message</button>
      </div>
    </div>
  </div>
</div>
<!-- END ADD service modal -->
 
<div id="deleteGroupModal" class="modal fade" tabindex="-1" aria-labelledby="deleteGroupModal-Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <form id="deleteGroup">
                <div class="modal-header">
                    <h4 class="modal-title">Apagar grupo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem a certeza que quer apagar este serviço?</p>
                    <p class="text-warning"><small>A açao é irreversivel.</small></p>
                    <input id="deleteGroupId" name="deleteGroupId" type="hidden" class="form-control" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="delete_row(document.getElementById('deleteGroupId').value)">Apagar</button>
                </div>               
            </form>
        </div>
    </div>
</div>
<div id="editGroupModal" class="modal fade" tabindex="-1" aria-labelledby="editGroupModal-Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <form id="editGroup">
                <div class="modal-header">
                    <h4 class="modal-title">Editar serviço</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        <div class="form-group">
                            <label for="category-name" class="col-form-label" >Serviço:</label>
                            <input id="editService" name="editService" type="text" class="form-control">
                            <input id="editGroupId" name="editGroupId"  hidden class="form-control" value="">
                            <label for="category-name" class="col-form-label">Data Inicio:</label>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio">
                            <label for="category-name" class="col-form-label">Data Fim:</label>
                            <input type="date" class="form-control" id="data_fim" name="data_fim">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="edit_service()">Editar</button>
                </div>               
            </form>
        </div>
    </div>
</div>
<script>

    function clickTeste()
    {
        alert("Eu sou muita bom");
    }

    function get_data() {
        let servico = document.querySelector("#category-name").value.trim();
        let datainicio = document.querySelector("#data-inicio").value.trim();
        let datafim = document.querySelector("#data-fim").value.trim();        
        if (!servico || !isNaN(servico)) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor insira todos os dados!'
            });
            return;
        }
        
        let data = {
            servico: servico,
            datainicio: datainicio,
            datafim: datafim,
            data_type: 'add_service'
        };

        send_data(data);
    }

    function send_data(data = {}){

        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function(){
            if(ajax.readyState === 4 && ajax.status === 200)
            {
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST", "<?=ROOT?>servico/servico",true);
        ajax.setRequestHeader("Content-Type", "application/json");
        ajax.send(JSON.stringify(data));
    }


    function handle_result(result) {
        console.log("The result is" + result);
        if (result !== "") {
            try {
                var obj = JSON.parse(result);
                if (obj.data_type === "add_service") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            $('#servicoModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: obj.message
                        });
                    }
                }

                if (obj.data_type === "edit_service") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            $('#editGroupModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: obj.message
                        });
                    }
                }

                if (obj.data_type === "disabled_row"){
                    location.reload();
                }

                if (obj.data_type === "delete_service") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: obj.message
                        });
                    }
                }
            } catch (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing the server response.'
                });
            }
        }
    }



    function openDeleteModal(idService){
        document.getElementById('deleteGroupId').value =idService;

        $('#deleteGroupModal').modal('show');

    }

    function delete_row(idService)
    {
        send_data(data={
            data_type:"delete_service",
            id:idService
        });
    }

    function deleteError(){
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: "Voce nao pode apagar um serviço ativo"
        });
    }

    function disabled_row(idService,state){
        
        send_data(data = {
            data_type:"disabled_row",
            idService:idService,
            current_state:state
        });
        console.log(data);
    }

    function openEditModal(idService,TipoServico,DataInicio,DataFim){
        document.getElementById('editGroupId').value =idService;
        document.getElementById('editService').value =TipoServico;
        document.getElementById('data_inicio').value =DataInicio;
        document.getElementById('data_fim').value =DataFim;
        $('#editGroupModal').modal('show');
    }

    function edit_service() {
        
        let servico_input = document.querySelector("#editService").value.trim();
        let datainicio_input = document.querySelector("#data_inicio").value.trim();
        let datafim_input = document.querySelector("#data_fim").value.trim();
        let id_input = document.querySelector("#editGroupId").value;

        // Validação básica dos campos
        if (servico_input === "" || isNaN(id_input)) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor, preencha os campos corretamente.'
            });
            return;
        }

        // Objeto com os dados a serem enviados
        let data = {
            servico: servico_input,
            datainicio: datainicio_input,
            datafim: datafim_input,
            id: id_input,
            data_type: 'edit_service' // Data_type corrigido para 'edit_service'
        };

        // Envio dos dados para o controlador PHP via função send_data
        send_data(data);
    }

</script>
<?php $this->view( "_includes/admin_footer", $data); ?>