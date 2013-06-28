<h2><?php echo __('Campaigns') ?></h2>
<div class="row space">
    <div class="span12 ">
        <a class="btn btn-primary"><i class="icon-plus icon-white"></i> Add</a>
        <a class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete selected</a>
        
        <span class="pull-right">
            Filter by country: 
            <select class="selectpicker">
                <option>All</option>
            </select>
        </span>
        
    </div>
    
</div>
<div class="row space">
    <div class="span12">
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
                    <td class="text-center"><a class="btn btn-primary edit-btn" href="<?php echo ''; ?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
                </tr>
                <?php
                }
                ?>
                
            </tbody>
        </table>
    </div>
</div>

<br/>

<?php if (isset($messages['delete'])) { ?>
    <div class="alert alert-success"><?php echo $messages['delete'] ?></div>
<?php } ?>
<script>
    jQuery(document).ready(function(){
        jQuery('.selectpicker').selectpicker();
        
        jQuery('body').on('load','.edit-btn',function(){
            var _self = jQuery(this),
                tr = _self.closest('tr');
            _self.hide();
            tr.on('mouseover',function(){
                _self.fadeIn();
            });
            tr.on('mouseout',function(){
                _self.fadeOut();
            });
        });
        
    });
</script>








