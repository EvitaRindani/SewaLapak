<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $request = $auth->createPermission('request');
        $request->description = 'request is a task done by ordinary member';
        $auth->add($request);

        $view_request = $auth->createPermission('view_request');
        $view_request->description = 'view_request is a task done by member';
        $auth->add($view_request);

        $manage_request = $auth->createPermission('manage_request');
        $manage_request->description = 'manage_request is a task done by administrator';
        $auth->add($manage_request);

        $manage_tanah = $auth->createPermission('manage_tanah');
        $manage_tanah->description = 'manage_tanah is a task done by administrator';
        $auth->add($manage_tanah);

        $view_user = $auth->createPermission('view_user');
        $view_user->description = 'view_user is a task done by administrator';
        $auth->add($view_user);

        $view_transaction = $auth->createPermission('view_transaction');
        $view_transaction->description = 'view_transaction is a task done by administrator';
        $auth->add($view_transaction);

        $login = $auth->createPermission('login');
        $login->description = 'login is an operation done by member to login';
        $auth->add($login);

        $admin = $auth->createRole('admin');
        $member = $auth->createRole('member');

        $auth->add($admin);
        $auth->add($member);

        $auth->addChild($admin, $member);
        $auth->addChild($admin, $manage_request);
        $auth->addChild($admin, $manage_tanah);
        $auth->addChild($admin, $view_user);
        $auth->addChild($admin, $view_transaction);
        $auth->addChild($member, $request);
        $auth->addChild($member, $view_request);
        $auth->addChild($member, $login);

        $auth->assign($admin, 1);
    }

}
?>

