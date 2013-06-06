<table border='1'>

<?php foreach ($subgroups as $subgroup) { ?>

    <tr>
        <td><?php echo $subgroup->gr; ?></td>
        <td><?php echo $subgroup->subgr; ?></td>
        <td><?php echo $subgroup->img; ?></td>
        <td>
            <a href="<?php echo URL::base(true) . Route::get('catalog')->uri(array('firm' => $firm->name, 'action' => 'details'  )) ?>?model=<?php echo $model->mdl; ?>&subid=<?php echo $subgroup->subid; ?>" >
            <?php echo $subgroup->name; ?>
            </a>
        </td>
        <td><?php echo $subgroup->notice; ?></td>
        <td><?php echo $subgroup->data; ?></td>
    
    
    </tr>
    
<?php } ?>

</table>