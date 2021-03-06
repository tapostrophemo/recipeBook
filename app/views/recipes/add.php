<?=validation_errors()?>

<?=form_open_multipart('add')?>

<?=$this->load->view('closeButton')?>

<table>
 <tr>
  <td><label for="name">*Name</label></td>
  <td><input type="text" name="name" value="<?=set_value('name')?>"/></td>
 </tr>
 <tr>
  <td><label for="category">*Category</label></td>
  <td>
   <select name="category" id="category">
   <?php foreach ($this->Recipe->getCategoryMap() as $name => $value): ?>
    <option value="<?=$value?>"<?=set_select('category', $value)?>><?=$name?></option>
   <?php endforeach; ?>
   </select>
  </td>
 </tr>
 <tr>
  <td><label for="photo">Photo</label></td>
  <td><input type="file" name="photo"<?php if ($this->agent->is_local_mechanize()): /*TODO: make cucumber/webrat work with :mechanize*/ ?> disabled="true"<?php endif; ?>/></td>
 </tr>
 <tr>
  <td><label for="ingredients">Ingredients</label></td>
  <td><textarea name="ingredients" id="ingredients" rows="6" style="width:75%"><?=set_value('ingredients')?></textarea></td>
 </tr>
 <tr>
  <td><label for="instructions">Instructions</label></td>
  <td><textarea name="instructions" id="instructions" rows="8" style="width:100%"><?=set_value('instructions')?></textarea></td>
 </tr>
 <tr>
  <td colspan="2">
   <input type="submit" value="Save"/>
  <?php if ($this->input->is_ajax()): ?>
   <input type="button" value="Cancel" onclick="$.modal.close()"/>
  <?php else: ?>
   <input type="button" value="Cancel" onclick="document.location.href='<?=base_url()?>'"/>
  <?php endif; ?>
  </td>
 </tr>
</table>
</form>

