<blockquote><h3><?php echo $name;?></h3></blockquote>
<a href="<?php echo url($update,array('name'=>$name));?>">
	<label class='label'><?php echo t('admin','Create');?></label>
</a>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test', 
)); ?>
<?php 
SortHelper::ui('#test',url($url,array('name'=>$name)));
	
if(!$list){?>
	<div class='alert alert-error'>
		<?php echo t('admin','Not set display coumns');?>
	</div>
<?php }?>
<table class="table table-hover">
	<thead>
		<tr>
			<?php foreach($list as $k=>$v){?>
					<td><?php echo t('admin',ucfirst($k));?></td> 
			<?php }?>
					<td style='width:90px;'></td>
		</tr>
	</thead>
	<tbody>
	<?php 
	
	foreach($posts as $row){   
	$post = Node::find($name,$row['id']); 
	after($post,$name);	 
	if(!$list) continue;
	?> 
		<tr>
			<?php 
			$i=0;
			foreach($list as $k=>$v){
			$i++;
			?>
			<td>
			<?php if($i==1){?>
				<i class="drag"></i>
			<?php }?>
			<?php    
				$data = $post->$k;
			/**
			* 如果有插件，会调用插件目录下的overwrite.php after方法
			* 如 datepicker 插件 overwrite.php 代码
			* 类名必须全小写
			class overwrite_datepicker{ 
				function before($value){ 
					 return strtotime($value);
				}
				function after($value){ 
					 if($value)
					 	return date('Y-m-d H:i',$value); 
				}
			}
			*/
				if($plugins){
					foreach($plugins as $pk=>$pks){
						 if(in_array($k,$pks)){ 
						 	$af = plugin_after($pk,$data);
							if($af)
								$data = $af;
	 					}
					}
				}
				echo $data; ?></td>
			<?php }?>
			<td>
				<a href="<?php echo url($update,array('name'=>$name,'id'=>$post->id));?>">
					<img src="<?php echo base_url();?>/misc/img/edit.png" />
				</a>
				<input type='hidden' name='id[]' value="<?php echo $post->id;?>">
				&nbsp;
		 
				<a href="<?php echo url($delete,array('name'=>$name,'id'=>$post->id));?>">
				<?php if($post->display!=1){?>
	 				<img src="<?php echo base_url();?>/misc/img/ok.png" />
	 				<?php }else{?>
	 				<img src="<?php echo base_url();?>/misc/img/error.png" />
 				<?php }?>
						
				</a>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php $this->endWidget(); ?>
<div class="pagination"> 
<?php 
$this->widget('LinkPager',array('pages'=>$pages));
?>
</div>