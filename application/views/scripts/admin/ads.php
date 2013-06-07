<?php echo __('Add ads'); ?>

<form method="post">
    
    <table>
        <tr>
            <td><?php echo __('Website: (http://)') ?></td>
            <td><input type="text" name="website" placeholder="<?php echo __('Enter text'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo __('Open url: (http://)') ?></td>
            <td><input type="text" name="openurl" placeholder="<?php echo __('Enter text'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo __('Country:') ?></td>
            <td>
                <select>
                    <option value="0"><?php echo __('All') ?></option>
                    <?php foreach ($countries as $country) { ?>
                    <option></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="Submit" value="<?php echo __('Add') ?>" /></td>
        </tr>
    </table>
    
    
</form>