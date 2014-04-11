<h2><?php 

echo __($action . ' Campaign') 

?></h2>
<?php

if(!empty($errors))
{
    echo '<div class="alert alert-error">';
    foreach($errors as $error):
        print_r($error);
    endforeach;
    echo '</div>';
}

?>
<form method="post" id="campaign-edit-form" enctype="multipart/form-data">
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
                <tr>
                    <td><label for="limit">Country: </label> </td>
                    <td>
                        <select name="country" id="country" >
                            <option value="0" <?php echo (($action == 'edit')?'selected="selected"':''); ?> >All</option>
                            <?php
                            foreach ($countries as $country)
                            {
                                echo '<option value="' . $country->id_country . '" ' . (($campaign->id_country == $country->id_country)?'selected="selected"':'') . ' >' . $country->name_en . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="limit">Keyword: </label> </td>
                    <td>
                        <input type="text" name="keyword" id="keyword" value="<?php echo $campaign->keyword; ?>">
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<hr />
<div class="row">
    <div class="span6">
        Website patterns:
        <div class="sites-container">
            <?php
            $patterns = $campaign->patterns->order_by('id', 'asc')->find_all();
            if (count($patterns) > 0)
            {
                foreach ($patterns as $pattern): ?>
                <div>
                    <input type="text" name="patterns[]" value="<?php echo $pattern->pattern; ?>">
                    <a class="btn btn-danger delete-btn">
                        <i class="icon-remove icon-white"></i>
                    </a>
                </div>
            <?php
                endforeach;
            }
            else
            { ?>
                <div>
                    <input type="text" name="patterns[]" value="">
                    <a class="btn btn-danger delete-btn">
                        <i class="icon-remove icon-white"></i>
                    </a>
                </div>
            <?php }?>
        </div>
        <a class="btn btn-primary add-btn"><i class="icon-plus icon-white"></i> Add </a>
        <a class="btn btn-primary csv-btn"><i class="icon-upload icon-white"></i> Import from CSV </a>
        <input type="file" name="csv_patterns" />
        <div class="info"></div>
    </div>
    <div class="span6">
        Ad urls:
        <div class="urls-container">
            <?php
            $ad_urls = $campaign->ad_urls->order_by('position', 'asc')->find_all();
            if (count($ad_urls) > 0)
            {
                foreach ($ad_urls as $adUrl):
                ?>
                <div>
                    <input type="text" name="urls[]" value="<?php echo $adUrl->target_url; ?>">
                    <a class="btn btn-danger delete-btn">
                        <i class="icon-remove icon-white"></i>
                    </a>
                    <a class="dragger">
                        <i class="icon-resize-vertical"></i>
                    </a>
                </div>
            <?php
                endforeach;
            }
            else
            {?>
                <div>
                    <input type="text" name="urls[]" value="http://">
                    <a class="btn btn-danger delete-btn">
                        <i class="icon-remove icon-white"></i>
                    </a>
                    <a class="dragger">
                        <i class="icon-resize-vertical"></i>
                    </a>
                </div>
            <?php }?>
        </div>
        <a class="btn btn-primary add-btn"><i class="icon-plus icon-white"></i> Add </a>
        <a class="btn btn-primary csv-btn"><i class="icon-upload icon-white"></i> Import from CSV </a>
        <input type="file" name="csv_adurls" />
        <div class="info"></div>
    </div>
</div>
<hr />
<div class="row">
    <div class="span12">
        <?php
            echo '<input type="hidden" name="id_campaign" value="' . $campaign->id_campaign . '">';
        ?>
        <a class="btn btn-primary" id="save-button"><i class="icon-ok icon-white"></i> Save</a>
        <a href="<?php echo URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'campaigns', 'action' => 'index')); ?>" class="btn btn-danger" id="cancel-button"><i class="icon-remove icon-white"></i> Cancel</a>
    </div>
</div>
</form>
<script>
    jQuery(document).ready(function(){
        jQuery(".urls-container").sortable({ containment: "parent" });

        jQuery('#save-button').on('click', function(){
            jQuery('#campaign-edit-form').submit();
        });
               
        jQuery('body').on('click','.delete-btn',function(){
            jQuery(this).parent().remove();
        });

        jQuery('body').on('click','.delete-btn',function(){
            jQuery(this).parent().remove();
        });

        jQuery(".sites-container").parent().find('.add-btn').on('click',function(){
            jQuery(".sites-container").append('<div><input type="text" name="patterns[]"> <a class="btn btn-danger delete-btn"><i class="icon-remove icon-white"></i></a></div>');
        });

        jQuery(".urls-container").parent().find('.add-btn').on('click',function(){
            jQuery(".urls-container").append('<div><input type="text" name="urls[]" value="http://"> <a class="btn btn-danger delete-btn"><i class="icon-remove icon-white"></i></a> <a class="dragger"><i class="icon-resize-vertical"></i></a></div>');
        });
        
        jQuery(".csv-btn").each(function(){
            var _self = jQuery(this),
                fileinput = _self.parent().find('input[type=file]'),
                info = _self.parent().find('.info');
            fileinput.hide();
            _self.on('click',function(){
                fileinput.click();
            });
            fileinput.on('change',function(){
                info.html('Selected file: ' + fileinput.val());
            });
        });
    });
</script>