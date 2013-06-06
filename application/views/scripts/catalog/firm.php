<?php foreach ($models as $model) { ?>

    <div><?php echo $model->model ?></div>
    <?php 
        $years = $model->models_years->find_all(); 
        foreach ($years as $year) { 
    ?>
    
    <a href="<?php echo URL::base(true) . Route::get('catalog')->uri(array('firm' => $firm->name, 'action' => 'groups'  )) ?>?model=<?php echo $year->mdl; ?>" ><?php echo $year->year; ?></a><br/>
    
    <?php } ?>
    
    <br/>
    
<?php } ?>