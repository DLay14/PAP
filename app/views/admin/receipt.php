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
    <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            
                            <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Recibos</h6>
                             <button type="button" class="btn btn-link m-2 " data-bs-toggle="modal" data-bs-target="#receiptModal"><i class="fa fa-plus"></i> Adicionar novo</button>
                              </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Serviço</th>
                                            <th scope="col">Valor Por Hora</th>
                                            <th scope="col">Numero De Horas</th>
                                            <th scope="col">Valor Final</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Açao</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php if (!empty($data['idReceipt'])): ?> 
                                    
                                        <?php foreach ($data['idReceipt'] as $index => $receipt): ?>
                                            <?php
                                                switch ($receipt['PaymentStatus_idPaymentStatus']) {
                                                    case 1:
                                                        $status = "Pago";
                                                        break;
                                                    case 2:
                                                        $status = "Em Pagamento";
                                                        break;
                                                    default:
                                                        $status = "Por pagar";
                                                }
                                            ?>
                                            <td><?php echo $index +1; ?></td>
                                            <td><?php echo htmlspecialchars($receipt['servico']); ?></td>
                                            <td><?php echo htmlspecialchars($receipt['ValorPorHora']); ?></td>
                                            <td><?php echo htmlspecialchars($receipt['NumHoras']); ?></td>
                                            <td><?php echo htmlspecialchars($receipt['ValorFinal']); ?></td>
                                            <?php if (isset($receipt['PaymentStatus_idPaymentStatus'])):?>
                                                <?php if ($receipt['PaymentStatus_idPaymentStatus'] === 1):?>
                                                    <td><span class="label label-warning label-mini" style="cursor:pointer"
                                                            onclick="payment_status(<?php echo $receipt['idReceipt'];?>,<?php echo $receipt['PaymentStatus_idPaymentStatus'];?>)">Pago</span></td>
                                                <?php elseif ($receipt['PaymentStatus_idPaymentStatus'] === 2):?>
                                                    <td><span class="label label-warning label-mini" style="cursor:pointer"
                                                            onclick="payment_status(<?php echo $receipt['idReceipt'];?>,<?php echo $receipt['PaymentStatus_idPaymentStatus'];?>)">Em Pagamento</span></td>
                                                <?php elseif ($receipt['PaymentStatus_idPaymentStatus'] === 3):?>
                                                    <td><span class="label label-warning label-mini" style="cursor:pointer"
                                                            onclick="payment_status(<?php echo $receipt['idReceipt'];?>,<?php echo $receipt['PaymentStatus_idPaymentStatus'];?>)">Por pagar</span></td>
                                                <?php endif;?>
                                            <?php endif;?>
                                    <td><div class="btn-group" role="group">
                                        <button type="button" href="<?= ROOT ?>category/edit" class="btn btn-outline-primary"
                                        onclick="openEditModal(<?php echo htmlspecialchars($receipt['idReceipt']);?>,
                                            '<?php echo htmlspecialchars($receipt['servico']); ?>',
                                            '<?php echo htmlspecialchars($receipt['ValorPorHora']); ?>',
                                            '<?php echo htmlspecialchars($receipt['NumHoras']); ?>',)">Editar</button>
                                        <?php if ($receipt['PaymentStatus_idPaymentStatus'] == 1) :?>
                                        <button type="button" href="<?= ROOT ?>category/delete" class="btn btn-outline-primary"
                                            onclick="openDeleteModal(<?php echo htmlspecialchars($receipt['idReceipt']);?>)">Deletar</button>
                                        <?php else: ?>
                                            <button type="button" href="<?= ROOT ?>receipt/delete" class="btn btn-outline-primary"
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
                </div>
            </div>

            <div class="modal fade " id="receiptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Recibo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="categoryoForm">
                      <div class="mb-3">
                        <label for="servico-name" class="col-form-label">Serviço:</label>
                        <input  type="text" class="form-control" id="servico-name" name="category">
                        <label for="Valor-name" class="col-form-label">Valor Por Hora:</label>
                        <input type="text" class="form-control" id="ValorPorHora" name="category">
                        <label for="horas-name" class="col-form-label">Numeros de Horas:</label>
                        <input type="text" class="form-control" id="NumHoras" name="category">
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
                            <label for="category-name" class="col-form-label" >Serviço:</label>
                            <input id="editService" name="editService" type="text" class="form-control">
                            <input id="editGroupId" name="editGroupId"  hidden class="form-control" value="">
                            <label for="category-name" class="col-form-label">Valor Por Hora:</label>
                            <input type="number" class="form-control" id="Valor_Por_Hora" name="Valor_Por_Hora">
                            <label for="category-name" class="col-form-label">Numero de Horas:</label>
                            <input type="number" class="form-control" id="Num_Horas" name="Num_Horas">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="edit_receipt()">Editar</button>
                </div>               
            </form>
        </div>
    </div>
</div>

<script>
    function get_data() {
        let servico = document.querySelector("#servico-name").value.trim();
        let Valor = document.querySelector("#ValorPorHora").value.trim();
        let Num = document.querySelector("#NumHoras").value.trim();        
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
            Valor: Valor,
            Num: Num,
            data_type: 'add_receipt'
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

        ajax.open("POST", "<?=ROOT?>receipts/receipt",true);
        ajax.setRequestHeader("Content-Type", "application/json");
        
        ajax.send(JSON.stringify(data));
    }

    function handle_result(result) {
        console.log("The result is" + result);
        
        if (result !== "") {
            try {
                var obj = JSON.parse(result);
                if (obj.data_type === "add_receipt") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            $('#receiptModal').modal('hide');
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

                if (obj.data_type === "edit_receipt") {
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

                if (obj.data_type === "payment_status"){
                    location.reload();
                }

                if (obj.data_type === "delete_receipt") {
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

    function payment_status(idReceipt, state) {
    send_data(data = {
        data_type: "payment_status",
        idReceipt: idReceipt,
        current_state: state
    });
    // console.log(data);
    }
    function openDeleteModal(idReceipt){
        document.getElementById('deleteGroupId').value =idReceipt;

        $('#deleteGroupModal').modal('show');

    }
    function delete_row(idReceipt)
    {
        send_data(data={
            data_type:"delete_receipt",
            id:idReceipt
        });
    }
    function deleteError(){
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: "Voce nao pode apagar um Por Pagar ou Em Pagamento"
        });
    }
    function openEditModal(idReceipt,servico,ValorPorHora,NumHoras){
        document.getElementById('editGroupId').value =idReceipt;
        document.getElementById('editService').value =servico;
        document.getElementById('Valor_Por_Hora').value =ValorPorHora;
        document.getElementById('NumHoras').value = NumHoras;
        $('#editGroupModal').modal('show');
    }
    function edit_receipt() {
        
        let servico_input = document.querySelector("#editService").value.trim();
        let ValorPorHora_input = document.querySelector("#Valor_Por_Hora").value;
        let NumHoras_input = document.querySelector("#Num_Horas").value;
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
            ValorPorHora: ValorPorHora_input,
            NumHoras: NumHoras_input,
            id: id_input,
            data_type: 'edit_receipt' // Data_type corrigido para 'edit_service'
        };
 
        // Envio dos dados para o controlador PHP via função send_data
        send_data(data);
    }

</script>
        
<?php $this->view( "_includes/admin_footer", $data); ?>