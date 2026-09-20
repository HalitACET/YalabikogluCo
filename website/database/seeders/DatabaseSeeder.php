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
     *
     * Every content record carries a translation row for each locale in
     * config('locales.supported') — en (default), lv, fr, ru. Records are
     * seeded published so the public site renders real content immediately;
     * editors can unpublish individually from the Filament panel.
     */
    public function run(): void
    {
        // 1. Admin Kullanıcısını Oluştur
        $this->call(AdminUserSeeder::class);

        $this->seedDisciplines();
        $this->seedAxioDimensions();
        $this->seedVisionValues();
        $this->seedTestimonials();
        $this->seedMetrics();
        $this->seedPages();
    }

    // -----------------------------------------------------------------
    // 2. Disciplines (4, in this order)
    // -----------------------------------------------------------------
    private function seedDisciplines(): void
    {
        $disciplines = [
            [
                'slug' => 'executive-presence',
                'sort_order' => 1,
                'translations' => [
                    'en' => [
                        'title' => 'Executive Presence & Communication Axiology',
                        'dek' => 'Aligning language, behaviour, and values into a coherent executive identity.',
                        'pull_quote' => 'Authority is not asserted. It is perceived.',
                        'areas_of_focus' => [
                            ['title' => 'Executive Presence', 'description' => 'Executive presence, behavioural congruence, and environmental awareness'],
                            ['title' => 'Verbal Axiology', 'description' => 'Communicating core values through linguistic precision'],
                            ['title' => 'Non-Verbal Calibration', 'description' => 'Including posture, gesture, spatial command, and vocal delivery'],
                            ['title' => 'Behavioural Observation', 'description' => 'Conversational subtext and interpersonal pattern recognition'],
                            ['title' => 'Negotiation Dynamics', 'description' => 'High-stakes negotiation dynamics and executive influence'],
                        ],
                    ],
                    'lv' => [
                        'title' => 'Vadītāja klātbūtne un komunikācijas aksioloģija',
                        'dek' => 'Valodas, uzvedības un vērtību saskaņošana vienotā vadītāja identitātē.',
                        'pull_quote' => 'Autoritāti neizsaka. To uztver.',
                        'areas_of_focus' => [
                            ['title' => 'Vadītāja klātbūtne', 'description' => 'Vadītāja klātbūtne, uzvedības saskaņotība un vides izpratne'],
                            ['title' => 'Verbālā aksioloģija', 'description' => 'Pamatvērtību komunicēšana ar valodas precizitāti'],
                            ['title' => 'Neverbālā kalibrēšana', 'description' => 'Stāja, žesti, telpas pārvaldība un balss pasniegšana'],
                            ['title' => 'Uzvedības novērošana', 'description' => 'Sarunas zemteksts un starppersonu modeļu atpazīšana'],
                            ['title' => 'Sarunu dinamika', 'description' => 'Augstas likmes sarunu dinamika un vadītāja ietekme'],
                        ],
                    ],
                    'fr' => [
                        'title' => 'Présence exécutive et axiologie de la communication',
                        'dek' => 'Aligner le langage, le comportement et les valeurs en une identité exécutive cohérente.',
                        'pull_quote' => 'L’autorité ne s’affirme pas. Elle se perçoit.',
                        'areas_of_focus' => [
                            ['title' => 'Présence exécutive', 'description' => 'Présence exécutive, congruence comportementale et conscience de l’environnement'],
                            ['title' => 'Axiologie verbale', 'description' => 'Communiquer les valeurs fondamentales par la précision linguistique'],
                            ['title' => 'Calibrage non verbal', 'description' => 'Posture, gestuelle, maîtrise de l’espace et diction vocale'],
                            ['title' => 'Observation comportementale', 'description' => 'Sous-texte conversationnel et reconnaissance des schémas interpersonnels'],
                            ['title' => 'Dynamique de négociation', 'description' => 'Dynamique des négociations à enjeux élevés et influence exécutive'],
                        ],
                    ],
                    'ru' => [
                        'title' => 'Лидерское присутствие и аксиология коммуникации',
                        'dek' => 'Согласование языка, поведения и ценностей в цельную лидерскую идентичность.',
                        'pull_quote' => 'Авторитет не заявляют. Его считывают.',
                        'areas_of_focus' => [
                            ['title' => 'Лидерское присутствие', 'description' => 'Лидерское присутствие, поведенческая согласованность и осознание среды'],
                            ['title' => 'Вербальная аксиология', 'description' => 'Передача базовых ценностей через языковую точность'],
                            ['title' => 'Невербальная калибровка', 'description' => 'Осанка, жесты, владение пространством и подача голоса'],
                            ['title' => 'Наблюдение за поведением', 'description' => 'Подтекст разговора и распознавание межличностных паттернов'],
                            ['title' => 'Динамика переговоров', 'description' => 'Динамика переговоров с высокими ставками и лидерское влияние'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'executive-positioning',
                'sort_order' => 2,
                'translations' => [
                    'en' => [
                        'title' => 'Executive Positioning & Behavioural Intelligence',
                        'dek' => 'Understanding human behaviour to shape strategic outcomes.',
                        'pull_quote' => 'Influence begins where understanding exceeds assumption.',
                        'areas_of_focus' => [
                            ['title' => 'Behavioural Analysis', 'description' => 'Behavioural analysis and executive decision-making patterns'],
                            ['title' => 'Cognitive Tendencies', 'description' => 'Communication defaults, cognitive tendencies, and strategic adaptability'],
                            ['title' => 'Executive Positioning', 'description' => 'Executive positioning and long-term professional reputation'],
                            ['title' => 'Sovereign Influence', 'description' => 'Influence without manipulation through behavioural awareness'],
                            ['title' => 'Enduring Authority', 'description' => 'Building enduring authority across organisations and industries'],
                        ],
                    ],
                    'lv' => [
                        'title' => 'Vadītāja pozicionēšana un uzvedības inteliģence',
                        'dek' => 'Cilvēka uzvedības izpratne stratēģisku rezultātu veidošanai.',
                        'pull_quote' => 'Ietekme sākas tur, kur izpratne pārsniedz pieņēmumu.',
                        'areas_of_focus' => [
                            ['title' => 'Uzvedības analīze', 'description' => 'Uzvedības analīze un vadītāju lēmumu pieņemšanas modeļi'],
                            ['title' => 'Kognitīvās tendences', 'description' => 'Komunikācijas paradumi, kognitīvās tendences un stratēģiskā pielāgotspēja'],
                            ['title' => 'Vadītāja pozicionēšana', 'description' => 'Vadītāja pozicionēšana un ilgtermiņa profesionālā reputācija'],
                            ['title' => 'Suverēna ietekme', 'description' => 'Ietekme bez manipulācijas, balstoties uz uzvedības izpratni'],
                            ['title' => 'Noturīga autoritāte', 'description' => 'Noturīgas autoritātes veidošana organizācijās un nozarēs'],
                        ],
                    ],
                    'fr' => [
                        'title' => 'Positionnement exécutif et intelligence comportementale',
                        'dek' => 'Comprendre le comportement humain pour façonner les résultats stratégiques.',
                        'pull_quote' => 'L’influence commence là où la compréhension dépasse la supposition.',
                        'areas_of_focus' => [
                            ['title' => 'Analyse comportementale', 'description' => 'Analyse comportementale et schémas de décision exécutive'],
                            ['title' => 'Tendances cognitives', 'description' => 'Réflexes de communication, tendances cognitives et adaptabilité stratégique'],
                            ['title' => 'Positionnement exécutif', 'description' => 'Positionnement exécutif et réputation professionnelle à long terme'],
                            ['title' => 'Influence souveraine', 'description' => 'Influencer sans manipuler grâce à la conscience comportementale'],
                            ['title' => 'Autorité durable', 'description' => 'Construire une autorité durable à travers organisations et secteurs'],
                        ],
                    ],
                    'ru' => [
                        'title' => 'Лидерское позиционирование и поведенческий интеллект',
                        'dek' => 'Понимание человеческого поведения для формирования стратегических результатов.',
                        'pull_quote' => 'Влияние начинается там, где понимание превосходит допущение.',
                        'areas_of_focus' => [
                            ['title' => 'Поведенческий анализ', 'description' => 'Поведенческий анализ и модели принятия управленческих решений'],
                            ['title' => 'Когнитивные склонности', 'description' => 'Коммуникационные привычки, когнитивные склонности и стратегическая адаптивность'],
                            ['title' => 'Лидерское позиционирование', 'description' => 'Лидерское позиционирование и долгосрочная профессиональная репутация'],
                            ['title' => 'Суверенное влияние', 'description' => 'Влияние без манипуляции через осознание поведения'],
                            ['title' => 'Устойчивый авторитет', 'description' => 'Формирование устойчивого авторитета в организациях и отраслях'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'self-mastery',
                'sort_order' => 3,
                'translations' => [
                    'en' => [
                        'title' => 'Executive Self-Mastery & Personal Architecture',
                        'dek' => 'Translating self-awareness, temporal discipline, and strategic clarity into long-term sovereign trajectory.',
                        'pull_quote' => 'Mastery of circumstance begins with total governance of the self.',
                        'areas_of_focus' => [
                            ['title' => 'Cognitive Self-Awareness & Internal Auditing', 'description' => 'Deconstructing psychological defaults and blind spots'],
                            ['title' => 'Temporal Architecture & High-Yield Resource Allocation', 'description' => 'Structuring focus and mental energy as strategic capital'],
                            ['title' => 'Goal Alignment & Strategic Trajectory', 'description' => 'Mapping precise multi-year personal benchmarks'],
                            ['title' => 'Resilience Mechanics & Pressure Calibration', 'description' => 'Mental fortitude and composure during extreme volatility'],
                            ['title' => 'Personal Sovereignty & Executive Discipline', 'description' => 'Cultivating non-negotiable internal standards'],
                        ],
                    ],
                    'lv' => [
                        'title' => 'Vadītāja pašpārvalde un personīgā arhitektūra',
                        'dek' => 'Pašizpratnes, laika disciplīnas un stratēģiskas skaidrības pārvēršana ilgtermiņa suverēnā trajektorijā.',
                        'pull_quote' => 'Apstākļu pārvaldība sākas ar pilnīgu sevis pārvaldību.',
                        'areas_of_focus' => [
                            ['title' => 'Kognitīvā pašizpratne un iekšējais audits', 'description' => 'Psiholoģisko paradumu un aklo punktu dekonstrukcija'],
                            ['title' => 'Laika arhitektūra un augstas atdeves resursu sadale', 'description' => 'Fokusa un mentālās enerģijas strukturēšana kā stratēģisks kapitāls'],
                            ['title' => 'Mērķu saskaņošana un stratēģiskā trajektorija', 'description' => 'Precīzu vairāku gadu personīgo atskaites punktu izstrāde'],
                            ['title' => 'Noturības mehānika un spiediena kalibrēšana', 'description' => 'Mentāla izturība un savaldība ārkārtējas nestabilitātes apstākļos'],
                            ['title' => 'Personīgā suverenitāte un vadītāja disciplīna', 'description' => 'Nepārrunājamu iekšējo standartu kopšana'],
                        ],
                    ],
                    'fr' => [
                        'title' => 'Maîtrise de soi exécutive et architecture personnelle',
                        'dek' => 'Transformer la conscience de soi, la discipline temporelle et la clarté stratégique en une trajectoire souveraine à long terme.',
                        'pull_quote' => 'La maîtrise des circonstances commence par la gouvernance totale de soi.',
                        'areas_of_focus' => [
                            ['title' => 'Conscience cognitive de soi et audit interne', 'description' => 'Déconstruire les automatismes psychologiques et les angles morts'],
                            ['title' => 'Architecture temporelle et allocation de ressources à haut rendement', 'description' => 'Structurer l’attention et l’énergie mentale comme un capital stratégique'],
                            ['title' => 'Alignement des objectifs et trajectoire stratégique', 'description' => 'Définir des repères personnels précis sur plusieurs années'],
                            ['title' => 'Mécanique de la résilience et calibrage sous pression', 'description' => 'Force mentale et sang-froid dans une volatilité extrême'],
                            ['title' => 'Souveraineté personnelle et discipline exécutive', 'description' => 'Cultiver des standards internes non négociables'],
                        ],
                    ],
                    'ru' => [
                        'title' => 'Лидерское самообладание и личная архитектура',
                        'dek' => 'Превращение самоосознания, дисциплины времени и стратегической ясности в долгосрочную суверенную траекторию.',
                        'pull_quote' => 'Власть над обстоятельствами начинается с полного управления собой.',
                        'areas_of_focus' => [
                            ['title' => 'Когнитивное самоосознание и внутренний аудит', 'description' => 'Разбор психологических автоматизмов и слепых зон'],
                            ['title' => 'Архитектура времени и высокодоходное распределение ресурсов', 'description' => 'Структурирование фокуса и ментальной энергии как стратегического капитала'],
                            ['title' => 'Согласование целей и стратегическая траектория', 'description' => 'Построение точных многолетних личных ориентиров'],
                            ['title' => 'Механика устойчивости и калибровка под давлением', 'description' => 'Ментальная стойкость и самообладание при крайней нестабильности'],
                            ['title' => 'Личный суверенитет и лидерская дисциплина', 'description' => 'Формирование внутренних стандартов, не подлежащих обсуждению'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'strategic-messaging',
                'sort_order' => 4,
                'translations' => [
                    'en' => [
                        'title' => 'Strategic Messaging, Media & Institutional Communication',
                        'dek' => 'Designing narratives that strengthen credibility, protect reputation, and inspire confidence.',
                        'pull_quote' => 'The organisations that communicate with clarity are the organisations that earn trust.',
                        'areas_of_focus' => [
                            ['title' => 'Media Training', 'description' => 'Executive media training and on-camera communication'],
                            ['title' => 'Institutional Messaging', 'description' => 'Institutional messaging and stakeholder communication'],
                            ['title' => 'Public Appearances', 'description' => 'High-stakes interviews, panel discussions, and public appearances'],
                            ['title' => 'Crisis Communication', 'description' => 'Crisis communication and reputation management principles'],
                            ['title' => 'Narrative Strategy', 'description' => 'Narrative strategy for organisations, founders, and public figures'],
                        ],
                    ],
                    'lv' => [
                        'title' => 'Stratēģiskie vēstījumi, mediji un institucionālā komunikācija',
                        'dek' => 'Tādu naratīvu veidošana, kas stiprina uzticamību, sargā reputāciju un iedveš pārliecību.',
                        'pull_quote' => 'Organizācijas, kas komunicē skaidri, ir tās, kas iemanto uzticību.',
                        'areas_of_focus' => [
                            ['title' => 'Mediju apmācība', 'description' => 'Vadītāju mediju apmācība un komunikācija kameras priekšā'],
                            ['title' => 'Institucionālie vēstījumi', 'description' => 'Institucionālie vēstījumi un komunikācija ar ieinteresētajām pusēm'],
                            ['title' => 'Publiskās uzstāšanās', 'description' => 'Augstas likmes intervijas, paneļdiskusijas un publiskas uzstāšanās'],
                            ['title' => 'Krīzes komunikācija', 'description' => 'Krīzes komunikācija un reputācijas pārvaldības principi'],
                            ['title' => 'Naratīva stratēģija', 'description' => 'Naratīva stratēģija organizācijām, dibinātājiem un publiskām personām'],
                        ],
                    ],
                    'fr' => [
                        'title' => 'Messages stratégiques, médias et communication institutionnelle',
                        'dek' => 'Concevoir des récits qui renforcent la crédibilité, protègent la réputation et inspirent confiance.',
                        'pull_quote' => 'Les organisations qui communiquent avec clarté sont celles qui gagnent la confiance.',
                        'areas_of_focus' => [
                            ['title' => 'Media training', 'description' => 'Media training des dirigeants et communication face caméra'],
                            ['title' => 'Messages institutionnels', 'description' => 'Messages institutionnels et communication avec les parties prenantes'],
                            ['title' => 'Apparitions publiques', 'description' => 'Entretiens à enjeux élevés, tables rondes et apparitions publiques'],
                            ['title' => 'Communication de crise', 'description' => 'Communication de crise et principes de gestion de la réputation'],
                            ['title' => 'Stratégie narrative', 'description' => 'Stratégie narrative pour organisations, fondateurs et personnalités publiques'],
                        ],
                    ],
                    'ru' => [
                        'title' => 'Стратегические сообщения, медиа и институциональная коммуникация',
                        'dek' => 'Создание нарративов, которые укрепляют доверие, защищают репутацию и вселяют уверенность.',
                        'pull_quote' => 'Доверие зарабатывают те организации, которые говорят ясно.',
                        'areas_of_focus' => [
                            ['title' => 'Медиаподготовка', 'description' => 'Медиаподготовка руководителей и коммуникация в кадре'],
                            ['title' => 'Институциональные сообщения', 'description' => 'Институциональные сообщения и коммуникация со стейкхолдерами'],
                            ['title' => 'Публичные выступления', 'description' => 'Интервью с высокими ставками, панельные дискуссии и публичные выступления'],
                            ['title' => 'Кризисные коммуникации', 'description' => 'Кризисные коммуникации и принципы управления репутацией'],
                            ['title' => 'Нарративная стратегия', 'description' => 'Нарративная стратегия для организаций, основателей и публичных фигур'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($disciplines as $data) {
            $discipline = Discipline::create([
                'slug' => $data['slug'],
                'sort_order' => $data['sort_order'],
                'is_published' => true,
            ]);

            foreach ($data['translations'] as $locale => $translation) {
                $discipline->translations()->create(['locale' => $locale] + $translation);
            }
        }
    }

    // -----------------------------------------------------------------
    // 3. Axio Dimensions (4, in this order)
    // -----------------------------------------------------------------
    private function seedAxioDimensions(): void
    {
        $dimensions = [
            [
                'sort_order' => 1,
                'translations' => [
                    'en' => ['title' => 'Awareness', 'description' => 'Understanding behavioural patterns, cognitive defaults, internal blind spots, and executive perception.'],
                    'lv' => ['title' => 'Apzināšanās', 'description' => 'Uzvedības modeļu, kognitīvo paradumu, iekšējo aklo punktu un vadītāja uztveres izpratne.'],
                    'fr' => ['title' => 'Conscience', 'description' => 'Comprendre les schémas comportementaux, les automatismes cognitifs, les angles morts internes et la perception exécutive.'],
                    'ru' => ['title' => 'Осознанность', 'description' => 'Понимание поведенческих моделей, когнитивных автоматизмов, внутренних слепых зон и восприятия руководителя.'],
                ],
            ],
            [
                'sort_order' => 2,
                'translations' => [
                    'en' => ['title' => 'Alignment', 'description' => 'Ensuring language, values, non-verbal behaviour, and personal architecture operate with complete consistency.'],
                    'lv' => ['title' => 'Saskaņotība', 'description' => 'Nodrošināt, ka valoda, vērtības, neverbālā uzvedība un personīgā arhitektūra darbojas pilnīgi saskanīgi.'],
                    'fr' => ['title' => 'Alignement', 'description' => 'Garantir que le langage, les valeurs, le comportement non verbal et l’architecture personnelle fonctionnent en parfaite cohérence.'],
                    'ru' => ['title' => 'Согласованность', 'description' => 'Обеспечение полной согласованности языка, ценностей, невербального поведения и личной архитектуры.'],
                ],
            ],
            [
                'sort_order' => 3,
                'translations' => [
                    'en' => ['title' => 'Influence', 'description' => 'Communicating complex ideas with structural clarity, credibility, and strategic precision.'],
                    'lv' => ['title' => 'Ietekme', 'description' => 'Sarežģītu ideju komunicēšana ar strukturālu skaidrību, uzticamību un stratēģisku precizitāti.'],
                    'fr' => ['title' => 'Influence', 'description' => 'Communiquer des idées complexes avec clarté structurelle, crédibilité et précision stratégique.'],
                    'ru' => ['title' => 'Влияние', 'description' => 'Передача сложных идей со структурной ясностью, достоверностью и стратегической точностью.'],
                ],
            ],
            [
                'sort_order' => 4,
                'translations' => [
                    'en' => ['title' => 'Outcome', 'description' => 'Translating personal governance and communication architecture into measurable organisational, commercial, and leadership results.'],
                    'lv' => ['title' => 'Rezultāts', 'description' => 'Personīgās pārvaldības un komunikācijas arhitektūras pārvēršana izmērāmos organizatoriskos, komerciālos un vadības rezultātos.'],
                    'fr' => ['title' => 'Résultat', 'description' => 'Traduire la gouvernance personnelle et l’architecture de communication en résultats mesurables sur les plans organisationnel, commercial et managérial.'],
                    'ru' => ['title' => 'Результат', 'description' => 'Превращение личного управления и архитектуры коммуникации в измеримые организационные, коммерческие и управленческие результаты.'],
                ],
            ],
        ];

        foreach ($dimensions as $data) {
            $dimension = AxioDimension::create(['sort_order' => $data['sort_order']]);

            foreach ($data['translations'] as $locale => $translation) {
                $dimension->translations()->create(['locale' => $locale] + $translation);
            }
        }
    }

    // -----------------------------------------------------------------
    // 4. Vision Values (6, in this order)
    // -----------------------------------------------------------------
    private function seedVisionValues(): void
    {
        $values = [
            [
                'sort_order' => 1,
                'translations' => [
                    'en' => [
                        'title' => 'Uncompromising Authenticity',
                        'description' => 'True presence is not performative; it is the total elimination of incongruence. We strip away superficial rhetoric and artificial behaviours to construct a commanding executive presence rooted in core values and structural alignment.',
                    ],
                    'lv' => [
                        'title' => 'Nepiekāpīgs autentiskums',
                        'description' => 'Patiesa klātbūtne nav izrāde; tā ir pilnīga nesaskaņotības novēršana. Mēs atmetam virspusēju retoriku un mākslīgu uzvedību, lai veidotu pārliecinošu vadītāja klātbūtni, kas sakņojas pamatvērtībās un strukturālā saskaņotībā.',
                    ],
                    'fr' => [
                        'title' => 'Authenticité sans compromis',
                        'description' => 'La véritable présence n’est pas une performance ; c’est l’élimination totale de l’incongruence. Nous écartons la rhétorique superficielle et les comportements artificiels pour construire une présence exécutive qui impose le respect, enracinée dans les valeurs fondamentales et l’alignement structurel.',
                    ],
                    'ru' => [
                        'title' => 'Бескомпромиссная подлинность',
                        'description' => 'Подлинное присутствие — не игра на публику, а полное устранение несоответствий. Мы убираем поверхностную риторику и искусственное поведение, чтобы выстроить убедительное лидерское присутствие, укоренённое в базовых ценностях и структурной согласованности.',
                    ],
                ],
            ],
            [
                'sort_order' => 2,
                'translations' => [
                    'en' => [
                        'title' => 'Empirical Efficacy Over Theory',
                        'description' => 'Every framework deployed within The AXIO Method™ is stress-tested in real-world high-stakes environments. We reject ideas that sound sophisticated but fail under pressure.',
                    ],
                    'lv' => [
                        'title' => 'Empīriska iedarbība pāri teorijai',
                        'description' => 'Katrs The AXIO Method™ ietvars tiek pārbaudīts reālās, augstas likmes situācijās. Mēs noraidām idejas, kas izklausās izsmalcinātas, bet spiediena apstākļos nedarbojas.',
                    ],
                    'fr' => [
                        'title' => 'L’efficacité empirique avant la théorie',
                        'description' => 'Chaque cadre déployé au sein de The AXIO Method™ est éprouvé dans des environnements réels à enjeux élevés. Nous rejetons les idées qui paraissent sophistiquées mais cèdent sous la pression.',
                    ],
                    'ru' => [
                        'title' => 'Эмпирическая эффективность важнее теории',
                        'description' => 'Каждая модель The AXIO Method™ проходит проверку в реальных ситуациях с высокими ставками. Мы отвергаем идеи, которые звучат изысканно, но не выдерживают давления.',
                    ],
                ],
            ],
            [
                'sort_order' => 3,
                'translations' => [
                    'en' => [
                        'title' => 'Continuous Analytical Evolution',
                        'description' => 'The dynamics of global influence and institutional governance are constantly shifting. I hold my practice to the highest analytical and academic standards.',
                    ],
                    'lv' => [
                        'title' => 'Nepārtraukta analītiskā attīstība',
                        'description' => 'Globālās ietekmes un institucionālās pārvaldības dinamika nemitīgi mainās. Savu praksi es mēru ar augstākajiem analītiskajiem un akadēmiskajiem standartiem.',
                    ],
                    'fr' => [
                        'title' => 'Évolution analytique continue',
                        'description' => 'Les dynamiques de l’influence mondiale et de la gouvernance institutionnelle évoluent sans cesse. Je soumets ma pratique aux standards analytiques et académiques les plus exigeants.',
                    ],
                    'ru' => [
                        'title' => 'Непрерывная аналитическая эволюция',
                        'description' => 'Динамика глобального влияния и институционального управления постоянно меняется. Я оцениваю свою практику по самым высоким аналитическим и академическим стандартам.',
                    ],
                ],
            ],
            [
                'sort_order' => 4,
                'translations' => [
                    'en' => [
                        'title' => 'Bespoke Human Architecture',
                        'description' => 'High-stakes leaders require surgical, highly tailored solutions. Every engagement is calibrated to your specific psychological profile, organisational dynamics, cultural context, and long-term strategic trajectory.',
                    ],
                    'lv' => [
                        'title' => 'Individuāli veidota cilvēka arhitektūra',
                        'description' => 'Augstas likmes vadītājiem nepieciešami ķirurģiski precīzi, individuāli pielāgoti risinājumi. Katrs sadarbības projekts tiek kalibrēts atbilstoši jūsu psiholoģiskajam profilam, organizācijas dinamikai, kultūras kontekstam un ilgtermiņa stratēģiskajai trajektorijai.',
                    ],
                    'fr' => [
                        'title' => 'Architecture humaine sur mesure',
                        'description' => 'Les dirigeants à enjeux élevés exigent des solutions chirurgicales et hautement personnalisées. Chaque mandat est calibré selon votre profil psychologique, la dynamique de votre organisation, votre contexte culturel et votre trajectoire stratégique à long terme.',
                    ],
                    'ru' => [
                        'title' => 'Индивидуальная человеческая архитектура',
                        'description' => 'Лидерам с высокими ставками нужны хирургически точные, индивидуально выстроенные решения. Каждый проект калибруется под ваш психологический профиль, динамику организации, культурный контекст и долгосрочную стратегическую траекторию.',
                    ],
                ],
            ],
            [
                'sort_order' => 5,
                'translations' => [
                    'en' => [
                        'title' => 'Strategic Candor',
                        'description' => 'Operational flattery breeds stagnation. I provide direct, unvarnished analytical feedback identifying behavioural blind spots and communication vulnerabilities with absolute clarity.',
                    ],
                    'lv' => [
                        'title' => 'Stratēģiska atklātība',
                        'description' => 'Ikdienas glaimi rada stagnāciju. Es sniedzu tiešu, neizskaistinātu analītisku atgriezenisko saiti, ar pilnīgu skaidrību norādot uz uzvedības aklajiem punktiem un komunikācijas vājajām vietām.',
                    ],
                    'fr' => [
                        'title' => 'Franchise stratégique',
                        'description' => 'La flatterie opérationnelle engendre la stagnation. Je livre un retour analytique direct et sans fard, identifiant avec une clarté absolue les angles morts comportementaux et les vulnérabilités de communication.',
                    ],
                    'ru' => [
                        'title' => 'Стратегическая прямота',
                        'description' => 'Дежурная лесть ведёт к застою. Я даю прямую, неприукрашенную аналитическую обратную связь, с абсолютной ясностью указывая на поведенческие слепые зоны и уязвимости в коммуникации.',
                    ],
                ],
            ],
            [
                'sort_order' => 6,
                'translations' => [
                    'en' => [
                        'title' => 'Global & Cross-Border Acumen',
                        'description' => 'Communication is deeply cultural, contextual, and political. Drawing from experience across European institutions, Scandinavian academic centers, and international jurisdictions.',
                    ],
                    'lv' => [
                        'title' => 'Globāla un pārrobežu izpratne',
                        'description' => 'Komunikācija ir dziļi kulturāla, kontekstuāla un politiska. Balstos pieredzē Eiropas institūcijās, Skandināvijas akadēmiskajos centros un starptautiskās jurisdikcijās.',
                    ],
                    'fr' => [
                        'title' => 'Acuité globale et transfrontalière',
                        'description' => 'La communication est profondément culturelle, contextuelle et politique. Je m’appuie sur une expérience acquise au sein d’institutions européennes, de centres académiques scandinaves et de juridictions internationales.',
                    ],
                    'ru' => [
                        'title' => 'Глобальная и трансграничная проницательность',
                        'description' => 'Коммуникация глубоко культурна, контекстуальна и политична. Опираюсь на опыт работы в европейских институтах, скандинавских академических центрах и международных юрисдикциях.',
                    ],
                ],
            ],
        ];

        foreach ($values as $data) {
            $value = VisionValue::create(['sort_order' => $data['sort_order']]);

            foreach ($data['translations'] as $locale => $translation) {
                $value->translations()->create(['locale' => $locale] + $translation);
            }
        }
    }

    // -----------------------------------------------------------------
    // 5. Testimonials (9 grid + 1 featured)
    // -----------------------------------------------------------------
    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'person_name' => 'Marcus H.',
                'role' => 'Managing Partner',
                'city' => 'Berlin',
                'placement' => 'home',
                'sort_order' => 1,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'A precision I had not experienced from any communications advisor. Every room changed after.',
                    'lv' => 'Precizitāte, kādu nebiju piedzīvojis ne pie viena komunikācijas konsultanta. Pēc tam mainījās katra telpa, kurā ieeju.',
                    'fr' => 'Une précision que je n’avais connue chez aucun conseiller en communication. Chaque réunion a changé ensuite.',
                    'ru' => 'Точность, какой я не встречал ни у одного консультанта по коммуникациям. После этого изменилась каждая переговорная.',
                ],
            ],
            [
                'person_name' => 'Sofia R.',
                'role' => 'Group CFO',
                'city' => 'Amsterdam',
                'placement' => 'home',
                'sort_order' => 2,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'Not coaching. Architecture. The frameworks held up in front of the board, the press and the market.',
                    'lv' => 'Tas nav koučings. Tā ir arhitektūra. Ietvari noturējās gan padomes, gan preses, gan tirgus priekšā.',
                    'fr' => 'Pas du coaching. De l’architecture. Les cadres ont tenu devant le conseil, la presse et le marché.',
                    'ru' => 'Это не коучинг. Это архитектура. Модели выдержали перед советом директоров, прессой и рынком.',
                ],
            ],
            [
                'person_name' => 'Amir K.',
                'role' => 'Founder',
                'city' => 'Dubai',
                'placement' => 'home',
                'sort_order' => 3,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'Measurable, repeatable, and entirely remote. My executive presence became a system, not a mood.',
                    'lv' => 'Izmērāms, atkārtojams un pilnībā attālināts. Mana vadītāja klātbūtne kļuva par sistēmu, nevis noskaņojumu.',
                    'fr' => 'Mesurable, reproductible et entièrement à distance. Ma présence exécutive est devenue un système, non une humeur.',
                    'ru' => 'Измеримо, воспроизводимо и полностью дистанционно. Моё лидерское присутствие стало системой, а не настроением.',
                ],
            ],
            [
                'person_name' => 'Yuki T.',
                'role' => 'COO',
                'city' => 'Tokyo',
                'placement' => 'case_studies',
                'sort_order' => 4,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'The clarity we gained reshaped how the entire executive layer communicates upward and outward.',
                    'lv' => 'Iegūtā skaidrība pārveidoja to, kā visa vadības komanda komunicē uz augšu un uz āru.',
                    'fr' => 'La clarté acquise a transformé la façon dont toute la couche exécutive communique vers le haut et vers l’extérieur.',
                    'ru' => 'Обретённая ясность изменила то, как весь управленческий слой общается наверх и вовне.',
                ],
            ],
            [
                'person_name' => 'Laila N.',
                'role' => 'Managing Director',
                'city' => 'Zürich',
                'placement' => 'case_studies',
                'sort_order' => 5,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'Efe rebuilt the way I hold a room. The return on that single shift is difficult to overstate.',
                    'lv' => 'Efe no jauna izveidoja to, kā es noturu telpu. Šīs vienas pārmaiņas atdevi ir grūti pārvērtēt.',
                    'fr' => 'Efe a reconstruit ma manière de tenir une salle. Le retour sur ce seul changement est difficile à surestimer.',
                    'ru' => 'Эфе заново выстроил то, как я держу зал. Отдачу от одного этого сдвига трудно переоценить.',
                ],
            ],
            [
                'person_name' => 'Carlos V.',
                'role' => 'Chairman',
                'city' => 'São Paulo',
                'placement' => 'case_studies',
                'sort_order' => 6,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'Strategic candor delivered with total discretion. Precisely the counsel a founder rarely receives.',
                    'lv' => 'Stratēģiska atklātība ar pilnīgu diskrētumu. Tieši tāds padoms, kādu dibinātājs saņem reti.',
                    'fr' => 'Une franchise stratégique délivrée avec une discrétion absolue. Exactement le conseil qu’un fondateur reçoit rarement.',
                    'ru' => 'Стратегическая прямота при полной конфиденциальности. Именно тот совет, который основатель получает редко.',
                ],
            ],
            [
                'person_name' => 'Priya S.',
                'role' => 'Head of Enterprise Operations',
                'city' => 'Singapore',
                'placement' => 'case_studies',
                'sort_order' => 7,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'Managing an organisation of 40+ professionals, I assumed my communication architecture was established. The AXIO Method™ revealed significant unexploited leverage.',
                    'lv' => 'Vadot organizāciju ar vairāk nekā 40 profesionāļiem, es pieņēmu, ka mana komunikācijas arhitektūra ir nostiprināta. The AXIO Method™ atklāja būtisku, neizmantotu sviru.',
                    'fr' => 'À la tête d’une organisation de plus de 40 professionnels, je pensais mon architecture de communication acquise. The AXIO Method™ a révélé un levier important encore inexploité.',
                    'ru' => 'Управляя организацией из более чем 40 специалистов, я считал свою архитектуру коммуникации сложившейся. The AXIO Method™ вскрыл значительный неиспользованный рычаг.',
                ],
            ],
            [
                'person_name' => 'Rémi D.',
                'role' => 'Senior Institutional Consultant',
                'city' => 'Paris',
                'placement' => 'case_studies',
                'sort_order' => 8,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'Three advisory sessions in, I successfully renegotiated two commercial agreements that had been deadlocked for months.',
                    'lv' => 'Pēc trim konsultāciju sesijām es sekmīgi pārslēdzu divus komerclīgumus, kas mēnešiem bija iestrēguši.',
                    'fr' => 'Après trois séances de conseil, j’ai renégocié avec succès deux accords commerciaux bloqués depuis des mois.',
                    'ru' => 'После трёх консультационных сессий я успешно перезаключил два коммерческих соглашения, месяцами стоявших в тупике.',
                ],
            ],
            [
                'person_name' => 'Nadia O.',
                'role' => 'Principal Architect & Studio Founder',
                'city' => 'Warsaw',
                'placement' => 'case_studies',
                'sort_order' => 9,
                'is_featured' => false,
                'quotes' => [
                    'en' => 'The Narrative Architecture framework completely transformed how our firm structures high-stakes enterprise proposals.',
                    'lv' => 'Naratīva arhitektūras ietvars pilnībā mainīja to, kā mūsu birojs strukturē augstas likmes uzņēmumu piedāvājumus.',
                    'fr' => 'Le cadre d’Architecture Narrative a totalement transformé la manière dont notre cabinet structure ses propositions à fort enjeu.',
                    'ru' => 'Модель нарративной архитектуры полностью изменила то, как наша фирма выстраивает предложения с высокими ставками.',
                ],
            ],
            [
                'person_name' => 'Thomas M.',
                'role' => 'Chief Executive Officer',
                'city' => 'Logistics Group',
                'city_extra' => 'Copenhagen, Denmark', // Will set this to city field
                'placement' => 'case_studies',
                'sort_order' => 10,
                'is_featured' => true,
                'quotes' => [
                    'en' => 'I engaged Efe as an established founder navigating a growth plateau... The strategic ROI on this advisory mandate remains unmatched over my last decade of enterprise leadership.',
                    'lv' => 'Es vērsos pie Efe kā pieredzējis dibinātājs, kurš saskāries ar izaugsmes plato... Šīs konsultāciju sadarbības stratēģiskā atdeve joprojām ir nepārspēta manā pēdējā uzņēmuma vadības desmitgadē.',
                    'fr' => 'J’ai fait appel à Efe en tant que fondateur confirmé confronté à un plateau de croissance... Le ROI stratégique de ce mandat de conseil reste inégalé sur ma dernière décennie à la tête d’une entreprise.',
                    'ru' => 'Я обратился к Эфе как состоявшийся основатель, столкнувшийся с плато роста... Стратегическая отдача от этого консультационного мандата остаётся непревзойдённой за последнее десятилетие моего руководства компанией.',
                ],
            ],
        ];

        foreach ($testimonials as $tData) {
            $t = Testimonial::create([
                'person_name' => $tData['person_name'],
                'role' => $tData['role'],
                'city' => $tData['city_extra'] ?? $tData['city'],
                'placement' => $tData['placement'],
                'sort_order' => $tData['sort_order'],
                'is_published' => true,
                'is_featured' => $tData['is_featured'],
            ]);

            foreach ($tData['quotes'] as $locale => $quote) {
                $t->translations()->create([
                    'locale' => $locale,
                    'quote' => $quote,
                ]);
            }
        }
    }

    // -----------------------------------------------------------------
    // 6. Metrics (in this order)
    // -----------------------------------------------------------------
    private function seedMetrics(): void
    {
        /*
         * Proof points, not performance figures.
         *
         * The site previously claimed "200+ C-Suite executives advised",
         * "15+ jurisdictions reached" and a "98% client retention rate". The
         * practice was founded in 2026 and none of those could be
         * substantiated, which makes them the first thing a serious prospect
         * would doubt. These describe the experience that actually exists.
         */
        $metrics = [
            [
                'value' => 'Europe',
                'placement' => 'both',
                'sort_order' => 1,
                'translations' => [
                    'en' => [
                        'label' => 'International Experience',
                        'detail' => 'Entrepreneurship · Journalism · European Affairs · International Projects',
                    ],
                    'lv' => [
                        'label' => 'Starptautiska pieredze',
                        'detail' => 'Uzņēmējdarbība · žurnālistika · Eiropas lietas · starptautiski projekti',
                    ],
                    'fr' => [
                        'label' => 'Expérience internationale',
                        'detail' => 'Entrepreneuriat · journalisme · affaires européennes · projets internationaux',
                    ],
                    'ru' => [
                        'label' => 'Международный опыт',
                        'detail' => 'Предпринимательство · журналистика · европейские дела · международные проекты',
                    ],
                ],
            ],
            [
                'value' => 'Multiple markets & institutions',
                'placement' => 'both',
                'sort_order' => 2,
                'translations' => [
                    'en' => [
                        'label' => 'Cross-Border Perspective',
                        'detail' => 'Experience across different professional, cultural and institutional environments',
                    ],
                    'lv' => [
                        'label' => 'Pārrobežu skatījums',
                        'detail' => 'Pieredze dažādās profesionālās, kultūras un institucionālās vidēs',
                    ],
                    'fr' => [
                        'label' => 'Perspective transfrontalière',
                        'detail' => 'Une expérience acquise dans des environnements professionnels, culturels et institutionnels différents',
                    ],
                    'ru' => [
                        'label' => 'Трансграничная перспектива',
                        'detail' => 'Опыт работы в разных профессиональных, культурных и институциональных средах',
                    ],
                ],
            ],
            [
                'value' => '4 core disciplines',
                'placement' => 'both',
                'sort_order' => 3,
                'translations' => [
                    'en' => [
                        'label' => 'Advisory Focus',
                        'detail' => 'Strategic Communication · Executive Presence · Leadership Positioning · International Advisory',
                    ],
                    'lv' => [
                        'label' => 'Konsultāciju fokuss',
                        'detail' => 'Stratēģiskā komunikācija · vadītāja klātbūtne · vadības pozicionēšana · starptautiskas konsultācijas',
                    ],
                    'fr' => [
                        'label' => 'Domaine de conseil',
                        'detail' => 'Communication stratégique · présence exécutive · positionnement de leadership · conseil international',
                    ],
                    'ru' => [
                        'label' => 'Фокус консультирования',
                        'detail' => 'Стратегическая коммуникация · лидерское присутствие · лидерское позиционирование · международные консультации',
                    ],
                ],
            ],
        ];

        foreach ($metrics as $mData) {
            $m = Metric::create([
                'value' => $mData['value'],
                'placement' => $mData['placement'],
                'sort_order' => $mData['sort_order'],
                'is_published' => true,
            ]);

            foreach ($mData['translations'] as $locale => $translation) {
                $m->translations()->create(['locale' => $locale] + $translation);
            }
        }
    }

    // -----------------------------------------------------------------
    // 7. Pages SEO (Sayfaların Meta Verileri)
    // -----------------------------------------------------------------
    private function seedPages(): void
    {
        $pages = [
            'home' => [
                'en' => ['title' => 'Executive Communication Axiology', 'desc' => 'Advisory for executives who must be understood: presence, positioning, self-mastery, and strategic messaging, built on The AXIO Method™.'],
                'lv' => ['title' => 'Vadītāju komunikācijas aksioloģija', 'desc' => 'Konsultācijas vadītājiem, kuriem jābūt saprastiem: klātbūtne, pozicionēšana, pašpārvalde un stratēģiskie vēstījumi, balstoties uz The AXIO Method™.'],
                'fr' => ['title' => 'Axiologie de la communication exécutive', 'desc' => 'Conseil pour les dirigeants qui doivent être compris : présence, positionnement, maîtrise de soi et messages stratégiques, fondés sur The AXIO Method™.'],
                'ru' => ['title' => 'Аксиология лидерской коммуникации', 'desc' => 'Консультирование руководителей, которых должны понимать: присутствие, позиционирование, самообладание и стратегические сообщения на основе The AXIO Method™.'],
            ],
            'disciplines' => [
                'en' => ['title' => 'The Four Disciplines', 'desc' => 'Executive presence, behavioural intelligence, self-mastery, and strategic messaging — the four disciplines of the practice.'],
                'lv' => ['title' => 'Četras disciplīnas', 'desc' => 'Vadītāja klātbūtne, uzvedības inteliģence, pašpārvalde un stratēģiskie vēstījumi — prakses četras disciplīnas.'],
                'fr' => ['title' => 'Les quatre disciplines', 'desc' => 'Présence exécutive, intelligence comportementale, maîtrise de soi et messages stratégiques — les quatre disciplines de la pratique.'],
                'ru' => ['title' => 'Четыре дисциплины', 'desc' => 'Лидерское присутствие, поведенческий интеллект, самообладание и стратегические сообщения — четыре дисциплины практики.'],
            ],
            'axio-method' => [
                'en' => ['title' => 'The AXIO Method™ — Awareness, Alignment, Influence, Outcome', 'desc' => 'A four-dimension framework that turns self-awareness and communication architecture into measurable leadership results.'],
                'lv' => ['title' => 'The AXIO Method™ — apzināšanās, saskaņotība, ietekme, rezultāts', 'desc' => 'Četru dimensiju ietvars, kas pašizpratni un komunikācijas arhitektūru pārvērš izmērāmos vadības rezultātos.'],
                'fr' => ['title' => 'The AXIO Method™ — Conscience, Alignement, Influence, Résultat', 'desc' => 'Un cadre en quatre dimensions qui transforme la conscience de soi et l’architecture de communication en résultats de leadership mesurables.'],
                'ru' => ['title' => 'The AXIO Method™ — осознанность, согласованность, влияние, результат', 'desc' => 'Четырёхмерная модель, превращающая самоосознание и архитектуру коммуникации в измеримые управленческие результаты.'],
            ],
            'case-studies' => [
                'en' => ['title' => 'Client Outcomes & Case Studies', 'desc' => 'Selected mandates and the measurable shifts they produced for founders, boards, and executive teams.'],
                'lv' => ['title' => 'Klientu rezultāti un gadījumu izpēte', 'desc' => 'Atlasīti sadarbības projekti un izmērāmās pārmaiņas, ko tie deva dibinātājiem, padomēm un vadības komandām.'],
                'fr' => ['title' => 'Résultats clients et études de cas', 'desc' => 'Mandats sélectionnés et changements mesurables obtenus pour des fondateurs, des conseils et des équipes dirigeantes.'],
                'ru' => ['title' => 'Результаты клиентов и кейсы', 'desc' => 'Избранные проекты и измеримые изменения, которых добились основатели, советы директоров и управленческие команды.'],
            ],
            'vision' => [
                'en' => ['title' => 'Vision & Values', 'desc' => 'The principles behind the practice: uncompromising authenticity, empirical efficacy, strategic candor, and cross-border acumen.'],
                'lv' => ['title' => 'Vīzija un vērtības', 'desc' => 'Prakses pamatprincipi: nepiekāpīgs autentiskums, empīriska iedarbība, stratēģiska atklātība un pārrobežu izpratne.'],
                'fr' => ['title' => 'Vision et valeurs', 'desc' => 'Les principes qui fondent la pratique : authenticité sans compromis, efficacité empirique, franchise stratégique et acuité transfrontalière.'],
                'ru' => ['title' => 'Видение и ценности', 'desc' => 'Принципы практики: бескомпромиссная подлинность, эмпирическая эффективность, стратегическая прямота и трансграничная проницательность.'],
            ],
            'contact' => [
                'en' => ['title' => 'Request an Executive Briefing', 'desc' => 'Begin a confidential conversation about your communication architecture, positioning, and strategic trajectory.'],
                'lv' => ['title' => 'Pieteikt vadītāja brīfingu', 'desc' => 'Sāciet konfidenciālu sarunu par savu komunikācijas arhitektūru, pozicionēšanu un stratēģisko trajektoriju.'],
                'fr' => ['title' => 'Demander un briefing exécutif', 'desc' => 'Engagez une conversation confidentielle sur votre architecture de communication, votre positionnement et votre trajectoire stratégique.'],
                'ru' => ['title' => 'Запросить лидерский брифинг', 'desc' => 'Начните конфиденциальный разговор о вашей архитектуре коммуникации, позиционировании и стратегической траектории.'],
            ],
            'privacy' => [
                'en' => ['title' => 'Privacy Policy', 'desc' => 'How personal and organisational data is collected, protected, and handled, in line with the GDPR.'],
                'lv' => ['title' => 'Privātuma politika', 'desc' => 'Kā personas un organizācijas dati tiek vākti, aizsargāti un apstrādāti saskaņā ar VDAR.'],
                'fr' => ['title' => 'Politique de confidentialité', 'desc' => 'Comment les données personnelles et organisationnelles sont collectées, protégées et traitées, conformément au RGPD.'],
                'ru' => ['title' => 'Политика конфиденциальности', 'desc' => 'Как персональные и корпоративные данные собираются, защищаются и обрабатываются в соответствии с GDPR.'],
            ],
        ];

        foreach ($pages as $slug => $localisedSeo) {
            $p = Page::create(['slug' => $slug]);

            foreach ($localisedSeo as $locale => $seo) {
                $p->translations()->create([
                    'locale' => $locale,
                    'meta_title' => $seo['title'],
                    'meta_description' => $seo['desc'],
                ]);
            }
        }
    }
}
