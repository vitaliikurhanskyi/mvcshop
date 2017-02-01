<?php

// include_once ROOT . '/models/Category.php';
// include_once ROOT . '/models/Product.php';
// include_once ROOT . '/components/Pagination.php';

class CatalogController
{
	public function actionIndex()
	{

		/*
		* Выводим категории
		*/
		$categories = array();
		$categories = Category::getCategoriesList();


		/*
		* Выводим список последних продуктов
		*/
		$latestProducts = array();
		$latestProducts = Product::getLatestProducts(6);

		require_once(ROOT . '/views/catalog/index.php');

		// echo "<pre>";
		// print_r($categories);
		// echo "</pre>";

		return true;

	}

	public function actionCategory($categoryId, $page = 1)
	{

		// echo $categoryId;
		// echo "<br>";
		// echo $page;

		$categories = array();
		$categories = Category::getCategoriesList();

		$categoryProducts = array();
		$categoryProducts = Product::getProductsListByCategory($categoryId, $page);

		$total = Product::getTotalProductsInCategory($categoryId);

		// Создаем объект Pagination - постраничная навигация

		$pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

		require_once(ROOT . '/views/catalog/category.php');

		return true;
	}




}