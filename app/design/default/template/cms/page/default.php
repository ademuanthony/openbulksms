<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/14/2015
 * Time: 4:41 PM
 */
?>
<style>
    #r p{
        color: #333 !important;
    }
</style>
<div id="r">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="min-height:450px; border-radius: 10px; background: rgb(250, 250, 250); padding: 5px; color: #333">
                    <h2><?php echo $this->data['page']->Title?></h2>
                    <?php echo $this->data['page']->Body;?>
                </div>
            </div>
        </div>
    </div>
</div>

