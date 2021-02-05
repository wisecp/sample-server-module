<?php
    $LANG           = $module->lang;
    $established    = false;
    $options        = $order["options"];
    $creation_info  = isset($options["creation_info"]) ? $options["creation_info"] : [];
    $config         = isset($options["config"]) ? $options["config"] : [];
    if($config && isset($config[$module->entity_id_name])) $established = true;
    $buttons        =  $module->adminArea_buttons_output();

?>

<?php
    if($buttons){
        ?>
        <div class="formcon">
            <?php echo $buttons; ?>
        </div>
        <div class="clear"></div>
        <?php
    }
?>
    <div class="clear"></div>

    <div class="formcon">
        <div class="yuzde30"><?php echo $module->entity_id_name; ?></div>
        <div class="yuzde70">
            <input class="yuzde10" type="text" name="config[<?php echo $module->entity_id_name; ?>]" value="<?php echo isset($config[$module->entity_id_name]) ? $config[$module->entity_id_name] : ''; ?>">
        </div>
    </div>

    <div class="formcon">
        <div class="yuzde30"><?php echo $LANG["change-password"]; ?></div>
        <div class="yuzde70">
            <input class="yuzde20" type="text" name="creation_info[new_password]" value="">
        </div>
    </div>


    <?php
        if(method_exists($module,"adminArea_service_fields") && $config_options = $module->adminArea_service_fields())
            $module->config_options_output($config_options,'creation_info');
    ?>

    <?php
        if(method_exists($module,"config_options") && $config_options = $module->config_options($creation_info))
            $module->config_options_output($config_options,'creation_info');
    ?>
