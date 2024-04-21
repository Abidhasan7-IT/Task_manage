<?php
include "header.php";

$nameErr = $startDateErr = $endDateErr = $employeeErr = "";
$name = $start_date = $end_date = $employee = $description = "";

// Database connection
require_once "../connection.php";

// Fetching employees from the database with email
$sql = "SELECT * FROM `employee` ORDER BY `name` ASC";
$result = mysqli_query($conn, $sql);

$employees = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Task Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    $current_date = date("Y-m-d");
    if (empty($_POST["start_date"])) {
        $startDateErr = "Start Date is required";
    } elseif ($_POST["start_date"] < $current_date) {
        $startDateErr = "Start Date must be today or later";
    } else {
        $start_date = test_input($_POST["start_date"]);
    }

    if (empty($_POST["end_date"])) {
        $endDateErr = "End Date is required";
    } elseif ($_POST["end_date"] < $start_date) {
        $endDateErr = "End Date cannot be earlier than Start Date";
    } else {
        $end_date = test_input($_POST["end_date"]);
    }

    if (empty($_POST["employee"])) {
        $employeeErr = "Employee is required";
    } else {
        $employee = test_input($_POST["employee"]);
        // Fetch email of selected employee
        $sql_emp = "SELECT * FROM `employee` WHERE `name`='$employee'";
        $result_emp = mysqli_query($conn, $sql_emp);
        $row_emp = mysqli_fetch_assoc($result_emp);
        $employee_email = $row_emp['email'];
    }

    $description = test_input($_POST["description"]);

    // If all fields are filled out, proceed with further processing
    if (!empty($name) && !empty($start_date) && !empty($end_date) && !empty($employee)) {
        // Perform database insertion
        $sql_insert = "INSERT INTO `task`(`name`, `description`, `status`, `start_date`, `end_date`, `emp_name`, `emp_email`, `date_created`) 
                      VALUES ('$name', '$description', 'pending', '$start_date', '$end_date', '$employee', '$employee_email', NOW())";
        if (mysqli_query($conn, $sql_insert)) {
            // Notify the selected employee
            echo "<div class='alert alert-success alert-dismissible fade show'> <strong> Task added successfully! </strong>
             <button type='button' class='close bg-transparent' data-dismiss='alert' >
            <span aria-hidden='true'>&times;</span>
          </button> </div>";

            // Clear input fields
            $name = $start_date = $end_date = $employee = $description = "";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . mysqli_error($conn) . " <button type='button' class='close bg-transparent' data-dismiss='alert' >
            <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="login-form-bg h-100 mt-2">
    <div class="container h-100">
        <div class="row justify-content-center ">
            <div class="col-xl-7">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-3 shadow">
                            <h4 class="text-center">Add New Task</h4>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                                <div class="form-group mb-3">
                                    <label>Task Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $name; ?>" name="name">
                                    <span class="text-danger"><?php echo $nameErr; ?></span>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="" class="control-label">Start Date</label>
                                    <input type="date" class="form-control w-75 form-control-sm" autocomplete="off" name="start_date" value="<?php echo $start_date; ?>">
                                    <span class="text-danger"><?php echo $startDateErr; ?></span>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="" class="control-label">End Date</label>
                                    <input type="date" class="form-control w-75 form-control-sm" autocomplete="off" name="end_date" value="<?php echo $end_date; ?>">
                                    <span class="text-danger"><?php echo $endDateErr; ?></span>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="" class="control-label">Employee</label>
                                    <select class="form-control w-50 rounded-1" name="employee">
                                        <option value="">Select Employee</option>
                                        <?php foreach ($employees as $emp) : ?>
                                            <option value="<?php echo $emp['name']; ?>"><?php echo $emp['name'] . " - " . $emp['email']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-danger"><?php echo $employeeErr; ?></span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="" class="control-label">Description</label>
                                    <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-success text-light btn-block w-50 mt-2">Add Task</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
