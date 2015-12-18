<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 4/9/2015
 * Time: 5:47 PM
 */
//get all errors and clear the error session
?>
<?php if(!empty($_SESSION['error'])){?>
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    <ul>
        <?php foreach($_SESSION['error'] as $error){
            echo "<li>$error</li>";
        } ?>
    </ul>
</div>
<?php }?>

<?php if(!empty($_SESSION['notification'])){?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <ul>
        <?php foreach($_SESSION['notification'] as $message){
            echo "<li>$message</li>";
        } ?>
    </ul>
</div>
<?php }
unset($_SESSION['error']);
unset($_SESSION['notification']);
?>