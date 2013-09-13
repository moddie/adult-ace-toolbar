<h2><?php echo __('Stats') ?></h2>

<table class="table table-hover table-striped ads">
    <thead>
        <tr>
            <th>
                <?php echo __('Country') ?>
                <?php if ($orderBy === 'country' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'country|asc')); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'country' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'country|desc')); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Chrome Qty') ?>
                <?php if ($orderBy === 'chrome' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'chrome|asc')); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'chrome' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'chrome|desc')); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Firefox Qty') ?>
                <?php if ($orderBy === 'firefox' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'firefox|asc')); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'firefox' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'firefox|desc')); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Internet Explorer Qty') ?>
                <?php if ($orderBy === 'ie' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'ie|asc')); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'ie' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'ie|desc')); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Unknown browser Qty') ?>
                <?php if ($orderBy === 'unknown' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'unknown|asc')); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'unknown' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'unknown|desc')); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Total Qty') ?>
                <?php if ($orderBy === 'total' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'total|asc')); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'total' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'total|desc')); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stats as $stat): ?>
        <tr>
            <td><?php echo (!empty($stat->country->name_en)) ? $stat->country->name_en : '<span class="muted ">unrecognized</span>' ?></td>
            <td><?php echo number_format($stat->amount_installs_chrome) ?></td>
            <td><?php echo number_format($stat->amount_installs_firefox) ?></td>
            <td><?php echo number_format($stat->amount_installs_ie) ?></td>
            <td><?php echo number_format($stat->amount_installs_unknown) ?></td>
            <td><?php echo number_format(
                $stat->amount_installs_chrome
                + $stat->amount_installs_firefox
                + $stat->amount_installs_ie
                + $stat->amount_installs_unknown
            ) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form id='move' name='move_position' method="post" action=''></form>

<?php echo $pagination ?>