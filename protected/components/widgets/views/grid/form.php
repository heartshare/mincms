<blockquote><h3>

<?php echo $name;?>
<label class='label label-info' style='margin-left:10px;'>	
<?php if($id>0){?>
	<?php echo t('admin','Update');?>
<?php }else{?>
	<?php echo t('admin','Create');?>
<?php }?>
</label>		
</h3></blockquote>
<?php 
$form = new FormBuilder($builder,$id);  
$form->run();
?>