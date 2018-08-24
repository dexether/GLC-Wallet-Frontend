<?php /* Smarty version Smarty-3.1.19, created on 2018-04-09 03:54:53
         compiled from "/Applications/MAMP/htdocs/public/prestashop/admin/themes/default/template/controllers/logs/employee_field.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13631930235acae40d497571-57949011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b038036e88998ba6c0604eb67ab2fd052684b4d' => 
    array (
      0 => '/Applications/MAMP/htdocs/public/prestashop/admin/themes/default/template/controllers/logs/employee_field.tpl',
      1 => 1517260832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13631930235acae40d497571-57949011',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'employee_image' => 0,
    'employee_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5acae40d49ba35_29507498',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acae40d49ba35_29507498')) {function content_5acae40d49ba35_29507498($_smarty_tpl) {?>
<span class="employee_avatar_small">
	<img class="imgm img-thumbnail" alt="" src="<?php echo $_smarty_tpl->tpl_vars['employee_image']->value;?>
" width="32" height="32" />
</span>
<?php echo $_smarty_tpl->tpl_vars['employee_name']->value;?>

<?php }} ?>
