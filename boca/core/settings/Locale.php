<?php

namespace boca\core\settings;

use boca\core\settings\Request;

class Locale
{
	protected static $locale;

	public static $code;

	public function __construct()
	{
	}
	public static function get()
	{
		return self::$locale;
	}


	public static function set(string $locale)
	{
		if (!is_string($locale)) {
			die(__FILE__ . "|Line:" . __LINE__ . "|Message: Locale Most be String");
		}
		if (!key_exists($locale, Init::$app["available_locales"])) {
			die(__FILE__ . "|Line:" . __LINE__ . "|Message: Locale Not Found");
		}
		self::$locale = $locale;
	}
	public static function LocaleCode() : string
	{
		return self::$code;
	}
	public static function Init()
	{
		self::SetLocaleInit();
		Hooks::Init("init", function ()  {
			Hooks::action(function () {
				Hooks::Init("option_home", function () {
					Hooks::filter(function ($val) {
						return url_site();
					});
				});

			});
		});
	}

	public static function SetLocaleInit()
	{
		$url = Request::http() . Request::host() . Request::uri();
		$pattern = "/^(http(s)?:\/\/)?(\w+.)?(\w+[\-]?\w+)(-\w+)?\.?\w+\/?((\w+)\/?)/";
		$check = preg_match($pattern, $url, $mache);
		$locale = Init::$app["available_locales"];
		if ($check) {
			if (key_exists(end($mache), $locale)) {
				$language = end($mache);
				self::$code = Init::$app["available_locales"][$language]["code"];
				self::$locale = $language;
			} else {
				self::$locale = Init::$app["available_locales"][app("locale")];
				self::$code = Init::$app["available_locales"][app("locale")]["code"];
			}
		}
	}
}
