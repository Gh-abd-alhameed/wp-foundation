<?php


namespace boca\core\settings;

use boca\core\settings\Locale;
use boca\core\settings\session;

class Init
{
	public static array $app = [];
	public $Locale;



	public static function setapp(array $app = [])
	{
		self::$app = [
			'url' => "/",
			"dir_theme" => get_template_directory(),
			'locale' => 'en',
			'available_locales' => [
				'en' => [
					"prefix" => "/",
				],
				'ar' => [
					"prefix" => "/ar"
				],
				'fr' => [
					"prefix" => "/fr"
				]
			],
			"static_file" => [
				"public" => [
					"prefix" => "/public",
					"extension" => ["css", "js", "pdf", "webp", "png", "jpg"]
				]
			],
			"debug" => true,
			"databases" => [
				"driver" => "mysql",
				"host" => "localhost:3306",
				"database" => "shop",
				"username" => "root",
				"password" => ""
			],
		];
	}

	public static function init()
	{
		session::Init();
		Request::Init();
		Locale::Init();
	}


}