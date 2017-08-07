	<?php 
	$EgoiMailListBuilderWooCommerce = get_option('EgoiMailListBuilderWooCommerceObject'); 
	$allDone = 0;
	?>
	<div class='wrap'>
	<div id="icon-egoi-mail-list-builder-woocommerce-import" class="icon32"></div>
	<h2>Import</h2>
	<?php require('donate.php'); ?>
	<?php if($EgoiMailListBuilderWooCommerce->isAuthed() && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ))	{
		if(isset($_POST['egoi_mail_list_builder_woocommerce_do_import'])) {
			$blogusers = get_users();
			$EgoiMailListBuilderWooCommerce = get_option('EgoiMailListBuilderWooCommerceObject');
			if($_POST['egoi_mail_list_builder_woocommerce_import_list'] != -1){
			    foreach ($blogusers as $user) {
			    	$result = $EgoiMailListBuilderWooCommerce->addSubscriber(
						$_POST['egoi_mail_list_builder_woocommerce_import_list'],
						$user->display_name,
						'',
						$user->user_email
					);
			    }
			    $allDone = 1;
			}
		    else{
		    	$allDone = -1;
		    }
		}
		$result = $EgoiMailListBuilderWooCommerce->getLists();
		egoi_mail_list_builder_woocommerce_admin_notices();
	?>
	<h3>Import</h3>
	<form name='egoi_mail_list_builder_woocommerce_import_form' method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
	<table class="form-table">
		<tr>
			<th>
				<label for="egoi_mail_list_builder_woocommerce_import_list">Mailing list</label>
			</th>
			<td>
				<select name='egoi_mail_list_builder_woocommerce_import_list'>
					<option value="-1" selected>Select a List</option>
					<?php
					for($x = 0;$x < count($result); $x++) {	?>
						<option value='<?php echo $result[$x]['listnum']; ?>'><?php echo $result[$x]['title']; ?></option>
					<?php }	?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_woocommerce_import_label">Import registered users!</label>
			</th>
			<td>
				<input type='submit' class='button-primary' size='60' name='egoi_mail_list_builder_woocommerce_do_import' value='Import'/>
			</td>
		</tr>
	</table>
	<?php if($allDone == 1){ ?>
	<h4>All Done!</h4>
	<?php }else if($allDone == -1){ ?>
	<h4>Please select a list!</h4>
	<?php }?>
	</form>
	<?php }	?>