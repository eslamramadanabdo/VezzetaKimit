<?php


include('../shared/head.php');
include('../general/connectDB.php');

// insert patient
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $age = $_POST['age'];
    $fieldid = $_POST['fieldid'];

    $insert = "INSERT INTO  doctor VALUES(NULL , '$name', $age , $fieldid  )";
    $insertStatus = mysqli_query($connect , $insert);


    if($insertStatus){
        
    header( "location: /first/doctor/list.php" );
    }else{
        echo "<script> alert('Something went wrong'); </script>";
    }

}

// select all field
$select = "SELECT * from field";
$all = mysqli_query($connect , $select);



?>



<?php  
    if(   $_SESSION['admin']  == "admin"   ){}
    else{
        header("location: /first/admin/notauth.php");
    }
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Doctor</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Doctor</li>
                <li class="breadcrumb-item active">add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Doctor</h5>

                        <!-- General Form Elements -->
                        <form method="POST" >
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input  name="name" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-10">
                                    <input name="age" type="number" class="form-control">
                                </div>
                            </div>




                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Doctor Name</label>
                                <div class="col-sm-10">

                                <select name="fieldid" id="" class="form-control">

                                    <?php  foreach( $all as $item ){ ?>
                                    <option value="<?php  echo $item['id'] ?>"> <?php echo $item['name']  ?> </option>
                                    <?php } ?>
                                </select>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <button type="submit" name="submit" class=" btn btn-success w-50 mx-auto my-3 ">Submit</button>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>

            </div>

            
        </div>
    </section>



</main><!-- End #main -->








<?php

include('../shared/footer.php');

?>