<?php
include('../shared/head.php');
include('../general/connectDB.php');



// select doctor
$select = "SELECT doctor.id , doctor.name  , doctor.age , field.name as fname FROM `doctor` join field on doctor.fieldID = field.id;";
$all  = mysqli_query($connect , $select);


// delete patient
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete = "DELETE FROM doctor WHERE id = $id";
    
    $deleteStatus = mysqli_query($connect , $delete);

    if($deleteStatus){
        echo "<script> alert('Doctor Deleted Successfully');  </script>";
        header( "location: /first/doctor/list.php" );

    }else{
        echo "<script> alert('Something went wrong');  </script>";
    }


}


?>


<?php  
    if(   ($_SESSION['admin']  == "admin") || ($_SESSION['admin']  == "doctor" )  || ($_SESSION['admin']  == "employee")  ){}
    else{
        header("location: /first/admin/notauth.php");
    }
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>List All Doctors</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Doctors</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List All Doctors</h5>

                        <!-- Dark Table -->
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Field Name</th>
                                    <?php if(($_SESSION['admin']  == "admin")): ?>
                                    <th colspan="2">Action</th>
                                    <?php endif;?>
                                </tr>
                            </thead>
                            <tbody>
                            <?PHP  foreach($all as $item){   ?>
                                <tr>
                                    <td> <?php  echo $item['id'] ?> </td>
                                    <td><?php  echo $item['name'] ?></td>
                                    <td><?php  echo $item['age'] ?></td>
                                    <td><?php  echo $item['fname'] ?></td>
                                    <?php if(($_SESSION['admin']  == "admin")): ?>
                                    <td>
                                        <a  class="" href="/first/doctor/list.php/?delete=<?php echo $item['id'] ?>"   > <i class="fa-solid fa-trash-can text-danger "></i></a>
                                    </td>
                                    <td>
                                    <a  href="/first/doctor/edit.php/?edit=<?php echo $item['id'] ?>"   > <i class="fa-solid fa-pen-to-square text-info  "></i></a>

                                    </td>
                                    <?php endif; ?>
                                </tr>
                                
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- End Dark Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->











<?php
include('../shared/footer.php');
?>