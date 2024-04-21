<?php 
    include "header.php";
?>


<?php 

// database connection
require_once "../connection.php";

// Pagination variables
$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM emp_leave WHERE status = 'pending' LIMIT $start, $limit";
$result = mysqli_query($conn , $sql);

$i = 1;

?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-3"> 
    <h4 class="text-center pb-3">Leave Requests</h4>
    <div class="table-responsive">
        <table style="width:100%" class="table-hover text-center ">
        <tr class="bg-dark text-light">
            <th>S.No.</th>
            <th>E.mail</th>
            <th>Starting Date</th>
            <th>Ending Date</th> 
            <th>LeaveType</th>
            <th>Comment</th>
            <th>Status</th>
        </tr>

        <?php 
        
        if( mysqli_num_rows($result) > 0){
            while( $rows = mysqli_fetch_assoc($result) ){
                $start_date= $rows["start_date"];
                $last_date = $rows["last_date"];
                $email= $rows["email"];
                $LeaveType= $rows["LeaveType"];
                $reason = $rows["reason"];
                $status = $rows["status"];   
                $id = $rows["id"]; 
                ?>
            <tr>
            <td><?php echo ($start + $i) . '.'; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo date("jS F", strtotime($start_date)); ?></td>
            <td><?php echo date("jS F", strtotime($last_date)); ?></td>
            <td><?php echo $LeaveType; ?> </td>
            <td><?php echo $reason; ?></td> 

            <td><?php  echo "<a href='accept-leave.php?id={$id}' class='btn btn-sm btn-outline-success mr-2'><i class='fa fa-check'></i> </a> " ;
                        echo " <a href='cancel-leave.php?id={$id}' class='btn btn-sm btn-outline-danger'> <i class='fas fa-times'></i> </a>" ;?>  
            </td> 
         </tr>
         <?php 
                $i++;
                }
            }else{
                echo "<tr><td colspan='8'> No Leave Requests Found..</td></tr>";
            }
        ?>
        </table>
    </div>

    <!-- Pagination -->
    <div class="text-center mt-3">
    <?php
    $sql = "SELECT COUNT(id) AS total FROM emp_leave WHERE status = 'pending'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    $total_pages = ceil($total_records / $limit);

    if ($page > 1) {
        echo "<a href='?page=".($page - 1)."' class='btn btn-sm btn-outline-secondary mr-2'>Previous</a>";
    } 
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=".$i."' class='btn btn-sm ".($page == $i ? 'btn-secondary' : 'btn-outline-secondary')." mr-2'>$i</a>";
    }
    if ($page < $total_pages) {
        echo "<a href='?page=".($page + 1)."' class='btn btn-sm btn-outline-secondary'>Next</a>";
    }
    ?>
    </div>

    <!-- Showing entries -->
    <div class="text-center mt-3">
        <?php
        $end = min($start + $limit, $total_records);
        echo "Showing " . ($start + 1) . " to $end of $total_records entries";
        ?>
    </div>
    </div>
</div>


<?php 
    include "footer.php";
?>
