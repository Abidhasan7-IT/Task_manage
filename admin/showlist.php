<?php
// Include header
include "./header.php";

// Include database connection
require_once "../connection.php";

// Initialize variables for filtering
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Pagination variables
$limit = 7; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Construct SQL query based on filter dates and status
$sql = "SELECT * FROM emp_leave WHERE status = 'Accepted'";
if (!empty($start_date)) {
    $sql .= " AND start_date >= '$start_date'";
}
if (!empty($end_date)) {
    $sql .= " AND last_date <= '$end_date'";
}
$sql .= " LIMIT $start, $limit";

$result = mysqli_query($conn, $sql);

// Initialize counter for serial number
$i = ($page - 1) * $limit + 1;
?>

<!-- CSS styles for table -->
<style>
    table,
    th,
    td {
        border: 1px solid black;
        padding: 10px;
    }

    table {
        border-spacing: 10px;
    }
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-2">
        <h4 class="text-center">Leave List</h4>
        <!-- Filter form -->
        <form method="GET" class="mb-3">
            <div class="row justify-content-center">
                <div class="col-md-3 col-sm-6 mb-2">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="<?php echo $start_date; ?>">
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date" value="<?php echo $end_date; ?>">
                </div>
                <div class="col-md-2 col-sm-6 mb-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> </button>
                </div>
                <!-- Print button -->
                <div class="col-md-2 col-sm-6 mb-2">
                    <button onclick="printTable()" class="btn btn-success"><i class="fa fa-print"></i> </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover text-center">
                <tr class="bg-success text-light">
                    <th>SL</th>
                    <th>Name</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Total Days</th>
                    <th>LeaveType</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                // Check if there are records
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each record
                    while ($rows = mysqli_fetch_assoc($result)) {
                        $start_date = $rows["start_date"];
                        $last_date = $rows["last_date"];
                        $LeaveType = $rows["LeaveType"];
                        $status = $rows["status"];
                        $name = $rows["name"];
                        $id = $rows["id"];
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo date("jS F", strtotime($start_date)); ?></td>
                            <td><?php echo date("jS F", strtotime($last_date)); ?></td>
                            <td>
                                <?php
                                $date1 = date_create($start_date);
                                $date2 = date_create($last_date);
                                $diff = date_diff($date1, $date2);
                                echo $diff->format("%a days");
                                ?>
                            </td>
                            <td><?php echo $LeaveType; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <a href='delete-leavelist.php?id=<?php echo $id; ?>' id='bin' class='btn-sm btn-danger '> <span><i class='fa fa-trash'></i></span> </a>
                            </td>
                        </tr>
                <?php
                        $i++; // Increment counter
                    }
                } else {
                    // If no records found
                    echo "<tr><td colspan='8' class='text-center'>No records found.</td></tr>";
                }
                ?>
            </table>
        </div>

        <!-- Pagination -->
        <div class="text-center mt-3">
            <?php
            // Count total records
            $total_query = "SELECT COUNT(*) AS total FROM emp_leave WHERE status = 'Accepted'";
            $total_result = mysqli_query($conn, $total_query);
            $total_row = mysqli_fetch_assoc($total_result);
            $total_records = $total_row['total'];
            $total_pages = ceil($total_records / $limit);

            // Previous page link
            if ($page > 1) {
                echo "<a href='?page=" . ($page - 1) . "' class='btn btn-sm btn-outline-secondary mr-2'>Previous</a>";
            }
            // Page links
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='?page=" . $i . "' class='btn btn-sm " . ($page == $i ? 'btn-secondary' : 'btn-outline-secondary') . " mr-2'>$i</a>";
            }
            // Next page link
            if ($page < $total_pages) {
                echo "<a href='?page=" . ($page + 1) . "' class='btn btn-sm btn-outline-secondary'>Next</a>";
            }
            ?>
        </div>
    </div>
</div>

<?php
// Include footer
include "./footer.php";
?>

<!-- JavaScript function for printing table -->
<script>
    function printTable() {
        var printWindow = window.open('', '', 'height=500,width=800');
        printWindow.document.write('<html><head><title>Leave List</title>');
        printWindow.document.write('</head><body class="text-center">');
        printWindow.document.write('<h3 class="text-center">Leave List</h3>');
        printWindow.document.write(document.querySelector('.table-hover').outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
