<?php
$this->title = lang('Dashboard');
$colors = ['warning', 'info', 'pink', 'slate', 'teal', 'danger'];
?>

<?php if(isset($tk_dieutra)):?>
    <?=$this->render('_dieutra', ['tk_dieutra' => $tk_dieutra])?>
<?php endif;?>

<?php if(isset($tk_dc_bn)):?>
    <?=$this->render('_dc_bn', ['tk_dc_bn' => $tk_dc_bn])?>
<?php endif;?>

<?php if(isset($tk_chuyenca)):?>
    <?=$this->render('_chuyenca', ['tk_chuyenca' => $tk_chuyenca])?>
<?php endif;?>

