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
                        <button type="button" class="btn btn-link m-2 " data-bs-toggle="modal" data-bs-target="#categoryModal"><i class="fa fa-plus"></i> Adicionar novo</button>
                    </div>
                    <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data['categories'])):  ?>
                                    <?php foreach ($data['categories'] as $index => $teste): ?>
                                <tr>
                                    <td><?php echo $index +1; ?></td>
                                    <td><?php echo htmlspecialchars($teste['teste']); ?></td>
                                    <td>sadasdasda</td>
                                    <td></td>
                                    <td></td>
                                    <td><div class="btn-group" role="group">
                                        <button type="button" href="<?= ROOT ?>category/info" class="btn btn-outline-primary">Info</button>
                                        <button type="button" href="<?= ROOT ?>category/edit" class="btn btn-outline-primary">Editar</button>
                                        <button type="button" href="<?= ROOT ?>category/delete" class="btn btn-outline-primary"
                                            onclick="openDeleteModal(<?php echo htmlspecialchars($teste['id']);?>)">Deletar</button>
                                    </div></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

            

<div class="modal fade " id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <!-- <br> 
             <select name="cars" id="servico-name">
                <option value="pintar">pintar</option>
                <option value="saab">Saab</option>
                <option value="opel">Opel</option>
                <option value="audi">Audi</option>
            </select> -->
          </div>
          <!-- <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div> -->
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
        <div class="modal-content">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="delete_row(document.getElementById('deleteGroupId').value)">Apagar</button>
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

function get_data()
{
    let category_input = document.querySelector("#category-name");
    if(category_input.value.trim() === "" || !isNaN(category_input.value.trim())){
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Por favor insira todos os dados!'
        });
        return;
    }
    var data = category_input.value.trim();

    send_data({
        data: data,
        data_type: 'add_category'
    });
}

function send_data(data = {}){

    var ajax = new XMLHttpRequest();


    ajax.addEventListener('readystatechange', function(){
        if(ajax.readyState === 4 && ajax.status === 200)
        {
            handle_result(ajax.responseText);
        }
    })
    ajax.open("POST", "<?=ROOT?>ajax",true);
    ajax.setRequestHeader("Content-Type", "application/json");

    ajax.send(JSON.stringify(data));
}

function handle_result(result){
    if (result != "")
    {
        var obj = JSON.parse(result);
        console.log(result);
        if(obj.message_type === "info")
        {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: obj.message

            }).then(() => {
                $('#categoryModal').modal('hide');
                document.querySelector("#category-name").value = "";

                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title:  'Erro',
                text: obj.message
            });
        }
    }
}

function openDeleteModal(id){
    document.getElementById('deleteGroupId').value =id;

    $('#deleteGroupModal').modal('show');

}

function delete_row(id)
{
    send_data(data={
        data_type:"delete_row",
        id:id
    })
}

</script>
<?php $this->view( "_includes/admin_footer", $data); ?>