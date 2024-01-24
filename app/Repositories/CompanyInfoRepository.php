<?php

namespace App\Repositories;

use App\Models\CompanyInfo;

class CompanyInfoRepository extends Repository
{
    public static function model()
    {
        return CompanyInfo::class;
    }
    public static function storeByRequest($request): CompanyInfo
    {
        return self::create([]);
    }
    public static function updateByRequest($request, CompanyInfo $companyInfo): CompanyInfo
    {
        self::update($companyInfo, []);
        return $companyInfo;
    }
}
