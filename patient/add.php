<?php

include('../shared/head.php');
include('../general/connectDB.php');

// insert patient
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $doctorid = $_POST['doctorid'];

    $insert = "INSERT INTO  patient VALUES(NULL , '$name', $age ,'$description' , $doctorid  )";
    $insertStatus = mysqli_query($connect , $insert);


    if($insertStatus){
        
    header( "location: /first/patient/list.php" );
    }else{
        echo "<script> alert('Something went wrong'); </script>";
    }

}

// select all doctors
$select = "SELECT doctor.id , doctor.name as dname , field.name as fname from doctor JOIN field on doctor.fieldID = field.id;";
$all = mysqli_query($connect , $select);

?>


<?php  
    if(   ($_SESSION['admin']  == "admin")  || ($_SESSION['admin']  == "doctor") || ($_SESSION['admin']  == "employee") ){}
    else{
        header("location: /first/admin/notauth.php");
    }
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Patient</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Patient</li>
                <li class="breadcrumb-item active">add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Patient</h5>

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
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea  name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Doctor Name</label>
                                <div class="col-sm-10">

                                <select name="doctorid" id="" class="form-control">

                                    <?php  foreach( $all as $item ){ ?>
                                    <option value="<?php  echo $item['id'] ?>"> <?php echo $item['dname']  ; echo "  --  "  .  " ( " . $item['fname']  . " ) " ?> </option>
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