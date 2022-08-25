<?php

include_once dirname(__FILE__) . '/components/startup.php';
include_once dirname(__FILE__) . '/authorization.php';
include_once dirname(__FILE__) . '/components/application.php';
include_once dirname(__FILE__) . '/components/page/reset_password_page.php';

$page = new ResetPasswordPage(CreateTableBasedUserManager());
$page->OnPasswordResetComplete->AddListener('PasswordResetComplete');
$page->BeginRender();
$page->EndRender();
