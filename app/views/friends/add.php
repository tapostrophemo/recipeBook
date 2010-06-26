<?=$this->load->view('closeButton')?>

<?=form_open('friends/add')?>
<table>
 <tr>
  <td><label for="username">Username</label></td>
  <td><input type="text" name="username"/></td>
 </tr>
 <tr>
  <td><label for="email">Email</label></td>
  <td><input type="text" name="email"/></td>
 </tr>
 <tr>
  <td colspan="2">
   <input type="submit" value="Send Invitation"/>
  <?php if ($this->input->is_ajax()): ?>
   <input type="button" value="Cancel" onclick="$.modal.close()"/>
  <?php else: ?>
   <input type="button" value="Cancel" onclick="document.location.href='<?=base_url()?>manage'"/>
  <?php endif; ?>
  </td>
 </tr>
</table>
</form>

