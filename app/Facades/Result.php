<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: reza
 * Date: 9/22/16
 * Time: 8:59 PM
 */

/**
 * Class Report
 * @package App\Facades
 * @method static createResult($test, $title, $value)
 */
class Result extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "model.result";
    }


}