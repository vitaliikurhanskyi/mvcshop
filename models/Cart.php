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

}