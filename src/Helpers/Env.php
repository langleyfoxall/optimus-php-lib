<?php

namespace Optimus\Helpers;

final class Env
{
    /** @var Env $instance */
    protected static $instance;

    /** @var string $baseUri */
    protected $baseUri;

    /** @var string $token */
    protected $token;

    protected function __construct()
    {
        //
    }

    /**
     * Manage singleton instance.
     *
     * @return Env
     */
    protected static function make()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Set the base URI.
     *
     * @param string $baseUri
     * @return void
     */
    public static function setBaseUri($baseUri)
    {
        self::make()->baseUri = $baseUri;
    }

    /**
     * Get the base URI.
     *
     * @return string
     */
    public static function getBaseUri()
    {
        return self::make()->baseUri;
    }

    /**
     * Set the token.
     *
     * @param string $token
     * @return void
     */
    public static function setToken($token)
    {
        self::make()->token = $token;
    }

    /**
     * Get the token
     *
     * @return string
     */
    public static function getToken()
    {
        return self::make()->token;
    }
}
