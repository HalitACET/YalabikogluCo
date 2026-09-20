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
    |--------------------------------------------------------------------------
    | Scheduling Link
    |--------------------------------------------------------------------------
    | An external booking page (Calendly or similar). The "Request Executive
    | Briefing" buttons point here when it is set, and fall back to the contact
    | page when it is empty, so the site works either way.
    |
    | This is a LINK, not an embed, and it must stay one. Embedding a Calendly
    | widget would run their JavaScript on our pages, set their cookies and
    | hand every visitor's IP address to them on page load — which would make
    | the contact and privacy pages untrue and require a consent banner.
    | A link is only followed if the visitor chooses to, exactly like the
    | LinkedIn and Medium links in the footer.
    */
    'booking_url' => env('CONTACT_BOOKING_URL'),

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
