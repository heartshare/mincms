<blockquote><h3><?php echo t('admin','Module Lists'); ?></h3></blockquote>  
	
<table class="table table-bordered">
  <thead>
    <tr>
      <th><?php echo t('admin','Name');?></th>
      <th><?php echo t('admin','Descirption');?></th>
      <th><?php echo t('admin','Author');?></th>
      <th> </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($file as $k=>$info){?>
    <tr>
      <td><?php echo $k;?></td>
      <td><?php echo $info['name'];?></td>
      <td><?php echo $info['auth'];?></td>
      <td>
       	<?php
       		if($check && $check[$k]==1){
		 		$str =  "<img src='".base_url()."/misc/img/ok.png' />";
		 	}else{
		 		$str =  "<img src='".base_url()."/misc/img/error.png' />"; 
	 		}
	 		echo "<a href='".$this->createUrl('modules/next',array('name'=>$k))."'>".$str."</a>";
       	?> 
      </td>
    </tr>
    <?php }?> 
  </tbody>
</table>