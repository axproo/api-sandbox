<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{

    public static function alertService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('alertService');
        }

        $request = service('request');
        return new \App\Services\AlertService($request);
    }


    public static function buttonService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('buttonService');
        }

        $request = service('request');
        return new \App\Services\ButtonService($request);
    }


    public static function mailerService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('mailerService');
        }

        $request = service('request');
        return new \App\Services\MailerService($request);
    }


    public static function otpService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('otpService');
        }

        $request = service('request');
        return new \App\Services\OtpService($request);
    }


    public static function formTypeService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('formTypeService');
        }

        $request = service('request');
        return new \App\Services\FormTypeService($request);
    }


    public static function userService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        $request = service('request');
        return new \App\Services\UserService($request);
    }


    public static function authService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authService');
        }

        $request = service('request');
        return new \App\Services\AuthService($request);
    }

    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */
}
