<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 17/09/2015
 * Time: 15:13
 */
?>
    <h1>Group Detail</h1>
    <div data-role="collapsible">
        <h4>Group Information</h4>
        <form action="<?php echo OpenSms::getActionUrl('update')?>" method="post">
            <div data-demo-html="true">
                <input value="<?php echo $this->data['group']->Name; ?>" type="text" class="form-control" name="Name" placeholder="Group Name"/>
            </div>
            <div data-demo-html="true">
                <textarea name="Description" class="form-control" placeholder="Description">
                    <?php echo $this->data['group']->Description; ?>
                </textarea>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>

    <h4>Contacts</h4>
<?php if(count($this->data['contacts']) < 1){?>
    <p class="text-danger">No record found</p>
<?php } ?>

<p><?php echo count($this->data['contacts']) ?> Contacts</p>