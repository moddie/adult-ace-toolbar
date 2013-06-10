<div class="row">
    <div class="span4 offset4">
        <form method="post" >
            
            <legend><?php echo __('Admin login'); ?></legend>
            
            <div class="control-group">
                <label class="control-label" for="inputEmail"><?php echo __('Login') ?></label>
                <div class="controls">
                    <input type="text" name="username" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail"><?php echo __('Password') ?></label>
                <div class="controls">
                    <input type="password" name="password" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="Submit" value="<?php echo __('Login') ?>" class='btn btn-primary' />
                </div>
            </div>
        </form>
    </div>
</div>
