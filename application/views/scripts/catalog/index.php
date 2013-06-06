<?php

foreach ($firms as $firm)
{
?>
<a href="<?php echo URL::base(true) . Route::get('catalog')->uri(array('firm' => $firm->name)) ?>" ><?php echo $firm->name ?></a>
<?php
}
?>