<?php $this->view( "_includes/admin_header", $data); ?>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start 
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
       Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <form class="row g-3 needs-validation" novalidate method= "post" >
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="login" class="">
                                <h3 class="text-primary"><i class="fa fa-screwdriver"></i>F.G.S.</h3>
                            </a>
                            <h3>Registo</h3>
                        </div>
                        <div class="col-12">
                      <label for="yourName" class="form-label" placeholder="nome">Nome</label>
                      <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Telefone</label>
                      <input type="text" name="telefone" value="<?= isset($_POST['telefone']) ? $_POST['telefone'] : ''; ?>" class="form-control" id="yourTelefone" required>
                      <div class="invalid-feedback">Telefone</div>
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <span sytle="color:red"><?php check_error() ?></span>
                    <div class="col-12">
                      <label for="yourPassword2" class="form-label">Password</label>
                      <input type="password2" name="password2" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Rewrite your password again please!</div>
                    </div>
                    <br>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Registar</button>
                    </div>
                    <div class="col-12">

                    </form>
                    </div>
                    <br>
                        <!-- <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Registar</button> -->
                        <p class="text-center mb-0">Already have an Account? <a href="login">Login</a></p>
                    </div>
                  
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>