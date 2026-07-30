<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default Export Settings
    |--------------------------------------------------------------------------
    |
    | These settings control the default behavior of exports.
    |
    */

    'exports' => [

        /*
        |--------------------------------------------------------------------------
        | Chunk Size
        |--------------------------------------------------------------------------
        |
        | When exporting large datasets, Laravel Excel can chunk the query results
        | to avoid memory issues. Here you can define how many rows should be
        | retrieved per chunk.
        |
        */
        'chunk_size' => 1000,

        /*
        |--------------------------------------------------------------------------
        | Pre-calculate Formulas During Export
        |--------------------------------------------------------------------------
        */
        'pre_calculate_formulas' => false,

        /*
        |--------------------------------------------------------------------------
        | Enable strict null comparison
        |--------------------------------------------------------------------------
        */
        'strict_null_comparison' => false,

        /*
        |--------------------------------------------------------------------------
        | CSV Settings
        |--------------------------------------------------------------------------
        */
        'csv' => [
            'delimiter' => ',',
            'enclosure' => '"',
            'line_ending' => "\n",
            'use_bom' => false,
            'include_separator_line' => false,
            'excel_compatibility' => false,
        ],

        /*
        |--------------------------------------------------------------------------
        | Default Writer Type
        |--------------------------------------------------------------------------
        */
        'default_writer' => \Maatwebsite\Excel\Excel::XLSX,
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Import Settings
    |--------------------------------------------------------------------------
    |
    | These settings control the default behavior of imports.
    |
    */

    'imports' => [

        /*
        |--------------------------------------------------------------------------
        | Read Only
        |--------------------------------------------------------------------------
        |
        | When dealing with imports, you might only be interested in the data that
        | the file contains. By default, the import will not keep any formatting
        | information. Set this to true if you want to read the file in read-only mode.
        |
        */
        'read_only' => true,

        /*
        |--------------------------------------------------------------------------
        | Ignore Empty Cells
        |--------------------------------------------------------------------------
        |
        | By default, empty cells are not ignored. If you want to ignore them,
        | you can enable this setting.
        |
        */
        'ignore_empty' => false,

        /*
        |--------------------------------------------------------------------------
        | Heading Row Formatter
        |--------------------------------------------------------------------------
        |
        | Configure the heading row formatter. By default, the heading row
        | formatter is set to 'slug'. This means that each heading will be
        | converted to a slug. You can change this to 'none' if you want to
        | keep the original headings.
        |
        */
        'heading_row' => [
            'formatter' => 'slug',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Extension Detector
    |--------------------------------------------------------------------------
    |
    | Configure here which writer/reader type should be used when the package
    | needs to guess the file type based on the extension alone.
    |
    */
    'extension_detector' => [
        'xlsx' => \Maatwebsite\Excel\Excel::XLSX,
        'xlsm' => \Maatwebsite\Excel\Excel::XLSX,
        'xltx' => \Maatwebsite\Excel\Excel::XLSX,
        'xltm' => \Maatwebsite\Excel\Excel::XLSX,
        'xls' => \Maatwebsite\Excel\Excel::XLS,
        'xlt' => \Maatwebsite\Excel\Excel::XLS,
        'ods' => \Maatwebsite\Excel\Excel::ODS,
        'ots' => \Maatwebsite\Excel\Excel::ODS,
        'csv' => \Maatwebsite\Excel\Excel::CSV,
        'tsv' => \Maatwebsite\Excel\Excel::TSV,
        'html' => \Maatwebsite\Excel\Excel::HTML,
        'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
    ],

    /*
    |--------------------------------------------------------------------------
    | Value Binder
    |--------------------------------------------------------------------------
    |
    | PhpSpreadsheet offers a way to hook into the process of a value being
    | written to a cell. In this config, you can specify your own default
    | value binder.
    |
    */
    'value_binder' => [
        'default' => Maatwebsite\Excel\DefaultValueBinder::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Transactions
    |--------------------------------------------------------------------------
    |
    | By default, the import is wrapped in a transaction. This is useful
    | for when an import may fail and you want to retry it. With the
    | transactions, the database changes won't be committed.
    |
    | You can disable the transaction by setting this to false.
    |
    */
    'transactions' => [
        'enabled' => true,
        'handler' => 'db',
    ],

    /*
    |--------------------------------------------------------------------------
    | Temporary Path
    |--------------------------------------------------------------------------
    |
    | When exporting and importing files, we sometimes need a temporary file.
    | By default, the temporary file is stored in the `storage/framework/laravel-excel`
    | directory. You can customize that here.
    |
    */
    'temporary_files' => [
        'local_path' => storage_path('framework/laravel-excel'),
        'remote_disk' => null,
        'remote_prefix' => null,
        'force_resync_remote' => null,
    ],
];