<?php

namespace Jascha030\WPJSON;

use Psr\Http\Message\ResponseInterface;
use WP_REST_Response;

/**
 * Class Response,
 * PSR-7 compliant wrapper for the WP_Rest_Response class.
 * Uses Laminas' (formerly Zend Framework) Diactoros PSR7 implementation.
 *
 * @package Jascha030\WPJSON
 */
class Response extends \Laminas\Diactoros\Response
{
    /**
     * @var WP_REST_Response
     */
    private WP_REST_Response $wp_rest_response;

    /**
     * Response constructor.
     *
     * @param WP_REST_Response $wp_rest_response
     */
    public function __construct(WP_REST_Response $wp_rest_response)
    {
        parent::__construct(
            $wp_rest_response->get_data(),
            $wp_rest_response->get_status(),
            $wp_rest_response->get_headers()
        );

        $this->wp_rest_response = $wp_rest_response;
    }

    /**
     * Get the original Wordpress Response object.
     *
     * @return WP_REST_Response
     */
    final public function getWPRestResponse(): WP_REST_Response
    {
        return $this->wp_rest_response;
    }

    /**
     * Creates a new PSR-7 compliant Http Response from a Wordpress response.
     *
     * @param WP_REST_Response $wp_rest_response
     *
     * @return ResponseInterface
     */
    final public static function fromWPResponse(WP_REST_Response $wp_rest_response): ResponseInterface
    {
        return new static($wp_rest_response);
    }
}
