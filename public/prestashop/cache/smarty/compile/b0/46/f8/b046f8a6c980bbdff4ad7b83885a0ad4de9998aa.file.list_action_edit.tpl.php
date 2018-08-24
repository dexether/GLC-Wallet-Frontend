<?php /* Smarty version Smarty-3.1.19, created on 2018-04-09 03:54:54
         compiled from "/Applications/MAMP/htdocs/public/prestashop/admin/themes/default/template/controllers/tax_rules/helpers/list/list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11403883585acae40eeea158-60282766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b046f8a6c980bbdff4ad7b83885a0ad4de9998aa' => 
    array (
      0 => '/Applications/MAMP/htdocs/public/prestashop/admin/themes/default/template/controllers/tax_rules/helpers/list/list_action_edit.tpl',
      1 => 1517260832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11403883585acae40eeea158-60282766',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5acae40eeefbe4_70035604',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acae40eeefbe4_70035604')) {function content_5acae40eeefbe4_70035604($_smarty_tpl) {?>
<a onclick="loadTaxRule('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
'); return false;" href="#" class="btn btn-default">
	<i class="icon-pencil"></i>
	<?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a>
<?php }} ?>
