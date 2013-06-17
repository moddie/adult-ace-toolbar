<h2><?php echo __('Stats') ?></h2>

<form method="get">
    
    <div class="control-group">
        <label class="control-label" for="date"><?php echo __('Date') ?></label>
        <div class="controls">
            <input type="text" class="span2" name="date" id="date" value="<?php echo $date ?>" />
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button class="btn" type="button" id="reset_date"><?php echo __('Reset filter') ?></button>
        </div>
    </div>
</form>

<table class="table table-hover ads">
    <tr>
        <th><?php echo __('Date') ?></th>
        <th><?php echo __('Country') ?></th>
        <th><?php echo __('Amount of users') ?></th>
    </tr>
    <?php foreach ($stats as $stat) { ?>
    <tr>
        <td><?php echo $stat->date?></td>
        <td><?php echo $stat->country->name_en ?></td>
        <td><?php echo $stat->amount_users ?></td>
    </tr>
    <?php } ?>
</table>


<form id='move' name='move_position' method="post" action=''></form>

<?php echo $pagination ?>
<script>
    $(document).ready(function(){
       
        $( "#date" ).datepicker({ 
            dateFormat: 'mm/dd/yy',
        });
       
        $('#date').on('change', function(){
            $(this).closest('form').submit(); 
        });
        
        $('#reset_date').on('click',function(){
            $('#date').val('');
            $('#date').trigger('change');
        });
       
    });
</script>

