<?php
include 'View/header.php';

// Workers Data 
// print_r($dataArray); die;

$workerId = (isset($dataArray['worker_id']) && $dataArray['worker_id']>0) ? $dataArray['worker_id'] : 0;
$worker_id = str_pad($workerId, 3, '0', STR_PAD_LEFT);
?>

<div class="container mt-5">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Worker Id</th>
        <th scope="col">Password</th>
        <th scope="col">Full Name</th>
        <th scope="col">Email Id</th>
        <th scope="col">Mobile No.</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo 'W'.$worker_id; ?></th>
        <td><?php echo $dataArray['password']; ?></td>
        <td><?php echo $dataArray['full_name']; ?></td>
        <td><?php echo $dataArray['email']; ?></td>
        <td><?php echo $dataArray['mobile']; ?></td>
        <td><a href="<?php echo BASE_ACTION_URL."edit-w"; ?>"><img src="View/images/edit-icon.png" alt="img"/></a></th>
      </tr>

      <!-- <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@fat</td>
      <td>@fat</td>
      <td colspan="2">@fat</td>
      <td>@fat</td>
    </tr> -->
    </tbody>
  </table>
</div>
<?php
include 'View/footer.php';


// <?php 
//     $srNo = 1;
//     foreach($dataArray as $value){
//       print_r($value); die;
//   
?>