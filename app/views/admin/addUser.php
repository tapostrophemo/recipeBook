<?=validation_errors()?>

<?php if ($this->input->is_ajax()): ?>
<img style="float:right" src="<?=base_url()?>res/x.png" alt="(close)" onclick="$.modal.close()"/>
<?php endif; ?>

<?=form_open('admin/adduser')?>
<table>
 <tr>
  <td><label for="username">*Username</label></td>
  <td><input type="text" name="username" value="<?=set_value('username')?>"/></td>
 </tr>
 <tr>
  <td><label for="password">*Password</label></td>
  <td><input type="text" name="password"/></td>
 </tr>
 <tr>
  <td><label for="email">*Email</label></td>
  <td><input type="text" name="email" value="<?=set_value('email')?>"/></td>
 </tr>
 <tr>
  <td colspan="2">
   <input type="submit" value="Save"/>
  <?php if ($this->input->is_ajax()): ?>
   <input type="button" value="Cancel" onclick="$.modal.close()"/>
  <?php else: ?>
   <input type="button" value="Cancel" onclick="document.location.href='<?=base_url()?>admin'"/>
  <?php endif; ?>
  </td>
 </tr>
</table>
</form>

