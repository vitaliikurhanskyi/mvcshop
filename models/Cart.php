<?php

class Cart
{

	public static function addProduct($id)
	{

		$id = intval($id);

		// Пустой массив для товаров в корзине
		$productsInCart = array();

		// Если в корзине уже есть товары (они хранятся в сессии)
		if (isset($_SESSION['products'])) {
			// То заполним наш массив товарами
			$productsInCart = $_SESSION['products'];
		}

		//Если товар есть в корзине, но был добавлен еще раз, увеличем количество
		if (array_key_exists($id, $productsInCart)) {
			$productsInCart[$id] ++;
		} else {
			// Добавляем новый товар в корзину
			$productsInCart[$id] = 1;
		}

		$_SESSION['products'] = $productsInCart;
		// echo '<pre>';
		// print_r($_SESSION['products']);
		// echo '</pre>';
		// die();

	}

	/**
	* Удалить продукт из корзины
	*/
	public static function deleteProduct($id)
	{
		$id = intval($id);

		// Пустой массив для товаров в корзине
		$productsInCart = array();

		// Если в корзине уже есть товары (они хранятся в сессии)
		if (isset($_SESSION['products'])) {
			// То заполним наш массив товарами
			$productsInCart = $_SESSION['products'];
		}

		if (array_key_exists($id, $productsInCart)) {
			unset($productsInCart[$id]);
		}

		$_SESSION['products'] = $productsInCart;
	}

	/**
	* Подщет количества товаров в корзине (в сесии) 
	*/
	public static function countItems()
	{

		if (isset($_SESSION['products'])) {
			$count = 0;
			foreach ($_SESSION['products'] as $id => $quantity) {
				$count = $count + $quantity;
			}
			return $count;
		} else {
			return 0;
		}

	}

	/**
	* Получить массив продуктов из сессии
	*/
	public static function getProducts()
	{
		if (isset($_SESSION['products'])) {
			return $_SESSION['products'];
		}
		return false;
	}

	/**
	* Получить общую цену на продукты
	*/
	public static function getTotalPrice($products)
	{
		$productsInCart = self::getProducts();

		if ($productsInCart) {
			$total = 0;
			foreach ($products as $item) {
				$total += $item['price'] * $productsInCart[$item['id']];
			}
		}

		return $total;
	}

	/**
	* Очистить сессию корзины
	*/
	public static function clear()
	{
		if (isset($_SESSION['products'])) {
			unset($_SESSION['products']);
		}
	}

}