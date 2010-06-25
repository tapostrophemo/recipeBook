<?php if ($this->session->flashdata('err')): ?>
<div class="err"><?=$this->session->flashdata('err')?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('msg')): ?>
<div class="msg"><?=$this->session->flashdata('msg')?></div>
<?php endif; ?>

