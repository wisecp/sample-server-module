<br>
<br>
<?php
    $limit          = 25;
    $used           = 2;
    $percent        = Utility::getPercent($used,$limit);
    if($percent > 100) $percent = 100;

?>
<div style="margin-bottom:20px;display:inline-block;text-align: center;">
    <h5 style="font-size:16px;"><strong>HDD</strong></h5>
    <div class="clear"></div>
    <div class="progress-circle progress-<?php echo $percent; ?>"><span><?php echo $percent; ?></span></div>
    <div class="clear"></div>
    <h5 style="font-size:16px;"><?php echo $used; ?> GB / <?php echo $limit; ?> GB</h5>
</div>

<?php
    $limit          = 2048;
    $used           = 512;
    $percent        = Utility::getPercent($used,$limit);
    if($percent > 100) $percent = 100;

?>
<div style="margin-bottom:20px;display:inline-block;text-align: center;">
    <h5 style="font-size:16px;"><strong>RAM</strong></h5>
    <div class="clear"></div>
    <div class="progress-circle progress-<?php echo $percent; ?>"><span><?php echo $percent; ?></span></div>
    <div class="clear"></div>
    <h5 style="font-size:16px;"><?php echo $used; ?> MB / <?php echo $limit; ?> MB</h5>
</div>

<?php
    $limit          = 1000;
    $used           = 802;
    $percent        = Utility::getPercent($used,$limit);
    if($percent > 100) $percent = 100;

?>
<div style="margin-bottom:20px;display:inline-block;text-align: center;">
    <h5 style="font-size:16px;"><strong>CPU</strong></h5>
    <div class="clear"></div>
    <div class="progress-circle progress-<?php echo $percent; ?>"><span><?php echo $percent; ?></span></div>
    <div class="clear"></div>
    <h5 style="font-size:16px;"><?php echo $used; ?> Mhz / <?php echo $limit; ?> Mhz</h5>
</div>

<br><br>
This is the module's home content...