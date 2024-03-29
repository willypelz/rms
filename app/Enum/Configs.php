<?php

namespace App\Enum;


abstract class Configs
{
    const PRIVACY_KEY = 'privacy_policy';
    const COMPANY_MODEL = "\App\Models\Company";
    const GET_USER_DEFAULT_COMPANY = "api/v2/get_user_default_company/";
    const COMPANY_SUBSIDIARIES = "api/v2/company-subsidiaries/";
    const CAN_SWITCH_BETWEEN_COMPANY = "can-switch-across-companies";
    const DEFAULT_ADMIN_NAME = "John Doe";
    const DEFAULT_ADMIN_EMAIL =  "johndoe@seamlesshr.com";
    const PAGINATION_NUMBER = 10;
}
