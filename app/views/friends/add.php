<?=$this->load->view('closeButton')?>

<?=validation_errors()?>

<?=form_open('friends/add')?>
<table>
 <tr>
  <td><label for="username">Choose Username for Friend</label></td>
  <td><input type="text" name="username" value="<?=set_value('username')?>"/></td>
 </tr>
 <tr>
  <td><label for="email">Friend's Email</label></td>
  <td><input type="text" name="email" value="<?=set_value('email')?>"/></td>
 </tr>
 <tr>
  <td colspan="2">
   <input type="submit" value="Send Invitation"/>
  <?php if ($this->input->is_ajax()): ?>
   <input type="button" value="Cancel" onclick="$.modal.close()"/>
  <?php else: ?>
   <input type="button" value="Cancel" onclick="document.location.href='<?=base_url()?>settings'"/>
  <?php endif; ?>
  </td>
 </tr>
</table>
</form>

