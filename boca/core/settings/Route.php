<?php

namespace boca\core\settings;

class Route
{
	public static function Init($callback)
	{
		add_action('rest_api_init', $callback());
	}

	public static function get($route, $callback)
	{

	}

	public static function post(string $namespace, string $route, $callback)
	{
		$routename = $namespace . $route;
		if (is_string($callback)) {
			self::StringHundel($callback);
		}
		self::hundel($namespace, $route, $callback , "POST");
	}

	public static function hundel(string $namespace, $route, $callback, $method)
	{
		return register_rest_route($namespace, $route, array(
			'methods' => $method,
			'callback' => $callback(),
			'args' => array(),
		));
	}

	public static function StringHundel($string)
	{
	}
}