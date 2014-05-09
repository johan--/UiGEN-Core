<?php

	require_once("../../../../../wp-load.php");
	require_once ABSPATH . 'wp-content/plugins/UiGEN-Core/class/Spyc.php';
	$formList = Spyc::YAMLLoad(ABSPATH . 'wp-content/plugins/UiGEN-Core/global-data/template-hierarchy/schemas/form-list.yaml');
	
	foreach ($formList as $key => $value) {
		
		global $SPD;
		$SPD -> type = $key;
		$SPD -> name = $key;
		$SPD -> label = $value['debug_label'];
		get_template_part('theme-template-parts/forms/form',$key);

	}

?>
<script>
jQuery(document).on('click', "button.back-slots-mode", function() {
		jQuery('#debug-manager').children().remove();
		jQuery(this).parent().parent().removeClass('slot-fade');
		jQuery(this).parent().parent().find('.btn-group').css('display','block');
		jQuery(this).remove();
});
</script>