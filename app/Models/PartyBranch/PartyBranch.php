<?php

namespace App\Models\PartyBranch;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PartyBranch
 * 党支部
 * @package App\Models\PartyBranch
 */
class PartyBranch extends Model
{
    //
    protected $table = "twt_partybranch";

    /**
     * 按学院
     * @param $college
     * @return array
     */
    public static function college($college){
        $res = array();
        foreach ($college as $i => $v){
            $res[$i]['college'] = $v->shortname;

            //本科生
            $undergraduate = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 1)
                ->get();
            $num_undergraduate = count($undergraduate);
            $res[$i]['undergraduate'] = $num_undergraduate;

            //硕士生
            $master = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 2)
                ->get();
            $num_master = count($master);
            $res[$i]['master'] = $num_master;

            //博士生
            $doctor = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 3)
                ->get();
            $num_doctor = count($doctor);
            $res[$i]['doctor'] = $num_doctor;

            //混合党支部
            $mix = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_academy', $v->id)
                ->where('partybranch_type', 1)
                ->get();
            $num_mix = count($mix);
            $res[$i]['mix'] = $num_mix;
        }
        return $res;
    }
    
    public static function grade($grade)
    {
        $res = array();
        foreach ($grade as $i => $v) {
            $res[$i]['grade'] = $v->grade;

            //本科生
            $undergraduate = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_schoolyear', $v->grade)
                ->where('partybranch_type', 1)
                ->get();
            $num_undergraduate = count($undergraduate);
            $res[$i]['undergraduate'] = $num_undergraduate;

            //硕士生
            $master = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_schoolyear', $v->grade)
                ->where('partybranch_type', 2)
                ->get();
            $num_master = count($master);
            $res[$i]['master'] = $num_master;

            //博士生
            $doctor = self::where('partybranch_ishidden', 0)
                ->where('partybranch_isdeleted', 0)
                ->where('partybranch_schoolyear', $v->grade)
                ->where('partybranch_type', 3)
                ->get();
            $num_doctor = count($doctor);
            $res[$i]['doctor'] = $num_doctor;

        }
        return $res;
    }

    public static function category(){
        //本科生
        $undergraduate = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 1)
            ->get();
        $num_undergraduate = count($undergraduate);

        //硕士生
        $master = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 2)
            ->get();
        $num_master = count($master);

        //博士生
        $doctor = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 3)
            ->get();
        $num_doctor = count($doctor);

        //混合党支部
        $mix = self::where('partybranch_ishidden', 0)
            ->where('partybranch_isdeleted', 0)
            ->where('partybranch_type', 1)
            ->get();
        $num_mix = count($mix);

        return [
            'undergraduate' => $num_undergraduate,
            'master' => $num_master,
            'doctor' => $num_doctor,
            'mix' => $num_mix
        ];
    }
}
