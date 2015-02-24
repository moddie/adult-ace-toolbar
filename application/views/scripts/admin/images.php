<h2><?php echo __('Users') ?></h2>
<div class="row space">
    <div class="span12 ">                
        <a class="btn btn-success" href="/admin/images/add"><i class="icon-ok icon-white"></i> Add image</a>        
        <a class="btn btn-danger remove-btn"><i class="icon-remove icon-white"></i> Delete selected</a>        
    </div>    
</div>
<div class="row space">
    <div class="span12">
        <form id="delete-form" method="POST">
            <table class="table table-striped table-hover" id="user-table">
                <thead>
                    <tr>
                        <th class="span1 text-center"><input type="checkbox" /></th>                        
                        <th class="span1">Current</th>
                        <th class="span4">Title</th>
                        <th class="span4">File</th>
                        
                        <th class="span4">Status</th>
                        <th class="span4">Last time</th>
                        <th class="span4">Creation time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($images as $img){
                    ?>
                        <tr id="user_<?php echo $img->id; ?>">
                            <td class="text-center"><input type="checkbox" name="delete[<?php echo $img->id; ?>]" imgid="<?php echo $img->id; ?>" /></td>
                             <td><?php 
                                    if ($img->current) {
                                        echo '<i class="icon-ok icon-black">';
                                    }                                    
                                ?></td>
                            <td><?php echo $img->title; ?></td>
                            <td><?php echo $img->file; ?></td>
                           
                            <td><?php echo $img->status; ?></td>
                            <td><?php 
                                    if (strlen(strval($img->last_time)) == 10) {
                                        echo date("Y-m-d H:i:s", $img->last_time); 
                                    }
                                    else {
                                        echo '-';   
                                    } 
                                ?></td>
                            <td><?php 
                                    if (strlen(strval($img->created_time)) == 10) {
                                        echo date("Y-m-d H:i:s", $img->created_time); 
                                    }
                                    else {
                                        echo '-';   
                                    } 
                                ?></td>
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
                    jQuery('.activate-btn').addClass('disabled');
                }
                else {
                    jQuery('.remove-btn').removeClass('disabled');
                    jQuery('.block-btn').removeClass('disabled');
                    jQuery('.activate-btn').removeClass('disabled');
                }                
            };
        jQuery('td input[type=checkbox]').on('change',function(){
            console.log(this);
            disabling();
        });
        
        jQuery(function(){
            jQuery('th input[type=checkbox]').on('change',function(){
                if (jQuery(this).is(':checked')){
                    jQuery('td input[type=checkbox]').prop('checked',true);
                }
                else{
                    jQuery('td input[type=checkbox]').prop('checked',false);
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
            jQuery('td input[type=checkbox]').each(function(){                
                var userid = jQuery(this).attr('userid');
                if (jQuery(this).is(':checked')) {                    
                    jQuery.ajax({
                        url:'/admin/Json/user_block/',                    
                        dataType:'html',
                        data:{
                            id: userid,
                            action: 'block',
                        },
                        success: function(response){
                            //console.log(response);                            
                            jQuery('#user-table #user_'+userid).html(response);
                        }
                    });
                }    
            });
        });
        
        jQuery('.activate-btn').on('click', function(){
            jQuery('td input[type=checkbox]').each(function(){
                var userid = jQuery(this).attr('userid');                
                if (jQuery(this).is(':checked')) {
                    jQuery.ajax({
                        url:'/admin/Json/user_block/',                    
                        dataType:'html',
                        data:{
                            id: userid,
                            action: 'activate',
                        },
                        success: function(response){
                            //console.log(response);
                            jQuery('#user-table #user_'+userid).html(response);
                        }
                    });
                }
            });
        });        
        
    });
</script>