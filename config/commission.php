<?php

return [
    'max_file_size' => env('COMMISSION_MAX_FILE_SIZE', 4096),
    'max_size' => env('COMMISSION_MAX_SIZE', 10420),
    'days_to_archive' => env('COMMISSION_DAYS_TO_ARCHIVE', 7),
    'sales_tax' => env('COMMISSION_SALES_TAX', 0.06)
];
