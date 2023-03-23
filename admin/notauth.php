<?php

include('../shared/head.php');

if($_SESSION['admin']){}
    else{
        header("location: /first/index.php");
    }
?>




<main id="main" class="main">

    <h1 class="text-center text-danger mt-5">You Are Not Authroized </h1>

</main>



<?php

include('../shared/footer.php');
?>