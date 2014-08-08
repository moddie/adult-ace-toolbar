<h2><?php echo __('Stats') ?></h2>
<form method="GET">
    <input type="text" name="dateFrom" placeholder="Date from" id="dateFrom" value="<?php echo Arr::get($_GET, 'dateFrom','')?>"/>
    <input type="text" name="dateTo" placeholder="Date to" id="dateTo" value="<?php echo Arr::get($_GET, 'dateTo','')?>"/><br/>
    <button type="submit" class="btn btn-success">Submit</button>
    <button type="button" data-from="<?php echo date('Y-m-d', strtotime('-1 week'));?>" data-to="<?php echo date('Y-m-d')?>"
            class="btn lastBtn">Last week</button>
    <button  data-from="<?php echo date('Y-m-d', strtotime('-1 month'));?>" data-to="<?php echo date('Y-m-d')?>"
             type="button"  class="btn lastBtn">Last month</button>
</form>


<table class="table table-hover table-striped ads">
    <thead>
        <tr>
            <th>
                <?php echo __('Country') ?>
                <?php if ($orderBy === 'country' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'country|asc', 
                                                                                 'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'country' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'country|desc', 
                                                                                  'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Chrome Qty') ?>
                <?php if ($orderBy === 'chrome' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'chrome|asc', 'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'chrome' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'chrome|desc','dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Firefox Qty') ?>
                <?php if ($orderBy === 'firefox' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'firefox|asc', 'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'firefox' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'firefox|desc','dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Internet Explorer Qty') ?>
                <?php if ($orderBy === 'ie' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'ie|asc', 'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'ie' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'ie|desc', 'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Unknown browser Qty') ?>
                <?php if ($orderBy === 'unknown' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'unknown|asc','dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'unknown' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'unknown|desc', 'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
            <th>
                <?php echo __('Total Qty') ?>
                <?php if ($orderBy === 'total' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'total|asc','dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'total' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'total|desc', 'dateFrom' => Arr::get($_GET, 'dateFrom',''),
                                                                                 'dateTo' => Arr::get($_GET, 'dateTo', ''))); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>
<!--            <th>
                <?php echo __('Date') ?>
                <?php if ($orderBy === 'date' && $orderDirection === 'asc'): ?>
                <strong>&UpArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'date|asc', 'date'=>Arr::get($_GET, 'date',''))); ?>">&UpArrow;</a>
                <?php endif; ?>

                <?php if ($orderBy === 'date' && $orderDirection === 'desc'): ?>
                <strong>&DownArrow;</strong>
                <?php else: ?>
                <a href="<?php echo Request::current()->url() . URL::query(array('order' => 'date|desc', 'date'=>Arr::get($_GET, 'date',''))); ?>">&DownArrow;</a>
                <?php endif; ?>
            </th>-->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stats as $stat): ?>
        <tr>
            <td><?php echo !empty($stat['countryName'])?$stat['countryName']: '<span class="muted ">unrecognized</span>' ?></td>
            <td><?php echo isset($stat['sum_amount_installs_chrome'])
                            ? number_format($stat['sum_amount_installs_chrome'])
                            : number_format($stat['amount_installs_chrome'])?>
            </td>
            <td><?php echo isset($stat['sum_amount_installs_firefox'])
                            ? number_format($stat['sum_amount_installs_firefox'])
                            : number_format($stat['amount_installs_firefox'])?>
            </td>
            <td><?php echo isset($stat['sum_amount_installs_ie'])
                            ? number_format($stat['sum_amount_installs_ie'])
                            : number_format($stat['amount_installs_ie'])?>
            </td>
            <td><?php echo isset($stat['sum_amount_installs_unknown'])
                            ? number_format($stat['sum_amount_installs_unknown'])
                            : number_format($stat['amount_installs_unknown'])?>
            </td>
            <td><?php echo number_format($stat['sum_amount_total']);?></td>
    
            <!--<td><?php echo $stat['date'];?></td>-->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form id='move' name='move_position' method="post" action=''></form>

<?php echo $pagination ?>
<script type="text/javascript">
jQuery(document).ready(function(){
    $('#dateFrom, #dateTo').datepicker({format:'yyyy-mm-dd', autoclose:true});
    $('.lastBtn').on('click', function(){
        $('#dateFrom').val($(this).data('from'));
        $('#dateTo').val($(this).data('to'));
    });
});



</script>