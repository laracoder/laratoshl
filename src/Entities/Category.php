<?php

namespace Elcheffe\Laratoshl\Entities;

use Carbon\Carbon;

/**
 * Class Category
 * Category entity
 * @package Laratoshl
 */
class Category {

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
     * @var string
     */
    public $type = '';

    /**
     * @var bool
     */
    public $deleted = false;

    /**
     * @var Carbon
     */
    public $transient_created = null;

    /**
     * @var Collection
     */
    public $counts = null;
}