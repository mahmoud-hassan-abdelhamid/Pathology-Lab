<?php

namespace App;

use App\Decorations\Results\ResultCRUD;
use App\Result;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Test\Test
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $report_id
 * @property string $title
 * @property string $desc
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Test\Test whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Test\Test whereReportId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Test\Test whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Test\Test whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Test\Test whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Test\Test whereUpdatedAt($value)
 * @property-read \App\Models\Report\Report $report
 */
class Test extends Model
{
    public function report()
    {
        return $this->belongsTo("App\Report");
    }

    public function results()
    {
        return $this->hasMany("App\Result");
    }

    public static function createTest($report, $title, $desc, $results)
    {
        return (new Test())->addRecord($report, $title, $desc, $results);
    }

    public static function updateTest($test, $title, $desc, $results)
    {
        $test->addRecord($test->report, $title, $desc, $results);
    }

    public function addRecord($report, $title, $desc, $results)
    {
        $this->report()->associate($report);
        $this->title = $title;
        $this->desc = $desc;
        $this->save();
        foreach ($results as $result)
            if (empty($result["id"]))
                \App\Result::createResult($this,$result["title"], $result["value"]);
            else
                \App\Result::updateResult(Result::findOrFail($result["id"]), $result["title"], $result["value"]);
    }
}
