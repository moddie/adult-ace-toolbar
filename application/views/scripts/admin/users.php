<h2><?php echo __('Users') ?></h2>
<div class="row space">
    <div class="span12 ">        
        <a class="btn btn-danger remove-btn"><i class="icon-remove icon-white"></i> Delete selected</a>
    </div>
    <div class="span12 block-user">        
        <a class="btn btn-primary block-btn"> Block user</a>
        <a class="btn btn-primary unblock-btn"><i class="icon-remove icon-white"></i> Unblock user</a>
    </div>
</div>
<div class="row space">
    <div class="span12">
        <form id="delete-form" method="POST">
            <table class="table table-striped table-hover" id="user-table">
                <thead>
                    <tr>
                        <th class="span1 text-center"><input type="checkbox" /></th>
                        <th>Name</th>
                        <th class="span4">Email</th>
                        <th class="span4">Status</th>
                        <th class="span2">Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($users as $user){
                    ?>
                        <tr id="user_<?php echo $user->id; ?>">
                            <td class="text-center"><input type="checkbox" name="delete[<?php echo $user->id; ?>]"  /></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->status; ?></td>
                            <td><?php echo $user->created; ?></td>
                            <td class="text-center"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<?php echo $pagination; ?>

<br/>

<?php if (isset($messages['delete'])) { ?>
    <div class="alert alert-success"><?php echo $messages['delete'] ?></div>
<?php } ?>
<script>
    jQuery(document).ready(function(){
        jQuery('.selectpicker').selectpicker();
        
        jQuery(function(){
            jQuery('.edit-btn').each(function(){
                var _self = jQuery(this);
                    tr = _self.closest('tr');
                    td = _self.closest('td');
                td.css({'height': (_self.height()+10)+'px'});
                _self.hide();
                tr.on('mouseover',function(){
                    _self.show();
                });
                tr.on('mouseout',function(){
                    _self.hide();
                });
            });    
        });
        
        var checkboxes = jQuery('td input[type=checkbox]'),
            disabling = function(){
                if (checkboxes.filter(':checked').length === 0){
                    jQuery('.remove-btn').addClass('disabled');
                    jQuery('.block-btn').addClass('disabled');
                    jQuery('.unblock-btn').addClass('disabled');
                }
                else {
                    jQuery('.remove-btn').removeClass('disabled');
                    jQuery('.block-btn').removeClass('disabled');
                    jQuery('.unblock-btn').removeClass('disabled');
                }                
            };
        checkboxes.on('change',function(){
            disabling();
        });
        
        jQuery(function(){
            jQuery('th input[type=checkbox]').on('change',function(){
                if (jQuery(this).is(':checked')){
                    checkboxes.prop('checked',true);
                }
                else{
                    checkboxes.prop('checked',false);
                }
                disabling();
            });
        });
        disabling();        
        
        jQuery('.remove-btn').on('click', function(){
            if ( !jQuery(this).is('.disabled')) {
                jQuery('#delete-form').submit();
            }
        });
        
        jQuery('.block-btn').on('click', function(){
            if ( !jQuery(this).is('.disabled')) {
                jQuery.ajax({
                    url:'/admin/Json/user_block/',                    
                    dataType:'html',
                    data:{
                        id: <?php echo $user->id; ?>,
                        action: 'block',
                    },
                    success: function(response){
                        console.log(response);                        
                        jQuery('#user-table #user_<?php echo $user->id; ?>').html(response);
                    }
                });
            }
        });
        
        jQuery('.unblock-btn').on('click', function(){
            if ( !jQuery(this).is('.disabled')) {
                jQuery.ajax({
                    url:'/admin/Json/user_block/',                    
                    dataType:'html',
                    data:{
                        id: <?php echo $user->id; ?>,
                        action: 'unblock',
                    },
                    success: function(response){
                        console.log(response);
                        jQuery('#user-table #user_<?php echo $user->id; ?>').html(response);
                    }
                });
            }
        });
        
    });
</script>