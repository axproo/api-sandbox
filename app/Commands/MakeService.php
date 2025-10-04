<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class MakeService extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Custom';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Génère un service ci4 dans app/Services';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'command:name [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $name = array_shift($params);

        if (!$name) {
            CLI::error('Veuillez spécifier un nom de service. Exemple : php spark make:service PasswordService');
            return;
        }

        // Vérifie si l’option --suffix est présente
        $addSuffix = CLI::getOption('suffix');

        // Convertit en CamelCase
        $originalName = $this->toCamelCase($name);

        // Appliquer le suffixe si nécessaire
        $className = $addSuffix && !str_ends_with($originalName, 'Service')
            ? $originalName . 'Service'
            : $originalName;

        $servicePath = APPPATH . "Services/{$className}.php";
        $servicesConfigPath = APPPATH . 'Config/Services.php';
        $methodName = lcfirst($className);

        // Vérifie si le service existe déjà
        if (is_file($servicePath)) {
            CLI::error("Le service '{$className}' existe déjà.");
            return;
        }

        // Génère le contenu du service
        $serviceTemplate = <<<PHP
<?php
namespace App\Services;

use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class {$className}
{
    protected IncomingRequest \$request;
    protected \$validate;
    protected \$validation;

    public function __construct(IncomingRequest \$request)
    {
        \$this->request = \$request;
        \$this->validate = new Validation();
        \$this->validation = Services::validation();
    }

    // Ajoutez vos méthodes ici
}
PHP;

        if (!write_file($servicePath, $serviceTemplate)) {
            CLI::error("Impossible d'écrire dans {$servicePath}");
            return;
        }

        CLI::write("✅ Service créé : app/Services/{$className}.php", 'green');

        // Injection dans Config\Services.php
        $factoryMethod = <<<PHP

    public static function {$methodName}(bool \$getShared = true)
    {
        if (\$getShared) {
            return static::getSharedInstance('{$methodName}');
        }

        \$request = service('request');
        return new \\App\\Services\\{$className}(\$request);
    }

PHP;

        $configContent = file_get_contents($servicesConfigPath);

        if (strpos($configContent, "function {$methodName}(") !== false) {
            CLI::write("⚠️ La méthode {$methodName} existe déjà dans Services.php", 'yellow');
            return;
        }

        $updatedContent = preg_replace(
            '/(class Services extends BaseService\s*\{)/',
            "\$1\n{$factoryMethod}",
            $configContent
        );

        if (!file_put_contents($servicesConfigPath, $updatedContent)) {
            CLI::error("Impossible de modifier Config/Services.php");
            return;
        }

        CLI::write("🔗 Méthode ajoutée à Config\\Services.php", 'yellow');
    }

    protected function toCamelCase(string $string) : string {
        return str_replace(" ", "", ucwords(str_replace(['-','_'], ' ', $string)));
    }
}
