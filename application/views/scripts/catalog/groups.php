<?php foreach ($groups as $group) { ?>

    <a href="<?php echo URL::base(true) . Route::get('catalog')->uri(array('firm' => $firm->name, 'action' => 'subgroups'  )) ?>?model=<?php echo $model->mdl ?>&group=<?php echo $group->groupid; ?>" ><?php echo $group->name; ?></a><br/>
    
    <br/>
    
<?php } ?>