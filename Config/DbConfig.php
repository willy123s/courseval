<?php

namespace Makkari\Config;

define("SERVER", $_ENV['DB_HOST']);
define("USERNAME", $_ENV['DB_USER']);
define("PASSWORD", $_ENV['DB_PASSWORD']);
define("DB_NAME", $_ENV['DB_NAME']);
define("DEFAULT_TIMEZONE", $_ENV['DEFAULT_TIMEZONE']);
define("TEMPLATE_PATH", $_ENV['TEMPLATE_PATH']);
define("PAGES_PATH", $_ENV['PAGES_PATH']);

class DbConfig
{
    const SERVER = SERVER;
    const USERNAME = USERNAME;
    const PASSWORD = PASSWORD;
    const DB_NAME =  DB_NAME;
    const DEFAULT_TIMEZONE = DEFAULT_TIMEZONE;
    const TEMPLATE_PATH = TEMPLATE_PATH;
    const PAGES_PATH = PAGES_PATH;
}
