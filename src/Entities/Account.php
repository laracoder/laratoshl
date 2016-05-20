<?php

namespace Elcheffe\Laratoshl\Entities;

use Carbon\Carbon;

/**
 * Class Account
 * Account entity
 * @package Laratoshl
 */
class Account {

    /**
     * @var string
     */
    public $id = '';

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var Carbon
     */
    public $modified = null;

    /**
     * @var float
     */
    public $balance = 0;

    /**
     * @var float
     */
    public $initial_balance = 0;

    /**
     * @var Collection
     */
    public $currency = null;

    /**
     * @var Collection
     */
    public $median = null;

    /**
     * @var string
     */
    public $status = '';

    /**
     * @var integer
     */
    public $order = 0;

}