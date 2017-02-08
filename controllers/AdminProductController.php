<?php

/*
* Контроллер AdminProductController
* Управление товарами в админпанели
*/
class AdminProductController extends AdminBase
{
	/**
	* Action для страницы "Управления товарами"
	*/
	public function actionIndex()
	{
		// Проверка доступа
		self::checkAdmin();

		// Получаем список товаров
		$productsList = Product::getProductsList();

		// Подключаем вид
		require_once(ROOT . '/views/admin_product/index.php');

		return true;
	}

	/**
	* Action для страницы "Добавить товар"
	*/
	public function actionCreate()
	{
		// Проверка доступа
		self::checkAdmin();

		// Получаем список категорий для выпадающего списка
		$categoriesList = Category::getCategoriesListAdmin();

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправленна
			// Получаем данные из формы
			$options['name'] = $_POST['name'];
			$options['code'] = $_POST['code'];
			$options['price'] = $_POST['price'];
			$options['category_id'] = $_POST['category_id'];
			$options['brand'] = $_POST['brand'];
			$options['availability'] = $_POST['availability'];
			$options['description'] = $_POST['description'];
			$options['is_new'] = $_POST['is_new'];
			$options['is_recommended'] = $_POST['is_recommended'];
			$options['status'] = $_POST['status'];

			// Флаг ошибок в форме
			$errors = false;

			// При необходимости можно валидировать значения нужным образом
			if (!isset($options['name']) || empty($options['name'])) {
				$errors[] = 'Заполните поля';
			}

			if ($errors == false) {
				// Если ошибок нет, добавляем новый товар
				$id = Product::createProduct($options);

				// Если запись добавленна
				if ($id) {
					// Проверяем, загружалось ли через форму изображение
					// echo "<pre>";
					// print_r($_FILES["image"]);
					// echo "</pre>";
					// die();
					if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
						// Если загружалось, переместим его в нужную папку, дадим новое имя.
						move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
					}
				}

				// Перенаправляем пользователя на страницу управления товарами
				header("Location: /admin/product");
			}

		}

		// Подключаем вид
		require_once(ROOT . '/views/admin_product/create.php');
		return true;

	}

	/**
	* Action для страницы "Удалить товар"
	*/
	public function actionDelete($id)
	{
		// Проверка доступа
		self::checkAdmin();

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправленна
			// Удаляем товар
			Product::deleteProductById($id);

			//Перенаправляем пользователя на страницу управлениями товарами
			header("Location: /admin/product");
		}

		require_once(ROOT . '/views/admin_product/delete.php');

		return true;
	}

	public function actionUpdate($id) {
		// Проверка доступа
		self::checkAdmin();

		// Получаем список категорий для выпадающего списка
		$categoriesList = Category::getCategoriesListAdmin();

		// Получение данных о конкретном заказе
		$product = Product::getProductById($id);

		// Обработка формы
		if (isset($_POST['submit'])) {

			$options['name'] = $_POST['name'];
			$options['code'] = $_POST['code'];
			$options['price'] = $_POST['price'];
			$options['category_id'] = $_POST['category_id'];
			$options['brand'] = $_POST['brand'];
			$options['availability'] = $_POST['availability'];
			$options['description'] = $_POST['description'];
			$options['is_new'] = $_POST['is_new'];
			$options['is_recommended'] = $_POST['is_recommended'];
			$options['status'] = $_POST['status'];

			// Сохраняем изменения
			if (Product::updateProductById($id, $options)) {

				// echo '<pre>';
				// print_r($_FILES["image"]);
				// echo '</pre>';

				// Если запись сохранена
				// Проверим, загружалось ли через форму изображение
				if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

					// Если загружалось, переместим его в нужную папку и дадим имя
					move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
				}

			}

			// Перенаправляем пользователя на страницу управления товарами
			header("Location: /admin/product");

		}

		//Подключаем вид
		require_once(ROOT . '/views/admin_product/update.php');
		return true;
	}

}