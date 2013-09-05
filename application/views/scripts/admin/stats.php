<h2><?php echo __('Stats') ?></h2>

<table class="table table-hover table-striped ads">
    <thead>
        <tr>
            <th><?php echo __('Country') ?></th>
            <th><?php echo __('Installations Qty') ?></th>
            <th><?php echo __('Uninstallations Qty') ?></th>
            <th><?php echo __('Amount users') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stats as $stat): ?>
        <tr>
            <td><?php echo (!empty($stat->country->name_en)) ? $stat->country->name_en : '<span class="muted ">unrecognized</span>' ?></td>
            <td><?php echo number_format($stat->amount_installs) ?></td>
            <td><?php echo number_format($stat->amount_uninstalls) ?></td>
            <td><?php echo number_format($stat->amount_installs - $stat->amount_uninstalls) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form id='move' name='move_position' method="post" action=''></form>

<?php echo $pagination ?>