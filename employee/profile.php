<?php 
include "header.php";
?>

<?php  
    

    // databaseconnection
    require_once "../connection.php";

    $sql_command = "SELECT * FROM employee WHERE email = '$_SESSION[email]' ";
    $result = mysqli_query($conn , $sql_command);

    if( mysqli_num_rows($result) > 0){
       while( $rows = mysqli_fetch_assoc($result) ){
           $name = ucwords($rows["name"]);
           $gender = ucwords($rows["gender"]);
           $dob= $rows["dob"];
           $Position= $rows["Position"];
            $salary = $rows["salary"];   
            $dp = $rows["dp"];     
            $id = $rows["id"];
       }

       if( empty($gender)){
           $gender = "Not Defined";
       }
       if( empty($dob)){
        $dob = "Not Defined";
       } else{
        $dob = date('jS F Y' , strtotime($dob) );
        }

        if(empty($Position)){
            $Position= "Not Available";
        }

       if(empty($salary)){
        $salary= "Not Defined";
       }         
    
}
 ?>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-6 col-sm-12 col-md-6">
            <div class="card shadow" style="width: 20rem;">
                <img src="upload/<?php if(!empty($dp)){ echo $dp; }else{ echo "../img/logo.png"; } ?>" class="rounded-circle img-fluid  card-img-top"  style="height: 300px "  alt="Profile">
                <div class="card-body">
                    <h2 class="text-center mb-4"><?php echo $name; ?></h2>
                    <p class="card-text">Email: <?php echo $_SESSION["email"] ?></p>
                    <p class="card-text">Employee Id: <?php echo $id ?></p>
                    <p class="card-text">Gender: <?php echo $gender ?></p>
                    <p class="card-text">Date of Birth: <?php echo $dob; ?></p>
                    <p class="card-text">Position: <?php echo $Position; ?></p>
                    <p class="card-text">Salary: <?php echo $salary . " TK."; ?></p>
                    <p class="text-center">
                        <a href="edit-profile.php" class="btn btn-outline-primary">Edit Profile</a>
                        <a href="change-password.php" class="btn btn-outline-primary">Change Password</a>
                        <a href="profile-photo.php" class="mt-2 btn btn-outline-primary">Change profile photo</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
include "footer.php";
?>