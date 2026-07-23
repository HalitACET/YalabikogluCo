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
}
