<?php

/**
 * Class DigitalPianism_TestFramework_Helper_Magento
 * @link http://magento.stackexchange.com/questions/143976/best-practice-for-unit-tests-in-magento-1-9
 */
class DigitalPianism_TestFramework_Helper_Magento
{
	private static function patchMagentoAutoloader()
	{
		$mageErrorHandler = set_error_handler(function () {
			return false;
		});
		set_error_handler(function ($errno, $errstr, $errfile) use ($mageErrorHandler) {
			if (substr($errfile, -19) === 'Varien/Autoload.php') {
				return null;
			}
			return is_callable($mageErrorHandler) ?
				call_user_func_array($mageErrorHandler, func_get_args()) :
				false;
		});
	}

	/**
	 * Modified path to Mage.php here because PHP automatically follows symlinks in require(),
	 * which means this path is actually relative to the vendor folder, not the www folder.
	 * This path assumes your extension source code is in <PROJECT_ROOT>/src and Magento code is in <PROJECT_ROOT>/www
	 */
	public static function bootstrap()
	{
		require __DIR__ . '/../../../../../../../www/app/Mage.php';
		self::patchMagentoAutoloader();
		self::init();
	}

	public function reset()
	{
		Mage::reset();
		self::init();
	}

	public static function init()
	{
		Mage::app('', 'store', ['config_model'  =>  DigitalPianism_TestFramework_Model_Config::class]);
		Mage::setIsDeveloperMode(true);
		self::patchMagentoAutoloader();
		$_SESSION = [];
	}
}
