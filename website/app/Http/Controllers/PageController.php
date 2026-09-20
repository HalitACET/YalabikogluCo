<?php

namespace App\Http\Controllers;

use App\Models\AxioDimension;
use App\Models\VisionValue;
use App\Models\Metric;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function axioMethod()
    {
        $dimensions = AxioDimension::orderBy('sort_order')->get();
        return view('pages.axio-method', compact('dimensions'));
    }

    public function vision()
    {
        $values = VisionValue::orderBy('sort_order')->get();
        return view('pages.vision', compact('values'));
    }

    public function caseStudies()
    {
        // 1. Metrics row
        $metrics = Metric::whereIn('placement', ['case_studies', 'both'])
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        // 2. Featured case study (Thomas M.)
        $featuredTestimonial = Testimonial::where('is_featured', true)
            ->where('is_published', true)
            ->first();

        // 3. Global mandates
        $testimonials = Testimonial::where('placement', 'case_studies')
            ->where('is_featured', false)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.case-studies', compact('metrics', 'featuredTestimonial', 'testimonials'));
    }

    /**
     * Contact page.
     *
     * Intentionally a GET-only, form-free page. Visitors contact the practice
     * through their own mail client or an external platform, so the site never
     * collects, transmits, or stores personal data and stays outside the scope
     * of KVKK/GDPR data-controller obligations. There is deliberately no POST
     * counterpart to this action.
     */
    public function contact()
    {
        return view('pages.contact', [
            'email' => config('contact.email'),
            'phone' => config('contact.phone'),
            'base' => config('contact.base'),
            'social' => config('contact.social', []),
        ]);
    }

    /**
     * Privacy page.
     *
     * Describes what the site does with visitor data, which is nothing. If the
     * site ever starts collecting something — a form, an analytics script, a
     * third-party embed, a session cookie — this page must be updated in the
     * same change.
     */
    public function privacy()
    {
        return view('pages.privacy', [
            'email' => config('contact.email'),
        ]);
    }
}
