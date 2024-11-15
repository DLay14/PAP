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
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Informações</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">Nome - <?php echo $data['user_data']->nome; ?></li>
                                <li class="list-group-item bg-transparent">Email - <?php echo $data['user_data']->email; ?></li>
                                <li class="list-group-item bg-transparent">Telefone - <?php echo $data['user_data']->telefone; ?></li>
                                <li class="list-group-item bg-transparent">Criação de conta - <?php echo $data['user_data']->date; ?></li>
                            </ul>
                        </div>
                    </div>
            </div>

<?php $this->view( "_includes/admin_footer", $data); ?>