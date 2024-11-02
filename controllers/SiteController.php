<?php

/**
 * Контроллер SiteController
 */
class SiteController extends Controller
{

    function __construct()
    {
        if (Auth::getInstance()->compareRules(Auth::ADMIN))
            header('Location: /admin');
        if (Auth::getInstance()->compareRules(Auth::INVENT))
            header('Location: /inventory');
        if (Auth::getInstance()->compareRules(Auth::PASSPORTIST))
            header('Location: /passportist');

        parent::__construct();
    }

    public function actionIndex()
    {
        // Список категорий для левого меню
    //    $categories = Category::getCategoriesList();

        // Список последних товаров
      //  $latestProducts = Product::getLatestProducts(6);

        // Список товаров для слайдера
      //  $sliderProducts = Product::getRecommendedProducts();

        // Подключаем вид
        $this->getView()->setTitle('Индивидуальный план педагогического работника');
        $this->render('site/index');
     //   require_once(ROOT . '/views/site/index.php');
      //  return true;
    }
    public function actionLogin()
    {
        if (Auth::getInstance()->isGuest())
        {
            $loginForm = new LoginForm;

            if (isset($_POST['auth_submit']))
            {
                $loginForm->login = $_POST['auth_login'];
                $loginForm->password = $_POST['auth_password'];

                if ($loginForm->login())
                {
                    header('Location: /');
                }
                else
                {
                    header('Location: /');
                }
            }
        }
        else
        {
            header('Location: /');
        }
    }

    public function actionError404()
    {
        $error = $this->getRouterError();
        if (!empty($error)) // Если есть ошибка
        {
            $this->getView()->setTitle('Ошибка 404');
            $this->getView()->setLayoutHeader('simple');
            $this->getView()->setLayoutFooter('simple');
            $this->render('site/error404', array('error' => $error));
        }
        else
        {
            header('Location: /');
        }
    }
}


?>
