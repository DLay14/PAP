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
       <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="home" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="home.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="home" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-user me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex"><?php echo $data['user_data']->nome; ?></span>
</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="logout" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
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