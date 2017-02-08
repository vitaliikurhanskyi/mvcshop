<?php

/**
* Контроллер AdminController
* Главная страница в админпанеле
*/

//require_once "AdminBase.php";

class AdminController extends AdminBase
{
	/**
	* Action для стартовой страницы "Панель администратора"
	*/
	public function actionIndex()
	{
		//Проверяем доступ
		self::checkAdmin();

		//Подключаем вид
		require_once(ROOT . '/views/admin/index.php');
		return true;
	}
}