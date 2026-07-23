<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Testimonial;
use App\Models\Metric;
use App\Models\VisionValue;
use App\Models\AxioDimension;
use App\Models\Page;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin Kullanıcısını Oluştur
        $this->call(AdminUserSeeder::class);

        // 2. Disciplines (Disiplinler / Hizmetler)
        $d1 = Discipline::create([
            'slug' => 'mergers-and-acquisitions',
            'sort_order' => 1,
            'is_published' => false,
        ]);
        $d1->translations()->create([
            'locale' => 'en',
            'title' => 'Mergers & Acquisitions',
            'dek' => 'Comprehensive buy-side and sell-side advisory services for mid-market corporate transactions.',
            'pull_quote' => 'Maximizing enterprise value through strategic alignment and expert execution.',
            'areas_of_focus' => [
                ['title' => 'Sell-Side Advisory', 'description' => 'Guiding shareholders through successful business divestitures and exits.'],
                ['title' => 'Buy-Side Advisory', 'description' => 'Identifying, evaluating, and executing strategic acquisition targets.'],
                ['title' => 'Strategic Partnerships', 'description' => 'Structuring joint ventures and tactical alliances.']
            ]
        ]);

        $d2 = Discipline::create([
            'slug' => 'debt-advisory',
            'sort_order' => 2,
            'is_published' => false,
        ]);
        $d2->translations()->create([
            'locale' => 'en',
            'title' => 'Debt Advisory',
            'dek' => 'Bespoke capital raising and optimization solutions across the entire debt spectrum.',
            'pull_quote' => 'Designing flexible debt structures that support corporate growth objectives.',
            'areas_of_focus' => [
                ['title' => 'Growth Capital', 'description' => 'Securing senior debt and mezzanine financing for business expansion.'],
                ['title' => 'Debt Refinancing', 'description' => 'Optimizing existing credit facilities to improve cost and covenants.'],
                ['title' => 'Special Situations', 'description' => 'Structuring rescue financing and liquidity solutions during transitions.']
            ]
        ]);

        // 3. Testimonials (Müşteri Yorumları)
        $t1 = Testimonial::create([
            'person_name' => 'John Carter',
            'role' => 'Chief Executive Officer',
            'city' => 'London',
            'placement' => 'home',
            'sort_order' => 1,
            'is_published' => false,
        ]);
        $t1->translations()->create([
            'locale' => 'en',
            'quote' => 'Their strategic insight and transaction execution capabilities were pivotal in achieving our recent corporate recapitalization.',
        ]);

        $t2 = Testimonial::create([
            'person_name' => 'Elena Vītola',
            'role' => 'Managing Director',
            'city' => 'Riga',
            'placement' => 'both',
            'sort_order' => 2,
            'is_published' => false,
        ]);
        $t2->translations()->create([
            'locale' => 'en',
            'quote' => 'An exceptionally professional partner. Their deep understanding of international debt markets proved crucial to our expansion.',
        ]);

        // 4. Metrics (Metrikler / Başarı Rakamları)
        $m1 = Metric::create([
            'value' => '200+',
            'placement' => 'home',
            'sort_order' => 1,
            'is_published' => false,
        ]);
        $m1->translations()->create([
            'locale' => 'en',
            'label' => 'Transactions Successfully Executed',
        ]);

        $m2 = Metric::create([
            'value' => '€1.8B+',
            'placement' => 'both',
            'sort_order' => 2,
            'is_published' => false,
        ]);
        $m2->translations()->create([
            'locale' => 'en',
            'label' => 'Total Advisory Value',
        ]);

        // 5. Vision & Values (Vizyon ve Değerler)
        $v1 = VisionValue::create([
            'sort_order' => 1,
        ]);
        $v1->translations()->create([
            'locale' => 'en',
            'title' => 'Client First',
            'description' => 'We maintain absolute independence and alignment with our clients’ long-term interests.',
        ]);

        $v2 = VisionValue::create([
            'sort_order' => 2,
        ]);
        $v2->translations()->create([
            'locale' => 'en',
            'title' => 'Absolute Integrity',
            'description' => 'Uncompromising professional ethics and confidentiality govern all our engagements.',
        ]);

        // 6. Axio Dimensions (Axio Metodu Boyutları)
        $a1 = AxioDimension::create([
            'sort_order' => 1,
        ]);
        $a1->translations()->create([
            'locale' => 'en',
            'title' => 'Strategic Blueprinting',
            'description' => 'Aligning corporate strategy with corporate finance options before entering the market.',
        ]);

        $a2 = AxioDimension::create([
            'sort_order' => 2,
        ]);
        $a2->translations()->create([
            'locale' => 'en',
            'title' => 'Covenant Optimization',
            'description' => 'Negotiating terms that preserve operational freedom and support strategic flexibility.',
        ]);

        // 7. Pages SEO (Sayfaların Meta Verileri)
        $pages = [
            'home' => ['title' => 'Premium Corporate Finance Advisory', 'desc' => 'Elite financial advisory for mid-market corporate transactions, mergers, and debt placement.'],
            'disciplines' => ['title' => 'Our Core Disciplines & Expertise', 'desc' => 'Explore our specialized transaction capabilities in Mergers & Acquisitions, Debt Advisory, and Strategic Corporate Finance.'],
            'axio-method' => ['title' => 'The Axio Method — Capital Architecture', 'desc' => 'Our proprietary framework for structuring optimal corporate capital, balance sheet restructuring, and transaction strategy.'],
            'case-studies' => ['title' => 'Deal History & Success Stories', 'desc' => 'A selected track record of completed M&A transactions, capital raises, and restructuring advisory.'],
            'vision' => ['title' => 'Our Core Vision, Values & Philosophy', 'desc' => 'The principles of independence, alignment, and analytical excellence that drive our corporate advisory relationships.'],
            'contact' => ['title' => 'Partner With Our Advisory Team', 'desc' => 'Contact our corporate finance advisors to discuss your capital requirements, divestment strategy, or acquisitions.'],
            'privacy' => ['title' => 'Privacy Policy & Terms of Service', 'desc' => 'How we protect and manage your corporate data and personal information in compliance with GPDR.'],
        ];

        foreach ($pages as $slug => $seo) {
            $p = Page::create(['slug' => $slug]);
            $p->translations()->create([
                'locale' => 'en',
                'meta_title' => $seo['title'],
                'meta_description' => $seo['desc'],
            ]);
        }
    }
}
