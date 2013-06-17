<h2><?php echo __('Ads') ?></h2>
<div class="row">
    <div class="span4">
        <form method="post">
            <legend><?php echo __('Add ads'); ?></legend>

            <?php if (isset($messages['add'])) { ?>
                <div class="alert alert-success"><?php echo $messages['add'] ?></div>
            <?php } ?>
            <div class="control-group <?php if (isset($errors['website'])) echo 'error'; ?>">
                <label class="control-label" for="website"><?php echo __('Website: (http://)') ?></label>
                <div class="controls">
                    <input type="text" name="website" class="new_ad" id="website" placeholder="<?php echo __('Enter text'); ?>" value="<?php echo $new_add->website ?>" />
                    <div class="help-inline"><?php if (isset($errors['website'])) echo $errors['website']; ?></div>
                </div>
            </div>
            <div class="control-group <?php if (isset($errors['open_url'])) echo 'error'; ?>">
                <label class="control-label" for="open_url"><?php echo __('Open url: (http://)') ?></label>
                <div class="controls">
                    <input type="text" name="open_url" class="new_ad" id="open_url" placeholder="<?php echo __('Enter text'); ?>" value="<?php echo $new_add->open_url ?>" />
                    <div class="help-inline"><?php if (isset($errors['open_url'])) echo $errors['open_url']; ?></div>
                </div>
            </div>
            <div class="control-group <?php if (isset($errors['id_country'])) echo 'error'; ?>">
                <label class="control-label" for="id_country" ><?php echo __('Country:') ?></label>
                <div class="controls">
                    <select name="id_country" class="new_ad" id="id_country">
                        <option value="0"><?php echo __('All') ?></option>
                        <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->id_country ?>" <?php if ($new_add->id_country == $country->id_country) echo 'selected="selected"' ?>><?php echo $country->name_en ?></option>
                        <?php } ?>
                    </select>
                    <div class="help-inline"><?php if (isset($errors['id_country'])) echo $errors['id_country']; ?></div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input id="add_ad" type="Submit" value="<?php echo __('Add') ?>" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <div class="span4 offset2">
        <form method="post">
            <legend><?php echo __('Add settings'); ?></legend>

            <?php if (isset($messages['settings'])) { ?>
                <div class="alert alert-success"><?php echo $messages['settings'] ?></div>
            <?php } ?>
            <?php foreach ($settings as $setting) { ?>
            <div class="control-group">
                <label class="control-label" for="inputEmail"><?php echo __(ucfirst($setting->name)) ?></label>
                <div class="controls">
                    <input type="text" name="<?php echo $setting->name ?>" value="<?php echo $setting->value ?>" class='settings' />
                    <div><?php if (isset($errors[$setting->name])) echo $errors[$setting->name]; ?></div>
                </div>
            </div>
            <?php } ?>
            <div class="control-group">
                <div class="controls">
                    <input id='change_settings' type="Submit" value="<?php echo __('Change') ?>" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
</div>

<br/>

<form method="get">
    <legend><?php echo __('Ads'); ?></legend>
    
    <div class="control-group">
        <label class="control-label" for="inputEmail"><?php echo __('Website') ?></label>
        <div class="controls">
            <select name="filter_website" id="filter_website">
                <option value=""><?php echo __('All') ?></option>
                <?php foreach ($websites as $site) { ?>
                <option value="<?php echo $site->website ?>" <?php if ($site->website == $website) echo 'selected="selected"';?> ><?php echo $site->website ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</form>

<?php if (isset($messages['delete'])) { ?>
    <div class="alert alert-success"><?php echo $messages['delete'] ?></div>
<?php } ?>

<form method="post" id='ads' action='<?php echo URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'Ads', 'action' => 'Delete')) ?>?website=<?php echo urlencode($website) ?>'>
    <table class="table table-hover ads">
        <tr>
            <th><input class="checkall" type="checkbox" /></th>
            <th><?php echo __('Website') ?></th>
            <th><?php echo __('Open URL') ?></th>
            <th><?php echo __('Country') ?></th>
            <?php if ($website) { ?>
            <th><?php echo __('Position') ?></th>
            <?php } ?>
        </tr>
        <?php foreach ($ads as $ad) { ?>
        <tr>
            <td><input type="checkbox" value="<?php echo $ad->id_ad ?>" name="ids[]" /></td>
            <td><?php echo $ad->website ?></td>
            <td><?php echo $ad->open_url ?></td>
            <td><?php echo $ad->countries->name_en ? $ad->countries->name_en : __('All') ?></td>
            <?php if ($website) { ?>
            <td>
                <button class="move_position btn" value="UP" data-id="<?php echo $ad->id_ad ?>" data-dir="up" ><i class='icon-arrow-up icon-align-center'></i></button>
                <button class="move_position btn" value="DOWN" data-id="<?php echo $ad->id_ad ?>" data-dir="down" ><i class='icon-arrow-down icon-align-center'></i></button>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
    <button id="delete" class="btn btn-danger disabled"><?php echo __('Delete') ?></button>
</form>

<form id='move' name='move_position' method="post" action=''></form>

<div id='delete_ads' class="modal hide fade">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3><?php echo __('Are you sure?') ?></h3>
    </div>
    <div class="modal-body">
    <p><?php echo __('Are you sure to delete?') ?></p>
    </div>
    <div class="modal-footer">
    <a href="#" class="btn btn-primary" id='close_delete_ads' ><?php echo __('No') ?></a>
    <a href="#" class="btn btn-primary" id='confirm_delete_ads'><?php echo __('Yes') ?></a>
    </div>
</div>

<?php echo $pagination ?>
<script>
    $(document).ready(function(){
       
        $(':checkbox').prop('checked', 0);
       
        $('input').on('click', function(){
            
            if ($(this).hasClass('disabled'))
            {
                return false;
            }            
        });
       
        $('#filter_website').change(function(){
            $(this).closest('form').submit(); 
        });
       
        $('.move_position').click(function(){
        
            var dir = $(this).data('dir');
            var id = $(this).data('id');
           
            $('#move').attr('action', "<?php echo URL::base(TRUE, TRUE) . Route::get('admin')->uri(array('controller' => 'ads', 'action' => 'move')) ?>?website=<?php echo urlencode($website) ?>&page=<?php echo $page ?>&id="+id+"&direction="+dir);
            $('#move').submit(); 
            
            return false;
        });
       
        $('#delete').click(function(){
            
            $('#delete_ads').modal();
            return false;
        });
        
        $('.checkall').on('click', function () {
            $(this).closest('table').find(':checkbox').prop('checked', this.checked);
        });
        
        $('.ads :checkbox').on('click', function () {
            if ($(this).closest('table').find(':checkbox:checked').length)
            {
                $('#delete').removeClass('disabled');
            }
            else
            {
                $('#delete').addClass('disabled');
            }
        });
        
        $('#close_delete_ads').on('click', function(){
            $('#delete_ads').modal('hide');
        });
        
        $('#confirm_delete_ads').on('click', function(){
            $('#ads').submit();
        });
        
        $('.settings').on('focus',function(){
            $('#add_ad').addClass('disabled');
        });
        
        $('.settings').on('blur',function(){
            $('#add_ad').removeClass('disabled');
        });
        
        $('.new_ad').on('focus',function(){
            $('#change_settings').addClass('disabled');
        });
        
        $('.new_ad').on('blur',function(){
            $('#change_settings').removeClass('disabled');
        });
                
       
    });
</script>

