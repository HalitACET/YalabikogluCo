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

        // 2. Disciplines (4, in this order)
        $d1 = Discipline::create([
            'slug' => 'executive-presence',
            'sort_order' => 1,
            'is_published' => false,
        ]);
        $d1->translations()->create([
            'locale' => 'en',
            'title' => 'Executive Presence & Communication Axiology',
            'dek' => 'Aligning language, behaviour, and values into a coherent executive identity.',
            'pull_quote' => 'Authority is not asserted. It is perceived.',
            'areas_of_focus' => [
                ['title' => 'Executive Presence', 'description' => 'Executive presence, behavioural congruence, and environmental awareness'],
                ['title' => 'Verbal Axiology', 'description' => 'Communicating core values through linguistic precision'],
                ['title' => 'Non-Verbal Calibration', 'description' => 'Including posture, gesture, spatial command, and vocal delivery'],
                ['title' => 'Behavioural Observation', 'description' => 'Conversational subtext and interpersonal pattern recognition'],
                ['title' => 'Negotiation Dynamics', 'description' => 'High-stakes negotiation dynamics and executive influence']
            ]
        ]);

        $d2 = Discipline::create([
            'slug' => 'executive-positioning',
            'sort_order' => 2,
            'is_published' => false,
        ]);
        $d2->translations()->create([
            'locale' => 'en',
            'title' => 'Executive Positioning & Behavioural Intelligence',
            'dek' => 'Understanding human behaviour to shape strategic outcomes.',
            'pull_quote' => 'Influence begins where understanding exceeds assumption.',
            'areas_of_focus' => [
                ['title' => 'Behavioural Analysis', 'description' => 'Behavioural analysis and executive decision-making patterns'],
                ['title' => 'Cognitive Tendencies', 'description' => 'Communication defaults, cognitive tendencies, and strategic adaptability'],
                ['title' => 'Executive Positioning', 'description' => 'Executive positioning and long-term professional reputation'],
                ['title' => 'Sovereign Influence', 'description' => 'Influence without manipulation through behavioural awareness'],
                ['title' => 'Enduring Authority', 'description' => 'Building enduring authority across organisations and industries']
            ]
        ]);

        $d3 = Discipline::create([
            'slug' => 'self-mastery',
            'sort_order' => 3,
            'is_published' => false,
        ]);
        $d3->translations()->create([
            'locale' => 'en',
            'title' => 'Executive Self-Mastery & Personal Architecture',
            'dek' => 'Translating self-awareness, temporal discipline, and strategic clarity into long-term sovereign trajectory.',
            'pull_quote' => 'Mastery of circumstance begins with total governance of the self.',
            'areas_of_focus' => [
                ['title' => 'Cognitive Self-Awareness & Internal Auditing', 'description' => 'Deconstructing psychological defaults and blind spots'],
                ['title' => 'Temporal Architecture & High-Yield Resource Allocation', 'description' => 'Structuring focus and mental energy as strategic capital'],
                ['title' => 'Goal Alignment & Strategic Trajectory', 'description' => 'Mapping precise multi-year personal benchmarks'],
                ['title' => 'Resilience Mechanics & Pressure Calibration', 'description' => 'Mental fortitude and composure during extreme volatility'],
                ['title' => 'Personal Sovereignty & Executive Discipline', 'description' => 'Cultivating non-negotiable internal standards']
            ]
        ]);

        $d4 = Discipline::create([
            'slug' => 'strategic-messaging',
            'sort_order' => 4,
            'is_published' => false,
        ]);
        $d4->translations()->create([
            'locale' => 'en',
            'title' => 'Strategic Messaging, Media & Institutional Communication',
            'dek' => 'Designing narratives that strengthen credibility, protect reputation, and inspire confidence.',
            'pull_quote' => 'The organisations that communicate with clarity are the organisations that earn trust.',
            'areas_of_focus' => [
                ['title' => 'Media Training', 'description' => 'Executive media training and on-camera communication'],
                ['title' => 'Institutional Messaging', 'description' => 'Institutional messaging and stakeholder communication'],
                ['title' => 'Public Appearances', 'description' => 'High-stakes interviews, panel discussions, and public appearances'],
                ['title' => 'Crisis Communication', 'description' => 'Crisis communication and reputation management principles'],
                ['title' => 'Narrative Strategy', 'description' => 'Narrative strategy for organisations, founders, and public figures']
            ]
        ]);

        // 3. Axio Dimensions (4, in this order)
        $a1 = AxioDimension::create(['sort_order' => 1]);
        $a1->translations()->create([
            'locale' => 'en',
            'title' => 'Awareness',
            'description' => 'Understanding behavioural patterns, cognitive defaults, internal blind spots, and executive perception.',
        ]);

        $a2 = AxioDimension::create(['sort_order' => 2]);
        $a2->translations()->create([
            'locale' => 'en',
            'title' => 'Alignment',
            'description' => 'Ensuring language, values, non-verbal behaviour, and personal architecture operate with complete consistency.',
        ]);

        $a3 = AxioDimension::create(['sort_order' => 3]);
        $a3->translations()->create([
            'locale' => 'en',
            'title' => 'Influence',
            'description' => 'Communicating complex ideas with structural clarity, credibility, and strategic precision.',
        ]);

        $a4 = AxioDimension::create(['sort_order' => 4]);
        $a4->translations()->create([
            'locale' => 'en',
            'title' => 'Outcome',
            'description' => 'Translating personal governance and communication architecture into measurable organisational, commercial, and leadership results.',
        ]);

        // 4. Vision Values (6, in this order)
        $v1 = VisionValue::create(['sort_order' => 1]);
        $v1->translations()->create([
            'locale' => 'en',
            'title' => 'Uncompromising Authenticity',
            'description' => 'True presence is not performative; it is the total elimination of incongruence. We strip away superficial rhetoric and artificial behaviours to construct a commanding executive presence rooted in core values and structural alignment.',
        ]);

        $v2 = VisionValue::create(['sort_order' => 2]);
        $v2->translations()->create([
            'locale' => 'en',
            'title' => 'Empirical Efficacy Over Theory',
            'description' => 'Every framework deployed within The AXIO Method™ is stress-tested in real-world high-stakes environments. We reject ideas that sound sophisticated but fail under pressure.',
        ]);

        $v3 = VisionValue::create(['sort_order' => 3]);
        $v3->translations()->create([
            'locale' => 'en',
            'title' => 'Continuous Analytical Evolution',
            'description' => 'The dynamics of global influence and institutional governance are constantly shifting. I hold my practice to the highest analytical and academic standards.',
        ]);

        $v4 = VisionValue::create(['sort_order' => 4]);
        $v4->translations()->create([
            'locale' => 'en',
            'title' => 'Bespoke Human Architecture',
            'description' => 'High-stakes leaders require surgical, highly tailored solutions. Every engagement is calibrated to your specific psychological profile, organisational dynamics, cultural context, and long-term strategic trajectory.',
        ]);

        $v5 = VisionValue::create(['sort_order' => 5]);
        $v5->translations()->create([
            'locale' => 'en',
            'title' => 'Strategic Candor',
            'description' => 'Operational flattery breeds stagnation. I provide direct, unvarnished analytical feedback identifying behavioural blind spots and communication vulnerabilities with absolute clarity.',
        ]);

        $v6 = VisionValue::create(['sort_order' => 6]);
        $v6->translations()->create([
            'locale' => 'en',
            'title' => 'Global & Cross-Border Acumen',
            'description' => 'Communication is deeply cultural, contextual, and political. Drawing from experience across European institutions, Scandinavian academic centers, and international jurisdictions.',
        ]);

        // 5. Testimonials (9 grid + 1 featured)
        $testimonials = [
            [
                'person_name' => 'Marcus H.',
                'role' => 'Managing Partner',
                'city' => 'Berlin',
                'placement' => 'home',
                'sort_order' => 1,
                'is_featured' => false,
                'quote' => 'A precision I had not experienced from any communications advisor. Every room changed after.'
            ],
            [
                'person_name' => 'Sofia R.',
                'role' => 'Group CFO',
                'city' => 'Amsterdam',
                'placement' => 'home',
                'sort_order' => 2,
                'is_featured' => false,
                'quote' => 'Not coaching. Architecture. The frameworks held up in front of the board, the press and the market.'
            ],
            [
                'person_name' => 'Amir K.',
                'role' => 'Founder',
                'city' => 'Dubai',
                'placement' => 'home',
                'sort_order' => 3,
                'is_featured' => false,
                'quote' => 'Measurable, repeatable, and entirely remote. My executive presence became a system, not a mood.'
            ],
            [
                'person_name' => 'Yuki T.',
                'role' => 'COO',
                'city' => 'Tokyo',
                'placement' => 'case_studies',
                'sort_order' => 4,
                'is_featured' => false,
                'quote' => 'The clarity we gained reshaped how the entire executive layer communicates upward and outward.'
            ],
            [
                'person_name' => 'Laila N.',
                'role' => 'Managing Director',
                'city' => 'Zürich',
                'placement' => 'case_studies',
                'sort_order' => 5,
                'is_featured' => false,
                'quote' => 'Efe rebuilt the way I hold a room. The return on that single shift is difficult to overstate.'
            ],
            [
                'person_name' => 'Carlos V.',
                'role' => 'Chairman',
                'city' => 'São Paulo',
                'placement' => 'case_studies',
                'sort_order' => 6,
                'is_featured' => false,
                'quote' => 'Strategic candor delivered with total discretion. Precisely the counsel a founder rarely receives.'
            ],
            [
                'person_name' => 'Priya S.',
                'role' => 'Head of Enterprise Operations',
                'city' => 'Singapore',
                'placement' => 'case_studies',
                'sort_order' => 7,
                'is_featured' => false,
                'quote' => 'Managing an organisation of 40+ professionals, I assumed my communication architecture was established. The AXIO Method™ revealed significant unexploited leverage.'
            ],
            [
                'person_name' => 'Rémi D.',
                'role' => 'Senior Institutional Consultant',
                'city' => 'Paris',
                'placement' => 'case_studies',
                'sort_order' => 8,
                'is_featured' => false,
                'quote' => 'Three advisory sessions in, I successfully renegotiated two commercial agreements that had been deadlocked for months.'
            ],
            [
                'person_name' => 'Nadia O.',
                'role' => 'Principal Architect & Studio Founder',
                'city' => 'Warsaw',
                'placement' => 'case_studies',
                'sort_order' => 9,
                'is_featured' => false,
                'quote' => 'The Narrative Architecture framework completely transformed how our firm structures high-stakes enterprise proposals.'
            ],
            [
                'person_name' => 'Thomas M.',
                'role' => 'Chief Executive Officer',
                'city' => 'Logistics Group',
                'city_extra' => 'Copenhagen, Denmark', // Will set this to city field
                'placement' => 'case_studies',
                'sort_order' => 10,
                'is_featured' => true,
                'quote' => 'I engaged Efe as an established founder navigating a growth plateau... The strategic ROI on this advisory mandate remains unmatched over my last decade of enterprise leadership.'
            ]
        ];

        foreach ($testimonials as $tData) {
            $t = Testimonial::create([
                'person_name' => $tData['person_name'],
                'role' => $tData['role'],
                'city' => $tData['city_extra'] ?? $tData['city'],
                'placement' => $tData['placement'],
                'sort_order' => $tData['sort_order'],
                'is_published' => false,
                'is_featured' => $tData['is_featured'],
            ]);
            $t->translations()->create([
                'locale' => 'en',
                'quote' => $tData['quote'],
            ]);
        }

        // 6. Metrics (in this order)
        $metrics = [
            [
                'value' => '200+',
                'label' => 'C-Suite & High-Performing Executives Advised',
                'placement' => 'both',
                'sort_order' => 1
            ],
            [
                'value' => '15+',
                'label' => 'Jurisdictions & Markets Reached',
                'placement' => 'both',
                'sort_order' => 2
            ],
            [
                'value' => '6+',
                'label' => 'Years Applied Leadership Experience',
                'placement' => 'home',
                'sort_order' => 3
            ],
            [
                'value' => '98%',
                'label' => 'Client Retention & Mandate Renewal Rate',
                'placement' => 'case_studies',
                'sort_order' => 4
            ],
            [
                'value' => '5.0',
                'label' => 'Average Strategic Satisfaction Rating',
                'placement' => 'case_studies',
                'sort_order' => 5
            ]
        ];

        foreach ($metrics as $mData) {
            $m = Metric::create([
                'value' => $mData['value'],
                'placement' => $mData['placement'],
                'sort_order' => $mData['sort_order'],
                'is_published' => false,
            ]);
            $m->translations()->create([
                'locale' => 'en',
                'label' => $mData['label'],
            ]);
        }

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
