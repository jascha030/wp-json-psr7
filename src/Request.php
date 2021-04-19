<?php

namespace Jascha030\WPJSON;

use Psr\Http\Message\RequestInterface;
use WP_REST_Request;

/**
 * Class Request,
 * PSR-7 compliant Wrapper for the WP_Rest_Request class.
 * Uses Laminas' (formerly Zend Framework) Diactoros PSR7 implementation.
 *
 * @package Jascha030\WPJSON
 */
class Request extends \Laminas\Diactoros\Request
{
    /**
     * @var WP_REST_Request
     */
    private WP_REST_Request $wp_rest_request;

    /**
     * Request constructor.
     *
     * @param WP_REST_Request $wp_rest_request
     */
    public function __construct(WP_REST_Request $wp_rest_request)
    {
        parent::__construct(
            $wp_rest_request->get_route(),
            $wp_rest_request->get_method(),
            $wp_rest_request->get_body(),
            $wp_rest_request->get_headers()
        );

        $this->wp_rest_request = $wp_rest_request;
    }

    /**
     * Get the original Wordpress Request object.
     *
     * @return WP_REST_Request
     */
    final public function getWPRestRequest(): WP_REST_Request
    {
        return $this->wp_rest_request;
    }

    /**
     * Creates a new PSR-7 compliant Http Request from a Wordpress request.
     *
     * @param WP_REST_Request $wp_rest_request
     *
     * @return RequestInterface
     */
    final public static function fromWPRequest(WP_REST_Request $wp_rest_request): RequestInterface
    {
        return new static($wp_rest_request);
    }
}
