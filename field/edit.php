<?php

include('../shared/head.php');
include('../general/connectDB.php');



// edite
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $selectOne = "SELECT * FROM field WHERE id  = $id";
    $oneField = mysqli_query($connect, $selectOne);

    $row = mysqli_fetch_assoc($oneField);

    $name = $row['name'];

    if (isset($_POST['update'])) {
        $name = $_POST['name'];

        $update = " UPDATE field SET name = '$name'  WHERE id =$id ";
        $updateStatus = mysqli_query($connect, $update);
        if ($updateStatus) {
            header("location: /first/field/list.php");
        } else {
            echo "<script> alert('Something went wrong in update'); </script>";
        }
    }


}


// select all doctors
$select = "SELECT * from field";
$all = mysqli_query($connect, $select);

?>

<?php  
    if(   ($_SESSION['admin']  == "admin")   ){}
    else{
        header("location: /first/admin/notauth.php");
    }
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edite Field</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Field</li>
                <li class="breadcrumb-item active">edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Field</h5>

                        <!-- General Form Elements -->
                        <form method="POST">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" value="<?php echo $name ?>" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <button type="submit" name="update"
                                    class=" btn btn-success w-50 mx-auto my-3 ">Update</button>
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