<?php

namespace App;

use App\User;
use App\Test;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Report\Report
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property integer $operation_id
 * @property string $operator_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Report\Report whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Report\Report whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Report\Report whereOperationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Report\Report whereOperatorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Report\Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Report\Report whereUpdatedAt($value)
 * @property integer $patient_id
 * @property-read \App\User $operator
 * @property-read \App\User $patient
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Report\Report wherePatientId($value)
 */
class Report extends Model
{
    public function operator()
    {
        return $this->belongsTo("App\User", "operator_id");
    }

    public function patient()
    {
        return $this->belongsTo("App\User", "patient_id");
    }

    public function tests()
    {
        return $this->hasMany("App\Test", "report_id");
    }

    public static function createReport(User $operator, User $patient, $tests, $savedInDatabase = true)
    {
        return (new Report())->addRecord($operator, $patient, $tests, $savedInDatabase);
    }

    public function addRecord(User $operator, User $patient, $tests)
    {
        $this->operator()->associate($operator);
        $this->patient()->associate($patient);
        $this->save();
        foreach ($tests as $test)
            if (empty($test["id"]))
                \App\Test::createTest($this, empty($test["title"]) ? "" : $test["title"], empty($test["desc"]) ? "" : $test["desc"], empty($test["results"]) ? [] :$test["results"]);
    
            else
                \App\Test::updateTest(\App\Test::findOrFail($test["id"]),empty($test["title"]) ? "" : $test["title"], empty($test["desc"]) ? "" : $test["desc"], empty($test["results"]) ? [] :$test["results"]);
        return $this;
    }
}
