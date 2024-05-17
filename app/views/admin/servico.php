<?php 

$this->view( "_includes/admin_header", $data); 

?>

<body>

<div class="container-fluid position-relative d-flex p-0">

<?php 

$this->view( "_includes/admin_sidebar", $data); 
$this->view( "_includes/navbar", $data); 
?>

<div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Sales</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col"></th>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data['services']) && is_array($data['services'])): ?>
                            <?php foreach ($data['services'] as $service): ?>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td><?php echo htmlspecialchars($service['TipoServico']); ?></td>
                                    <td><?php echo htmlspecialchars($service['DataInicio']); ?></td>
                                    <td><?php echo htmlspecialchars($service['DataFim']); ?></td>
                                    <td><a class="btn btn-sm btn-primary" href="detail.php?id=<?php echo $service['id']; ?>">Detail</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No services found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php show($data);?>
            </div>
        </div>
    </div>

<?php 

$this->view( "_includes/admin_footer", $data); 

?>

    