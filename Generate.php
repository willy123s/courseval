<?php

namespace Makkar\CLI;

class Generate
{
    public static function generateControllerFile($name)
    {
        $filename = "Controllers/" . $name . ".php";
        if (file_exists($filename)) {
            echo "Error: Controller file already exists.\n";
            return;
        }
        $generate = new Generate;
        if (!file_put_contents($filename, $generate->controllerTemplate($name))) {
            echo "Error: Unable to create the controller file.\n";
            return;
        }

        echo "Controller {$name} created successfully!\n";
    }
    protected function controllerTemplate($name)
    {
        $controllerTemplate = "<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;

class $name extends Controller
{
    public static function index()
    {
        // Your code here
    }
    public static function create()
    {
        // Your code here
    }
    public static function edit()
    {
        // Your edit code goes here
    }
    public static function save(){
        // Your save code goes here
    }
    
    public static function confirm(){
        // Your code goes here
    }
    public static function delete(){
        //your delete code goes here
    }
}
";
        return $controllerTemplate;
    }

    // Model Generator

    function createDatabaseConnection()
    {
        $envFilePath = __DIR__ . '/.env';

        if (file_exists($envFilePath)) {
            $envContent = file_get_contents($envFilePath);

            // Split the content into lines
            $envLines = explode("\n", $envContent);

            // Process each line
            foreach ($envLines as $line) {
                $line = trim($line);
                if (!empty($line) && strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line, 2);
                    putenv("$key=$value");
                    $_ENV[$key] = $value;
                    $_SERVER[$key] = $value;
                }
            }
        }
        require_once("./Config/DbConfig.php");
        $host = SERVER;
        $dbname = DB_NAME;
        $user = USERNAME;
        $password = PASSWORD;

        try {
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage() . "\n";
            exit(1);
        }
    }

    function getTableColumns($pdo, $tableName)
    {
        try {
            $stmt = $pdo->prepare("DESCRIBE $tableName");
            $stmt->execute();
            $columns = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // $columns = [];
            // foreach ($columns as $column) {
            //     $columns[] = '$' . $column;
            // }
            return $columns;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage() . "\n";
            exit(1);
        }
    }

    function generateProperties($columns)
    {
        $properties = [];
        foreach ($columns as $column) {
            $properties[] = "protected $" . $column['Field'] . ";";
        }
        return implode("\n    ", $properties);
    }

    function generateGetters($columns)
    {
        $getters = [];
        foreach ($columns as $column) {
            $getterName = 'get' . ucfirst($column['Field']);
            $getters[] = "public function $getterName()"
                . "\n    {"
                . "\n        return \$this->" . $column['Field'] . ";"
                . "\n    }";
        }
        return implode("\n\n    ", $getters);
    }

    function generateSetters($columns)
    {
        $setters = [];
        foreach ($columns as $column) {
            $setterName = 'set' . ucfirst($column['Field']);
            $setters[] = "public function $setterName(\$value)"
                . "\n    {"
                . "\n        \$this->" . $column['Field'] . " = \$value;"
                . "\n    }";
        }
        return implode("\n\n    ", $setters);
    }

    function setInsideConstructor($columns)
    {
        $p = [];
        foreach ($columns as $column) {
            $p[] = "    \$this->" . $column['Field'] . "=\${$column['Field']};";
        }
        return implode("\n", $p);
    }

    function forQuery($columns)
    {
        $q = [];
        foreach ($columns as $column) {
            $q[] = ":" . $column['Field'];
        }
        return implode(",", $q);
    }

    function queryParams($columns)
    {
        $q = [];
        foreach ($columns as $column) {
            $q[] = "':{$column['Field']}'" . "=>\$this->" . $column['Field'];
        }
        return "array(" . implode(",", $q) . ")";
    }

    function forUpdate($columns)
    {
        $q = [];

        foreach ($columns as $column) {
            if ($column['Field'] != 'id') :
                $q[] = "{$column['Field']}=:{$column['Field']}";
            endif;
        }
        return implode(",", $q);
    }

    function generateParams($columns)
    {
        $params = [];
        foreach ($columns as $column) {
            $params[] = "$" . $column['Field'];
        }
        return implode(",", $params);
    }

    function singularize($name)
    {
        $length = strlen($name);
        if ($length > 3 && substr($name, $length - 3) === 'ies') {
            return substr($name, 0, $length - 3) . 'y';
        } elseif ($length > 1 && substr($name, $length - 3) === 'ses') {
            return substr($name, 0, $length - 2);
        } elseif ($length > 1 && substr($name, $length - 1) === 's') {
            return substr($name, 0, $length - 1);
        }
        return $name;
    }


    public function generateModelFile($modelName, $columns)
    {
        $properties = $this->generateProperties($columns);
        $getters = $this->generateGetters($columns);
        $setters = $this->generateSetters($columns);
        $cons = $this->setInsideConstructor($columns);
        $params = $this->generateParams($columns);
        $tableName = strtolower($modelName);
        $modelName = ucfirst($this->singularize($modelName));
        $forquery = $this->forQuery($columns);
        $qparams = $this->queryParams($columns);
        $update = $this->forUpdate($columns);

        $modelTemplate = "<?php

namespace Makkari\Models;

use Makkari\Models\Model;

class $modelName extends Model
{
    $properties

    public function __construct($params)
    {
       {$cons}
    }

    $getters

    $setters

    public static function getAll(){
       
        \$m = Model::getInstance();
        \$list = [];
        \$r = \$m->all('{$tableName}');
        if(\$r){
            foreach(\$r as \$v){
                \$data = new {$modelName}(...\$v);
                \$list[] = \$data;
            }
        }
        return \$list;
    }

    public static function getById(\$value){
        \$m = Model::getInstance();
        \$data = NULL;
        \$r = \$m->getOne('{$tableName}','id', \$value);
        if(\$r){
            
            \$data = new {$modelName}(...\$r);
            
        }
        return \$data;
    }

    public function save(){
        \$m = Model::getInstance();
        if(\$this->id){
            \$query = 'UPDATE {$tableName} SET {$update} WHERE id=:id';
            \$params = {$qparams};
            \$result = \$m->executeQuery(\$query,\$params);
            return \$result->stmt->rowCount();
        }else{
            \$query = 'INSERT INTO {$tableName} VALUES ($forquery)';
            \$params = {$qparams};
            \$result = \$m->executeQuery(\$query,\$params);
            return \$result->stmt->rowCount();
        }
    }

    public function remove()
    {
        \$m = Model::getInstance();
        if(\$this->id){
            \$stmt=\$m->delete('{$tableName}',\$this->id);
            return \$stmt->stmt->rowCount();
        }
    }
}

";

        $filename = "Models/" . $modelName . ".php";
        if (file_exists($filename)) {
            echo "Error: Model file already exists.\n";
            return;
        }

        if (!file_put_contents($filename, $modelTemplate)) {
            echo "Error: Unable to create the model file.\n";
            return;
        }

        echo "Model {$modelName} created successfully!\n";
    }
}
