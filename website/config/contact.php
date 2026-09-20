<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Direct Contact Channels
    |--------------------------------------------------------------------------
    | The contact page deliberately has NO form. Visitors reach out through
    | their own mail client or an external platform, which means this site
    | never receives, processes, or stores anyone's personal data.
    |
    | Do not add a form, a newsletter field, or an analytics snippet here
    | without first re-checking the KVKK/GDPR position — the whole point of
    | this page is that the site is not a data controller.
    */

    'email' => env('CONTACT_EMAIL', 'contact@yalabikoglu.co'),

    /*
    | Optional. Leave null to hide the row entirely.
    */
    'phone' => env('CONTACT_PHONE'),

    /*
    | Where the practice operates from. Shown as plain text, not a map embed —
    | third-party map iframes set cookies and would reintroduce the problem.
    */
    'base' => env('CONTACT_BASE', 'Riga, Latvia'),

    'social' => [
        'LinkedIn' => 'https://linkedin.com/company/yalabikogluandco',
        'Medium' => 'https://medium.com/@efeyalabikoglu',
        'Instagram' => 'https://instagram.com/yalabikogluco',
    ],

];
