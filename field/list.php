<?php
include('../shared/head.php');
include('../general/connectDB.php');



// select doctor
$select = "SELECT * from field";
$all  = mysqli_query($connect , $select);


// delete patient
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete = "DELETE FROM field WHERE id = $id";
    
    $deleteStatus = mysqli_query($connect , $delete);

    if($deleteStatus){
        echo "<script> alert('Field Deleted Successfully');  </script>";
        header( "location: /first/field/list.php" );

    }else{
        echo "<script> alert('Something went wrong');  </script>";
    }


}


?>


<?php  
    if(   ($_SESSION['admin']  == "admin") ||  ($_SESSION['admin']  == "doctor")  ||  ($_SESSION['admin']  == "employee")   ){}
    else{
        header("location: /first/admin/notauth.php");
    }
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>List All Fields</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Fields</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List All Fields</h5>

                        <!-- Dark Table -->
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th>Name</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?PHP  foreach($all as $item){   ?>
                                <tr>
                                    <td> <?php  echo $item['id'] ?> </td>
                                    <td><?php  echo $item['name'] ?></td>
                                    <td>
                                        <a  class="" href="/first/field/list.php/?delete=<?php echo $item['id'] ?>"   > <i class="fa-solid fa-trash-can text-danger "></i></a>
                                    </td>
                                    <td>
                                    <a  href="/first/field/edit.php/?edit=<?php echo $item['id'] ?>"   > <i class="fa-solid fa-pen-to-square text-info  "></i></a>

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