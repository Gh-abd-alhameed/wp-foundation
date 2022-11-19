<?php

namespace boca\core\settings;

class Route
{
	public static $namespace;
	public static $READABLE = \WP_REST_Server::READABLE; // GET
	public static $EDITABLE = \WP_REST_Server::EDITABLE; // POST, PUT, PATCH
	public static $DELETABLE = \WP_REST_Server::DELETABLE; // DELETE
	public static $ALLMETHODS = \WP_REST_Server::ALLMETHODS; // ANY

	public static function Init(string $namespace, $callback)
	{
		self::$namespace = $namespace;
		return add_action('rest_api_init', $callback);
	}

	public static function get($route, $callback)
	{
		if (is_string($callback)) {
			return self::StringHandle($callback);
		}
		self::Handle($route, $callback, self::$READABLE);
	}

	public static function post(string $route, $callback)
	{
		if (is_string($callback)) {
			return self::StringHandle($callback);
		}
		self::Handle($route, $callback, self::$EDITABLE);
	}

	public static function Handle($route, $callback, $method)
	{

		register_rest_route(self::$namespace, $route, array(
			'methods' => $method,
			'callback' =>$callback(),
		));
		die();
	}

	public static function StringHandle($string)
	{
		return false;
	}
}