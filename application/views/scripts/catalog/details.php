<table border='1'>

    <img src='<?php echo $img_url; ?>' height="500px" style="float: left" />
    
<?php foreach ($categories as $category) { ?>

    <tr style='background-color: wheat'>
        <td colspan="3">
            <?php echo $category->name; ?>
        </td>
        <td colspan="3">
            <?php echo $category->data; ?>
        </td>
    </tr>
    
    <?php 
        $details = $category->details->find_all(); 
        foreach ($details as $detail) {
    ?>
    
    <tr>
        <td><?php echo $detail->position; ?></td>
        <td><?php echo $detail->code; ?></td>
        <td><?php echo $detail->name; ?></td>
        <td><?php echo $detail->notice; ?></td>
        <td><?php echo $detail->number; ?></td>
        <td><?php echo $detail->data; ?></td>
    
    
    </tr>
    
    <?php } ?>
    
<?php } ?>

</table>