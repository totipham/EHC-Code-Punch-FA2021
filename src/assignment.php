<?php
    echo file_get_contents('header.html');
    if ($SESSION['role'] == true) { /* FIXME: check role */
        echo file_get_contents ("tAssignment.php");
    } else {
        echo file_get_contents ("sAssignment.php");
    }
?>  

<div class="container">
  <div class="vertical-center">
        <form action="./"> <!-- FIXME: Need a page to header -->
            <button type="submit" class="btn btn-primary btn-block">Back to dashboard</button>              
        </form>
  </div>
</div>

<?php
    echo file_get_contents ("footer.html");
?>