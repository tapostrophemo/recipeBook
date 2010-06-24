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
  <td colspan="2"><input type="submit" value="Send Invitation"/></td>
 </tr>
</table>
</form>

