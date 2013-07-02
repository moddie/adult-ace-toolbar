<h2><?php echo __('Edit Campaign') ?></h2>
<form method="post" id="campaign-edit-form" enctype="multipart/form-data">
<div class="row">
    <div class="span12">
        <table>
            <tbody>
                <tr>
                    <td><label for="c_name">Campaign name: </label> </td>
                    <td>
                        <input type="text" name="c_name" id="c_name" value="<?php if ($action == 'edit')
                                                                                  {
                                                                                      echo $campaign->name;
                                                                                  } ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="limit">Clicks limit per 24hrs.: </label> </td>
                    <td>
                        <input type="text" name="limit" id="limit" value="<?php if ($action == 'edit')
                                                                                {
                                                                                    echo $campaign->click_limit;
                                                                                }  ?>">
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
                                if ($action == 'edit')
                                {
                                    echo '<option value="' . $country->id_country . '" ' . (($campaign->id_country == $country->id_country)?'selected="selected"':'') . ' >' . $country->name_en . '</option>';
                                }
                                else
                                {
                                    echo '<option value="' . $country->id_country . '" >' . $country->name_en . '</option>';
                                }
                            }
                            ?>
                        </select>
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
            <?php
            if ($action == 'edit')
            {
                foreach ($campaign->patterns->find_all() as $pattern): ?>
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
        <a class="btn btn-primary"><i class="icon-upload icon-white"></i> Import from CSV </a>
        <input type="file" name="csv_patterns" />
    </div>
    <div class="span6">
        Ad urls:
        <div class="urls-container">
            <?php
            if ($action == 'edit')
            {
                foreach ($campaign->ad_urls->order_by('position', 'asc')->find_all() as $adUrl):
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
                    <input type="text" name="urls[]" value="">
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
        <a class="btn btn-primary"><i class="icon-upload icon-white"></i> Import from CSV </a>
        <input type="file" name="csv_adurls" />
    </div>
</div>
<hr />
<div class="row">
    <div class="span12">
        <?php

        if ($action == 'edit')
        {
            echo '<input type="hidden" name="id_campaign" value="' . $campaign->id_campaign . '">';
        }
        ?>
        <a class="btn btn-primary save-btn"><i class="icon-ok icon-white"></i> Save</a>
        <a class="btn btn-danger"><i class="icon-remove icon-white"></i> Cancel</a>
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
            jQuery(".urls-container").append('<div><input type="text" name="urls[]"> <a class="btn btn-danger delete-btn"><i class="icon-remove icon-white"></i></a> <a class="dragger"><i class="icon-resize-vertical"></i></a></div>');
        });

        jQuery(".save-btn").on('click',function(){
            jQuery('#form').submit();
        });

    });
</script>