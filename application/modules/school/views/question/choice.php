<table>
	<?php foreach($answers as $key =>$value):?>
	<tr>
		<td>
			<input type="radio" style="font-weight: normal; float:left" name="answers[<?=$qestionId;?>]" id="answers_<?=$qestionId;?>_<?=$value['id'];?>" value="<?=$value['id'];?>"/>
			<span  class="answers_<?=$qestionId;?>_<?=$value['id']?>" style="padding-left:10px;"><?=$value['name'];?></span>
		</td>
	</tr>
	<?php endforeach;?>
</table>
