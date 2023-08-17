<?php
include 'View/header.php';

// Admin Page
// print_r($dataArray); die;
?>
<div class="container m-5">
    <a href="<?php echo BASE_ACTION_URL . "register"; ?>" class="text-decoration-none">
        <h2>Add New User</h2>
    </a>
</div>
<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Sr. No.</th>
                <th scope="col">Worker ID</th>
                <th scope="col">Password</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email Id</th>
                <th scope="col">Mobile No.</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $srNo = 1;
            if (!empty($dataArray)) {
                foreach ($dataArray as $key => $value) {
                    $workerId = (isset($value['worker_id']) && $value['worker_id'] > 0) ? $value['worker_id'] : 0;
                    $worker_id = str_pad($workerId, 3, '0', STR_PAD_LEFT);
            ?>
                    <tr>
                        <th scope="row"><?php echo $srNo++; ?></th>
                        <td><?php echo 'W'.$worker_id ?></td>
                        <td><?php echo $value['password'] ?></td>
                        <td><?php echo $value['full_name'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td><?php echo $value['mobile'] ?></td>
                        <td><a href="<?php echo BASE_ACTION_URL . "edit-w&id=" . $value['worker_id'] . ""; ?>"><img src="View/images/edit-icon.png" alt="img" /></a></th>
                        <td><a href="<?php echo BASE_ACTION_URL . "delete&id=" . $value['worker_id'] . ""; ?>"><img src="View/images/delete-icon.png" height="23px" alt="img" /></a></th>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td>No Records Found</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>
<?php
include 'View/footer.php';
