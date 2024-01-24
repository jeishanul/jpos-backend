<?php

namespace App\Repositories;

use App\Models\CompanyInfo;

class CompanyInfoRepository extends Repository
{
    public static function model()
    {
        return CompanyInfo::class;
    }
    public static function storeByRequest($request, $user): CompanyInfo
    {
        return self::create([
            'user_id' => $user->id,
            'name' => $request->company_name,
            'phone_number' => $request->busniss_phone_number,
            'email' => $request->busniss_email,
            'vat_number' => $request->vat_number,
        ]);
    }
    public static function updateByRequest($request, $user): CompanyInfo
    {
        self::update($user->companyInfo, [
            'name' => $request->company_name,
            'phone_number' => $request->busniss_phone_number,
            'email' => $request->busniss_email,
            'vat_number' => $request->vat_number,
        ]);
        return $user->companyInfo;
    }
}
