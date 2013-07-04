<h2><?php echo __('Stats') ?></h2>

<table class="table table-hover table-striped ads">
    <thead>
        <tr>
            <th><?php echo __('Country') ?></th>
            <th><?php echo __('Amount of users') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stats as $stat) { ?>
        <tr>
            <td><?php echo (!empty($stat->country->name_en)) ? $stat->country->name_en : '<span class="muted ">unrecognized</span>' ?></td>
            <td><?php echo number_format($stat->amount_users) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<form id='move' name='move_position' method="post" action=''></form>

<?php echo $pagination ?>