<?php

namespace App\Enum;

class EnvSettingsEnum extends SeamlessHiringEnumBase
{
    const APP_ENV = 'production';
    const APP_DEBUG = 'false';
    const APP_KEY = 'l2TsPdmAjApWVULMZGoNRjGfSeXjn0e7';

    const DB_HOST= '127.0.0.1';
    const DB_DATABASE = 'rms-multi';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = null;

    const LOG_CHANNEL = 'daily';
    const CACHE_DRIVER = 'file';
    const SESSION_DRIVER = 'file';
    const QUEUE_DRIVER = 'sync';

    const REDIS_HOST = '127.0.0.1';
    const REDIS_PASSWORD = null;
    const REDIS_PORT = '6379';

    const SOLR_URL = null;
    const SOLR_CORE = null;

    const FILEUPLOAD = 'uploads';

    const CAPTCHA_SECRET = null;
    const CAPTCHA_SITEKEY = null;

    const MAIL_ENCRYPTION = 'tls';

    const ALGOLIA_APP_ID = null;
    const ALGOLIA_SECRET = null;

    const SEARCH_ENGINE_ID = null;
    const SEARCH_ENGINE_SECRET = null;

    const USE_ACTIVE_DIRECTORY = false;

    const SENTRY_LARAVEL_DSN = 'https://ecab7db709a1431080ed1a11c76c01bb@o173819.ingest.sentry.io/5912775';

    const RMS_STAND_ALONE = true;

    const COMPANY_EMAIL = 'support@seamlesshr.com';
    const COMPANY_NAME = 'Seamless HR';

    const SEAMLESS_HIRING_LOGO_WHITE = 'http://seamlesshr.seamlesshiring.com/img/seamlesshiring-logo-white.png';
    const SEAMLESS_HIRING_LOGO = 'http://seamlesshr.seamlesshiring.com/img/seamlesshiring-logo.png';

    const FACEBOOK_URL = 'https://www.facebook.com/';
    const TWITTER_URL = 'https://www.twitter.com/';
    const LINKEDIN_URL = 'https://www.linkedin.com/';
    const INSTAGRAM_URL = 'https://www.instagram.com/';

    const STAFFSTRENGTH_URL = 'https://hrms.test';
    const STAFFSTRENGTH_NAME = 'HRMS';

    const APP_LOGO = 'http://seamlesshr.seamlesshiring.com/img/seamlesshiring-logo.png';
    const APP_URL = 'https://seamlesshiring.test';

    const CUSTOM_STYLE = 'green-africa';
    const SEAMLESS_TESTING_APP_URL = 'https://testing.test';
    const SEAMLESS_QUESTION_APP_URL = 'https://test_platform.test';

    const PAGINATION = 100;

    const IDLE_PERIOD_SESSION_TIMEOUT = 900;
    const SHELL_VERBOSITY = 0;

    const MAIL_MAILER = 'smtp';
    const MAIL_HOST = 'smtp.mailtrap.io';
    const MAIL_USERNAME = null;
    const MAIL_PASSWORD = null;
    const MAIL_PORT = 2525;

    const SEARCH_ENGINE = 'solr';

    const AGE_START = 15;
    const AGE_END = 50;

    const EXPERIENCE_START = 0;
    const EXPERIENCE_END = 50;

}