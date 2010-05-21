<?=form_open_multipart('add')?>
<img style="float:right" src="<?=base_url()?>res/x.png" alt="(close)" onclick="$.modal.close()"/>
<table>
 <tr>
  <td><label for="name">Name</label></td>
  <td><input type="text" name="name" value="<?=set_value('name')?>"/></td>
 </tr>
 <tr>
  <td><label for="category">Category</label></td>
  <td>
   <select name="category">
   <?php foreach ($this->Recipe->getCategoryMap() as $name => $value): ?>
    <option value="<?=$value?>"><?=$name?></option>
   <?php endforeach; ?>
   </select>
  </td>
 </tr>
 <tr>
  <td><label for="photo">Photo</label></td>
  <td><input type="file" name="photo" disabled="true"/></td>
 </tr>
 <tr>
  <td><label for="ingredients">Ingredients</label></td>
  <td><textarea name="ingredients" rows="8" cols="30"><?=set_value('ingredients')?></textarea></td>
 </tr>
 <tr>
  <td><label for="instructions">Instructions</label></td>
  <td><textarea name="instructions" rows="8" cols="50"><?=set_value('instructions')?></textarea></td>
 </tr>
 <tr>
  <td colspan="2">
   <input type="submit" value="Save"/>
   <input type="button" value="Cancel" onclick="$.modal.close()"/>
  </td>
 </tr>
</table>
</form>

