<h2><?php echo __('Edit Campaign') ?></h2>
<form>
<div class="row">
    <div class="span12">
        <table>
            <tbody>
                <tr>
                    <td><label for="c_name">Campaign name: </label> </td>
                    <td>
                        <input type="text" name="c_name" id="c_name" value="<?php echo $campaign->name; ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="limit">Clicks limit per 24hrs.: </label> </td>
                    <td>
                        <input type="text" name="limit" id="limit" value="<?php echo $campaign->click_limit; ?>">
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<hr />
<div class="row">
    <div class="span6">
        Websites:
        <div class="sites-container">
            <?php foreach ($campaign->patterns->find_all() as $pattern): ?>
            <div>
                <input type="text" name="sites[]" value="<?php echo $pattern->pattern; ?>">
                <a class="btn btn-danger delete-btn">
                    <i class="icon-remove icon-white"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <a class="btn btn-primary add-btn"><i class="icon-plus icon-white"></i> Add </a>
        <a class="btn btn-primary"><i class="icon-upload icon-white"></i> Import from CSV </a>
    </div>
    <div class="span6">
        Ad urls:
        <div class="urls-container">
            <?php foreach ($campaign->ad_urls->order_by('position', 'asc')->find_all() as $adUrl): ?>
            <div>
                <input type="text" name="urls[]" value="<?php echo $adUrl->target_url; ?>">
                <a class="btn btn-danger delete-btn">
                    <i class="icon-remove icon-white"></i>
                </a>
                <a class="dragger">
                    <i class="icon-resize-vertical"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <a class="btn btn-primary add-btn"><i class="icon-plus icon-white"></i> Add </a>
        <a class="btn btn-primary"><i class="icon-upload icon-white"></i> Import from CSV </a>
    </div>
</div>
<hr />
<div class="row">
    <div class="span12">
        <a class="btn btn-primary"><i class="icon-ok icon-white"></i> Save</a>
        <a class="btn btn-danger"><i class="icon-remove icon-white"></i> Cancel</a>
    </div>
</div>
</form>
<script>
    jQuery(document).ready(function(){
        jQuery(".urls-container").sortable();
                
        jQuery('body').on('click','.delete-btn',function(){
            jQuery(this).parent().remove();
        });
        
        jQuery('body').on('click','.delete-btn',function(){
            jQuery(this).parent().remove();
        });
        
        jQuery(".sites-container").parent().find('.add-btn').on('click',function(){
            jQuery(".sites-container").append('<div><input type="text" name="sites[]"> <a class="btn btn-danger delete-btn"><i class="icon-remove icon-white"></i></a></div>');
        });
        
        jQuery(".urls-container").parent().find('.add-btn').on('click',function(){
            jQuery(".urls-container").append('<div><input type="text" name="urls[]"> <a class="btn btn-danger delete-btn"><i class="icon-remove icon-white"></i></a> <a class="dragger"><i class="icon-resize-vertical"></i></a></div>');
        });

    });
</script>