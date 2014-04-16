<?php defined('C5_EXECUTE') or die("Access Denied.");

$vth = Loader::helper('validation/token');
if (!$vth->validate()) {
	$errors = array(t('Invalid form submission -- please reload the page and try again.'));
} else if (empty($_POST['bID']) || (intval($_POST['bID']) != $_POST['bID'])) {
	$errors = array(t('Invalid form submission -- please reload the page and try again'));
} else {
	$b = Block::GetById($_POST['bID']);
	$bc = new CustomContactFormBlockController($b);
	$errors = $bc->processForm(true);
}

//Send response
$response = array(
	'success' => empty($errors),
	'errors' => $errors,
);
echo Loader::helper('json')->encode($response);

exit;
