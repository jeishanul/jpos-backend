<?php

namespace App\Repositories;

use App\Models\CompanyInfo;

class CompanyInfoRepository extends Repository
{
    /**
     * A description of the entire PHP function.
     *
     * @return CompanyInfo::class
     */
    public static function model()
    {
        return CompanyInfo::class;
    }
    /**
     * Store company information by request.
     *
     * @param Request $request The request object
     * @param User $user The user object
     * @return CompanyInfo
     */
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
    /**
     * Updates the company information based on the given request and user.
     *
     * @param datatype $request description
     * @param datatype $user description
     * @return CompanyInfo
     */
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
