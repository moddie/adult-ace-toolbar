<?php
$pagesCount = ceil($countAll / $perPage);
?>

<div class="pagination pagination-centered">
    <ul>
        <?php if ( $page > 1 ): ?>
        <li><a class="prev js-pagination" href="javascript:void(0);" data-id="prev">Previous</a></li>
        <?php endif; ?>

        <?php
        for ( $i = 1; $i <= $pagesCount; $i++ ):
            if ( abs($page - $i) < 5 ):
                ?>
                <li class="<?php echo ($i == $page) ? 'active' : '' ?>" ><a data-id="<?php echo $i ?>"
                   href="<?php echo URL::query(array('page' => $i)); ?>"><?php echo $i ?></a></li>
        <?php
            endif;
        endfor;
        ?>
        <?php if ( ($page >= 1) && ($page <= $pagesCount - 1) ): ?>
        <li><a class="next js-pagination" href="javascript:void(0);" data-id="next">Next</a></li>
        <?php endif; ?>
    </ul>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var page = '<?php echo $page ?>';
        var base = '<?php echo URL::base() ?>';
        var perpage = '<?php echo $perPage ?>';
<?php if ( $page > 1 ) { ?>
            jQuery('.prev').attr('href', '<?php echo URL::query(array('page' => ($page - 1))); ?>');
<?php } ?>
<?php if ( $page < $pagesCount ) { ?>
            jQuery('.next').attr('href', '<?php echo URL::query(array('page' => ($page + 1))); ?>');
<?php } ?>
    });
</script>