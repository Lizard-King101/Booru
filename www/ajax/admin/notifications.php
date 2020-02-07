<?php $pages = ["home", "upload", "search", "account"]?>
<div class="row">
	<div class="col-sm-12">
		<div class="basic-box">
			<div class="basic-box-head">
				<input id="new_head" type="text" placeholder="New Page Notification">
				<select id="new_page" name="page">
					<option value="">Display On Page</option>
					<?php foreach($pages as $p){?>
					<option value="<?php echo $p; ?>"><?php echo ucwords($p); ?></option>
					<?php } ?>
				</select>
				<a data-id="main" class="button head save">Save</a>
			</div>
			<div class="basic-box-body edit">
				<textarea id="editor_main" class="editor"></textarea>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<?php 
	include "../db.php";
	$stmt = $pdo->query("SELECT * FROM `notifications`"); 
	$not = $stmt->fetchAll();
	
	foreach($not as $k=>$n){?>
		<div class="col-sm-12">
			<div class="basic-box">
				<div id="head_<?php echo $n['id'];?>" class="basic-box-head">
					<input data-id="<?php echo $n['id'];?>" data-option="head" type="text" onchange="updateOption(this)" value="<?php echo $n['head'];?>" placeholder="Header Text">
					<select data-id="<?php echo $n['id'];?>" data-option="page" name="page" onchange="updateOption(this)">
						<option value="">Display On Page</option>
						<?php foreach($pages as $p){?>
						<option value="<?php echo $p; ?>" <?=$n['page'] == $p ? ' selected="selected"' : '';?> ><?php echo ucwords($p); ?></option>
						<?php } ?>
					</select>
					<div class="button-box">
						<a data-id="<?php echo $n['id'];?>" class="button head edit">Edit</a>
					</div>
					<a data-id="<?php echo $n['id'];?>" class="button head delete" style="float: right; margin-left: 10px">Delete</a>
					<span class="active-label">
						<h3>Active</h3>
						<label class="switch">
						   <input data-id="<?php echo $n['id'];?>" data-option="active" type="checkbox" onchange="updateOption(this)" <?php echo $n['active'] == 1 ? "checked" : ""?>>
						   <span class="slider round"></span>
						</label>
					</span>
				</div>
				<div id="editor_<?php echo $n['id'];?>" class="basic-box-body">
					<?php echo html_entity_decode($n['content']);?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>