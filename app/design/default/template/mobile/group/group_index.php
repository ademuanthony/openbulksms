<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 17/09/2015
 * Time: 15:13
 */
?>
<h1>Groups</h1>
<div data-role="collapsible">
    <h4>New Group</h4>
    <form action="<?php echo OpenSms::getActionUrl('add')?>" method="post">
        <div data-demo-html="true">
            <input type="text" class="form-control" name="Name" placeholder="Group Name"/>
        </div>
        <div data-demo-html="true">
            <textarea name="Description" class="form-control" placeholder="Description"></textarea>
        </div>
        <button type="submit">Add Group</button>
    </form>
</div>

<h4>My Groups</h4>
<?php foreach ($this->data['groups'] as $group) {?>

<div data-role="collapsible">
    <h4><?php echo $group->Name?></h4>
        <p><?php echo $group->Description?></p>
    <div >
        <a href="<?php echo OpenSms::getActionUrl('detail', '*', 'group', ['parameter1'=>$group->Id])?>" class="product-title">Detail</a>
        <a href="<?php echo OpenSms::getActionUrl('delete', '*', 'group', ['parameter1'=>$group->Id])?>" class="btn btn-danger btn-xs pull-right">
            Delete
        </a>
    </div>
            
</div>
<?php }?>