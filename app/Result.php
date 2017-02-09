<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Result\Result
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $test_id
 * @property string $title
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Result\Result whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Result\Result whereTestId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Result\Result whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Result\Result whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Result\Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Result\Result whereUpdatedAt($value)
 * @property-read \App\Models\Test\Test $test
 */
class Result extends Model
{
    public function test()
    {
        return $this->belongsTo("App\Test");
    }

    public static function createResult($test, $title, $value)
    {
        return (new Result())->addRecord($test, $title, $value);
    }
    public static function updateResult($result, $title, $value)
    {
        $result->addRecord($result->test, $title, $value);
    }
    public function addRecord($test, $title, $value)
    {
        $this->test()->associate($test);
        $this->title = $title;
        $this->value = $value;
        $this->save();
        return $this;
    }
}
