<?php

namespace Elcheffe\Laratoshl\Entities;

use Carbon\Carbon;

/**
 * Class Entry
 * Entry entity
 * @package Laratoshl
 */
class Entry {

    /**
     * @var string
     */
    public $id = '';

    /**
     * @var integer
     */
    public $account = 0;

    /**
     * @var integer
     */
    public $category = 0;

    /**
     * @var string
     */
    public $desc = '';

    /**
     * @var bool
     */
    public $completed = '';

    /**
     * @var Carbon
     */
    public $date = '';

    /**
     * @var float
     */
    public $amount = 0;

    /**
     * @var Collection
     */
    public $tags = null;

    /**
     * @var Collection
     */
    public $currency = null;

    /**
     * @var Collection
     */
    public $location = null;

    /**
     * @var Collection
     */
    public $repeat = null;

    /**
     * @var Collection
     */
    public $transaction = null;

    /**
     * @var Collection
     */
    public $images = null;

    /**
     * @var Collection
     */
    public $reminders = null;
}