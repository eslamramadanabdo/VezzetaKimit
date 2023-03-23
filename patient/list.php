<?php
include('../shared/head.php');
include('../general/connectDB.php');



// select pateint
$select = "SELECT patient.id , patient.name as pname , patient.age , patient.description , doctor.name as dname from patient JOIN doctor on patient.doctorID = doctor.id;";
$all  = mysqli_query($connect , $select);


// delete patient
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete = "DELETE FROM patient WHERE id = $id";
    
    $deleteStatus = mysqli_query($connect , $delete);

    if($deleteStatus){
        echo "<script> alert('Patient Deleted Successfully');  </script>";
        header( "location: /first/patient/list.php" );

    }else{
        echo "<script> alert('Something went wrong');  </script>";
    }


}


?>


<?php  
    if(   ($_SESSION['admin']  == "admin")  || ($_SESSION['admin']  == "doctor") || ($_SESSION['admin']  == "employee") ){}
    else{
        header("location: /first/admin/notauth.php");
    }
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>List All Patient</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Patient</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List All Patient</h5>

                        <!-- Dark Table -->
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Description</th>
                                    <th>Doctor Name</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?PHP  foreach($all as $item){   ?>
                                <tr>
                                    <td> <?php  echo $item['id'] ?> </td>
                                    <td><?php  echo $item['pname'] ?></td>
                                    <td><?php  echo $item['age'] ?></td>
                                    <td><?php  echo $item['description'] ?></td>
                                    <td><?php  echo $item['dname'] ?></td>
                                    <td>
                                        <a  class="" href="/first/patient/list.php/?delete=<?php echo $item['id'] ?>"   > <i class="fa-solid fa-trash-can text-danger "></i></a>
                                    </td>
                                    <td>
                                    <a  href="/first/patient/edit.php/?edit=<?php echo $item['id'] ?>"   > <i class="fa-solid fa-pen-to-square text-info  "></i></a>

                                    </td>
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