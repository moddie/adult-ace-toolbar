<?php if ( !$error ): ?>
<div class="container">
    <div class="content">
        <div>
            <span class="name"><?php echo $answer->name ?></span><br />
            <span class="country"><?php echo $answer->sys->country ?></span>
        </div>
        <hr />

        <img src="<?php echo URL::base(true, true) . 'images/weather/' . $answer->weather[0]->icon; ?>.png" />

        <div class="temp">
            <span class="current">Current</span><br />
            <span class="temp-main"><?php echo ( round($answer->main->temp - 273) ); ?>&deg;</span><br />
            <span class="gray"><span class="temp-small">hi: <?php echo ( round($answer->main->temp_max - 273) ); ?>&deg;</span></span> |
            <span class="gray"><span class="temp-small">lo: <?php echo ( round($answer->main->temp_min - 273) ); ?>&deg;</span></span><br />
        </div>
        <div class="clear"></div>
        <hr />
        <div>
            <span class="enchanced-title">Humidity: </span><span class="enchanced-data"><?php echo ( $answer->main->humidity ); ?>%</span><br />
            <span class="enchanced-title">Pressure: <span class="enchanced-data"><?php echo ( $answer->main->pressure ); ?></span>
        </div>
    </div>
</div>
<?php else: ?>
<div class="container">
    <div class="content">
        <div>
            <span class="name">Weather not found</span><br />

        </div>
    </div>
</div>
<?php endif; ?>