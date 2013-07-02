<h2><?php echo __('Campaigns') ?></h2>
<!--<pre>
<?php print_r($campaigns); ?>
</pre>-->
<div class="row space">
    <div class="span12 ">
        <a href="<?php echo URL::base() . 'admin/campaigns/add';?>" class="btn btn-primary add-btn"><i class="icon-plus icon-white"></i> Add</a>
        <a class="btn btn-danger remove-btn"><i class="icon-remove icon-white"></i> Delete selected</a>
        
        <span class="pull-right">
            Filter by country: 
            <select name="filter" class="selectpicker">
                <option value="0" <?php echo (($filter == 0) ? 'selected="selected"' : ''); ?> >All</option>
                <?php
                foreach ($countries as $country) {
                    echo '<option value="' . $country->id_country . '" ' . (($filter == $country->id_country)?'selected="selected"':'') . ' >' . $country->name_en . '</option>';
                }
                ?>
            </select>
        </span>
        
    </div>
    
</div>
<div class="row space">
    <div class="span12">
        <form id="delete-form" method="POST">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="span1 text-center"><input type="checkbox" /></th>
                        <th>Name</th>
                        <th class="span4">Country</th>
                        <th class="span2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($campaigns as $campaign){
                    ?>

                    <tr>
                        <td class="text-center"><input type="checkbox" name="delete[<?php echo $campaign->id_campaign; ?>]"  /></td>
                        <td><?php echo $campaign->name; ?></td>
                        <td><?php echo (($campaign->id_country === '0') ? 'All' : $campaign->country->name_en); ?></td>
                        <td class="text-center"><a class="btn btn-primary edit-btn" href="<?php echo URL::base() . 'admin/campaigns/edit?id_campaign=' . $campaign->id_campaign; ?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
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
                    _self.stop(true,true).fadeIn();
                });
                tr.on('mouseout',function(){
                    _self.stop(true,true).fadeOut();
                });
            });    
        });
        
        var checkboxes = jQuery('td input[type=checkbox]'),
            disabling = function(){
                if (checkboxes.filter(':checked').length === 0){
                    jQuery('.remove-btn').addClass('disabled');
                }
                else {
                    jQuery('.remove-btn').removeClass('disabled');
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
        
        jQuery('select[name=filter]').on('change', function(){
            var href = location.href.replace(/^(.*?)\?.*$/,'$1');
            location.href = href + '?page=<?php echo $page; ?>&filter=' + jQuery(this).find('option:selected').val();
            //alert(href);
        });
        
        jQuery('.remove-btn').on('click', function(){
            if ( !jQuery(this).is('.disabled')) {
                jQuery('#delete-form').submit();
            }
        });
        
    });
</script>








