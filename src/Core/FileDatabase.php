<?php

namespace App\Models;

/**
 * Class FileDatabase
 * Implements the Database interface and provides functionality to interact with a CSV file-based database.
 */
class FileDatabase implements Database {

    /**
     * @var string The path to the database file.
     */
    private $path;
}