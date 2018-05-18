<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 02/04/2018
 * Time: 10:52 AM
 */

namespace App\Http\Service\PartyStatus;

use App\Models\Academy\EntryForm;
use App\Models\Cert;
//院级积极分子党校学习
class AcademyPartySchool extends BaseWorkItem{

    public function to()
    {
        parent::to();

        if($this->isActive())
            return false;

        $entryForm = EntryForm::where('sno', $this->userNumber)
            ->orderBy('entry_id', 'DESC')
            ->first();
        if($entryForm){
            $entryForm->fill([
                'entry_practicegrade' =>60,
                'entry_articlegrade' => 60,
                'entry_ispassed' => 1,
                'entry_status' => 1,
                'cert_isgrant' => 0
            ]);
            $entryForm->save();
        }
        else{
            $entryForm = EntryForm::create([
                'test_id' => 1,
                'sno' => $this->userNumber,
                'entry_time' => date('Y-m-d H:i:s'),
                'entry_practicegrade' =>60,
                'entry_articlegrade' => 60,
                'entry_islastadded' => 1,
                'is_systemadd' => 1,
                'entry_ispassed' => 1 ,
                'entry_status' => 1 ,
                'cert_isgrant' => 0
            ]);
        }

        $cert = Cert::create([
            'sno' => $this->userNumber,
            'entry_id' => $entryForm->entry_id,
            'cert_no' => date('ymdHis'),
            'cert_type' => Cert::CERT_ACADEMY,
            'cert_time' => date('Y-m-d H:i:s'),
            'cert_getperson' => '系统添加',
            'cert_place' => '系统添加',
            'cert_islost' => 0,
            'isdeleted' => 0
        ]);
        return boolval($entryForm && $cert);
    }

    public function cancel()
    {
        parent::cancel();

        if(!$this->isActive())
            return false;

        $entryForm = EntryForm::where('sno', $this->userNumber)
            ->update([
                'entry_practicegrade' =>0,
                'entry_articlegrade' => 0,
                'entry_ispassed' => 0,
                'entry_status' => EntryForm::ENTRY_NORMAL,
                'cert_isgrant' => 0
            ]);
        $cert = Cert::where(['sno' => $this->userNumber, 'cert_type' => Cert::CERT_ACADEMY])
            ->update([
                'isdeleted' => 1
            ]);
        return boolval($entryForm && $cert);
    }

    public function isActive()
    {
        // 通过考试并成功发放证书
        return EntryForm::isPass($this->userNumber)
            && boolval(Cert::getCertByTypeSno(Cert::CERT_ACADEMY, $this->userNumber));
    }
}