<?php 

$this->view( "_includes/admin_header", $data); 

?>

<body>

<div class="container-fluid position-relative d-flex p-0">

        <!-- Sidebar Start -->
        <?php
            $this->view( "_includes/admin_sidebar", $data); 
        ?>
        <!-- Sidebar End -->


        <!-- Navbar Start -->
        <?php
            $this->view( "_includes/navbar", $data);
        ?>
            <!-- Navbar End -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Clientes</h6>
                             <button type="button" class="btn btn-link m-2 " data-bs-toggle="modal" data-bs-target="#clienteModal"><i class="fa fa-plus"></i> Adicionar novo</button>
                              </div>
                            <div class="table table-hover">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Morada</th>
                                        <th scope="col">Açao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php if (!empty($data['idClient'])): ?> 
                                    
                                    <?php foreach ($data['idClient'] as $index => $client): ?>
                                        <td><?php echo $index +1; ?></td>
                                        <td><?php echo htmlspecialchars($client['cliente']); ?></td>
                                        <td><?php echo htmlspecialchars($client['Telefone']); ?></td>
                                        <td><?php echo htmlspecialchars($client['Morada']); ?></td>
                                <td><div class="btn-group" role="group">
                                    <button type="button" href="<?= ROOT ?>category/edit" class="btn btn-outline-primary"
                                    onclick="openEditModal(<?php echo htmlspecialchars($client['idClient']);?>,
                                        '<?php echo htmlspecialchars($client['cliente']); ?>',
                                        '<?php echo htmlspecialchars($client['Telefone']); ?>',
                                        '<?php echo htmlspecialchars($client['Morada']); ?>',)">Editar</button>
                                    <button type="button" href="<?= ROOT ?>category/delete" class="btn btn-outline-primary"
                                        onclick="openDeleteModal(<?php echo htmlspecialchars($client['idClient']);?>)">Deletar</button>
                                </div>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="clienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="categoryoForm">
                      <div class="mb-3">
                        <label for="servico-name" class="col-form-label">Nome:</label>
                        <input  type="text" class="form-control" id="nome" name="category">
                        <label for="Valor-name" class="col-form-label">Telefone:</label>
                        <input type="number" class="form-control" id="telefone" name="category">
                        <label for="horas-name" class="col-form-label">Morada:</label>
                        <input type="text" class="form-control" id="Morada" name="category">
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
                            <label for="category-name" class="col-form-label" >Nome:</label>
                            <input id="editNome" name="editNome" type="text" class="form-control">
                            <input id="editGroupId" name="editGroupId"  hidden class="form-control" value="">
                            <label for="category-name" class="col-form-label">Telefone:</label>
                            <input type="number" class="form-control" id="Telefone" name="Telefone">
                            <label for="category-name" class="col-form-label">Morada:</label>
                            <input type="text" class="form-control" id="Morada" name="Morada">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="edit_cliente()">Editar</button>
                </div>               
            </form>
        </div>
    </div>
</div>
<script>
    function get_data() {
        let cliente = document.querySelector("#nome").value.trim();
        let telefone = document.querySelector("#telefone").value.trim();
        let morada = document.querySelector("#Morada").value.trim();        
        if (!cliente || !isNaN(morada)) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor insira todos os dados!'
            });
            return;
        }
        
        let data = {
            cliente: cliente,
            telefone: telefone,
            morada: morada,
            data_type: 'add_cliente'
        };

        send_data(data);
    }

    function send_data(data = {}){
        // console.log('Sending data to server:', data);

        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function(){
            if(ajax.readyState === 4 && ajax.status === 200)
            {
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST", "<?=ROOT?>clientes/cliente",true);
        ajax.setRequestHeader("Content-Type", "application/json");
        
        ajax.send(JSON.stringify(data));
    }
    function handle_result(result) {
        console.log("The result is" + result);
        
        if (result !== "") {
            try {
                var obj = JSON.parse(result);
                if (obj.data_type === "add_cliente") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            $('#clienteModal').modal('hide');
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
                if (obj.data_type === "delete_cliente") {
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
                if (obj.data_type === "edit_cliente") {
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

                
            } catch (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing the server response.'
                });
            }
        }
    }
    function openDeleteModal(idClient){
        document.getElementById('deleteGroupId').value =idClient;

        $('#deleteGroupModal').modal('show');

    }
    function delete_row(idClient)
    {
        send_data(data={
            data_type:"delete_cliente",
            id:idClient
        });
    }
    function openEditModal(idClient,cliente,Telefone,Morada){
        document.getElementById('editGroupId').value =idClient;
        document.getElementById('editNome').value =cliente;
        document.getElementById('Telefone').value =Telefone;
        document.getElementById('Morada').value = Morada;
        $('#editGroupModal').modal('show');
    }
    function edit_cliente() {
        
        let nome_input = document.querySelector("#editNome").value.trim();
        let telefone_input = document.querySelector("#Telefone").value;
        let morada_input = document.querySelector("#Morada").value;
        let id_input = document.querySelector("#editGroupId").value;
        // Validação básica dos campos
        if (nome_input === "" || isNaN(id_input)) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor, preencha os campos corretamente.'
            });
            return;
        }

        // Objeto com os dados a serem enviados
        let data = {
            nome: nome_input,
            telefone: telefone_input,
            Morada: morada_input,
            id: id_input,
            data_type: 'edit_cliente' // Data_type corrigido para 'edit_service'
        };
 
        // Envio dos dados para o controlador PHP via função send_data
        send_data(data);
    }
</script>
<?php $this->view( "_includes/admin_footer", $data); ?>