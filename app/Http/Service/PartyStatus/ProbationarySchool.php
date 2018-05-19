<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\Cert;
use App\Models\Probationary\EntryForm;
// 预备党员党校学习
class ProbationarySchool extends BaseWorkItem{

    /**
     * @return bool|void
     */
    public function to()
    {
        parent::to();

        if($this->isActive())
            return;

        $entryForm = EntryForm::where('sno', $this->userNumber)
            ->orderBy('entry_id', 'DESC')
            ->first();
        if($entryForm){

            $entryForm->fill([
                'entry_practicegrade' =>60,
                'entry_articlegrade' => 60,
                'entry_isallpassed' => 1,
                'is_systemadd' => 1,
                'entry_status' => EntryForm::ENTRY_NORMAL,
                'cert_isgrant' => 1,
                'pass_must' => 3,
                'pass_choose' => 1
            ]);
            $entryForm->save();
        }
        else{
            $entryForm = EntryForm::create([
                'train_id' => 1,
                'sno' => $this->userNumber,
                'entry_time' => date('Y-m-d H:i:s'),
                'entry_practicegrade' =>60,
                'entry_articlegrade' => 60,
                'entry_isallpassed' => 1,
                'is_systemadd' => 1,
                'entry_status' => EntryForm::ENTRY_NORMAL,
                'cert_isgrant' => 1,
                'pass_must' => 3,
                'pass_choose'=> 1
            ]);
        }

        Cert::create([
            'sno' => $this->userNumber,
            'entry_id' => $entryForm->entry_id,
            'cert_no' => date('ymdHis'),
            'cert_type' => Cert::CERT_PROBATIONARY,
            'cert_time' => date('Y-m-d H:i:s'),
            'cert_getperson' => '系统添加',
            'cert_place' => '系统添加',
            'cert_islost' => 0,
            'isdeleted' => 0
        ]);
    }

    public function cancel()
    {
        parent::cancel();

        if(!$this->isActive())
            return;

        EntryForm::where('sno', $this->userNumber)
            ->update([
                'entry_practicegrade' =>0,
                'entry_articlegrade' => 0,
                'entry_isallpassed' => 0,
                'is_systemadd' => 1,
                'entry_status' => EntryForm::ENTRY_NORMAL,
                'cert_isgrant' => 0,
                'pass_must' => 0,
                'pass_choose'=> 0
            ]);
        Cert::where(['sno' => $this->userNumber, 'cert_type' => Cert::CERT_PROBATIONARY])
            ->update([
                'isdeleted' => 1
            ]);
    }

    public function isActive()
    {
        return EntryForm::isPass($this->userNumber) &&
            boolval(Cert::getCertByTypeSno(Cert::CERT_APPLICANT, $this->userNumber));
    }
}