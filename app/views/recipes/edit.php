<?=validation_errors()?>

<?=form_open('edit/'.$recipe->id)?>

<?=$this->load->view('closeButton')?>

<table>
 <tr>
  <td><label for="name">*Name</label></td>
  <td><input type="text" name="name" id="name" value="<?=set_value('name', $recipe->name)?>"/></td>
 </tr>
 <tr>
  <td><label for="category">*Category</label></td>
  <td>
   <select name="category" id="category">
   <?php foreach ($this->Recipe->getCategoryMap() as $name => $value): ?>
    <option value="<?=$value?>"<?=set_select('category', $value, $value == $recipe->category)?>><?=$name?></option>
   <?php endforeach; ?>
   </select>
  </td>
 </tr>
 <tr>
  <td><label for="photo">Photo</label></td>
  <td><?=$recipe->photo?></td>
 </tr>
 <tr>
  <td><label for="ingredients">Ingredients</label></td>
  <td><textarea name="ingredients" id="ingredients" rows="8" cols="30"><?=set_value('ingredients', join("\n", $recipe->ingredients))?></textarea></td>
 </tr>
 <tr>
  <td><label for="instructions">Instructions</label></td>
  <td><textarea name="instructions" id="instructions" rows="8" cols="50"><?=set_value('instructions', join("\n\n", $recipe->instructions))?></textarea></td>
 </tr>
 <tr>
  <td colspan="2">
   <input type="submit" value="Save"/>
  <?php if ($this->input->is_ajax()): ?>
   <input type="button" value="Cancel" onclick="$.modal.close()"/>
  <?php else: ?>
   <input type="button" value="Cancel" onclick="document.location.href='<?=base_url()?>recipe/<?=$recipe->id?>'"/>
  <?php endif; ?>
  </td>
 </tr>
</table>

</form>

