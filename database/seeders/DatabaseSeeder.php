<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Expert;
use App\Models\TelegramPost;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public $experts = [
        [
            'name' => [
                'ru' => 'Геннадий Ванин',
                'en' => 'Gennady Vanin',
                'kk' => 'Геннадий Ванин',
            ],
            'description_short' => [
                'ru' => 'Сооснователь и управляющий партнер, руководитель офиса в России',
                'en' => 'Co-founder and Managing Partner, Head of Russia Office',
                'kk' => 'Ортақ құрушы және басқарушы серіктес, Ресей офисінің басшысы',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Геннадий Ванин консультирует компании в области формирования  управленческих команд, а также в области программ долгосрочной мотивации.</li>
            <li>Кроме того, обладает обширным опытом работы с инвестиционными группами и фэмили офисами.</li>
            <li>Основатель нескольких закрытых профессиональных сообществ.</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Gennady Vanin advises companies on building management teams and long-term motivation programs.</li>
            <li>He has extensive experience working with investment groups and family offices.</li>
            <li>Founder of several closed professional communities.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Геннадий Ванин компанияларға басқарушы командаларды құру және ұзақ мерзімді мотивация бағдарламалары бойынша кеңес береді.</li>
            <li>Сонымен қатар, инвестициялық топтар мен отбасылық кеңселермен жұмыс істеуде көптеген тәжірибеге ие.</li>
            <li>Бірнеше жабық кәсіби қауымдастықтардың құрылтайшысы.</li>
        </ul>",
            ],
            'email' => 'gennady.vanin@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Ирина Чернозубова',
                'en' => 'Irina Chernozubova',
                'kk' => 'Ирина Чернозубова',
            ],
            'description_short' => [
                'ru' => 'Сооснователь и партнер, руководитель офиса в Казахстане',
                'en' => 'Co-founder and Partner, Head of Kazakhstan Office',
                'kk' => 'Ортақ құрушы және серіктес, Қазақстан офисінің басшысы',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Ирина консультирует крупнейшие компании в области организационного дизайна, управления эффективностью и разработки систем оплаты труда и мотивации.  </li>
            <li>18 лет работала в Korn Ferry Hay Group, где реализовала около сотни проектов для компаний – национальных чемпионов на рынках России, Казахстана, Узбекистана, Украины, странах Ближнего Востока и Восточной Европы.</li>
            <li>Ирина обладает огромным опытом в части разработки структуры грейдов и системы вознаграждения для вертикально интегрированных компаний, диверсифицированных холдингов, и финансовых институтов. Автор методик по разработке систем оплаты труда, оценке должностей и внедрению изменений.</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Irina advises major companies in organizational design, performance management, and compensation and motivation systems.</li>
            <li>She worked at Korn Ferry Hay Group for 18 years, implementing about a hundred projects for national champions in Russia, Kazakhstan, Uzbekistan, Ukraine, the Middle East, and Eastern Europe.</li>
            <li>Irina has extensive experience in developing grade structures and compensation systems for vertically integrated companies, diversified holdings, and financial institutions. Author of methodologies for compensation systems, job evaluation, and change implementation.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Ирина ұйымдық дизайн, тиімділікті басқару және еңбек ақы мен мотивация жүйелерін әзірлеу саласында ірі компанияларға кеңес береді.</li>
            <li>Korn Ferry Hay Group компаниясында 18 жыл жұмыс істеді, онда Ресей, Қазақстан, Өзбекстан, Украина, Таяу Шығыс және Шығыс Еуропа нарықтарындағы ұлттық чемпиондар үшін жүзге жуық жобаны жүзеге асырды.</li>
            <li>Ирина тікелей интеграцияланған компаниялар, диверсификацияланған холдингтер және қаржы институттары үшін грейд құрылымын және сыйлықтау жүйесін әзірлеуде үлкен тәжірибеге ие. Еңбек ақы жүйелерін әзірлеу, лауазымдарды бағалау және өзгерістерді енгізу бойынша әдістемелердің авторы.</li>
        </ul>",
            ],
            'email' => 'irina.chernozubova@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Анна Тимофеева',
                'en' => 'Anna Timofeeva',
                'kk' => 'Анна Тимофеева',
            ],
            'description_short' => [
                'ru' => 'Эксперт по оценке персонала и карьерному консультированию',
                'en' => 'Expert in personnel assessment and career counseling',
                'kk' => 'Персоналды бағалау және мансаттық кеңес бойынша сарапшы',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Анна обладает 30-летним опытом в области управления талантами, управления изменениями, автоматизации и трансформации, из них 16 лет на позициях директора по персоналу в международных и компаниях – национальных чемпионах в банковском, розничном, девелоперском и FMCG сегментах.</li>
            <li>Победитель номинации The Best HRD2018 и The Best HRD 2022 по версии Kazakhstan Growth Forum</li>
            <li>Сертифицированный эксперт по оценке персонала и управлению изменениями</li>
            <li>Сертифицированный эксперт в сфере карьерного консультирования и карьерного коучинга. Ментор руководителей в различных функциях.</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Anna has 30 years of experience in talent management, change management, automation, and transformation, including 16 years as HR Director in international and national champion companies in banking, retail, real estate, and FMCG sectors.</li>
            <li>Winner of The Best HRD 2018 and The Best HRD 2022 by Kazakhstan Growth Forum</li>
            <li>Certified expert in personnel assessment and change management</li>
            <li>Certified expert in career counseling and career coaching. Mentor for executives in various functions.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Аннаның таланттарды басқару, өзгерістерді басқару, автоматтандыру және трансформация саласында 30 жылдық тәжірибесі бар, оның ішінде банк, бөлшек сауда, девелопмент және FMCG секторларындағы халықаралық және ұлттық чемпиондар компанияларында 16 жыл жеке құрам бөлімінің директоры қызметінде.</li>
            <li>Kazakhstan Growth Forum нұсқасы бойынша The Best HRD 2018 және The Best HRD 2022 номинациясының жеңімпазы</li>
            <li>Персоналды бағалау және өзгерістерді басқару бойынша сертификатталған сарапшы</li>
            <li>Мансаттық кеңес беру және мансаттық коучинг саласында сертификатталған сарапшы. Әртүрлі функциялардағы басшылардың менторы.</li>
        </ul>",
            ],
            'email' => 'anna.timofeeva@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Анна Дементьева',
                'en' => 'Anna Dementyeva',
                'kk' => 'Анна Дементьева',
            ],
            'description_short' => [
                'ru' => 'Руководитель практики «Организационный дизайн и оценка должностей»',
                'en' => 'Head of "Organizational Design and Job Evaluation" Practice',
                'kk' => '"Ұйымдық дизайн және лауазымдарды бағалау" практикасының басшысы',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Руководитель проектов по разработке и внедрению организационных структур, дизайну должностей, моделированию семей должностей, разработке структуры должностных разрядов и системы вознаграждения по методологии Korn Ferry Hay Group.</li>
            <li>Среди ее клиентов — крупнейшие национальные компании России, Казахстана, Узбекистана, ОАЭ и Саудовской Аравии: холдинги, финансовые институты, горнодобывающие компании.</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Project manager for developing and implementing organizational structures, job design, job family modeling, developing job grade structures and compensation systems using Korn Ferry Hay Group methodology.</li>
            <li>Her clients include major national companies in Russia, Kazakhstan, Uzbekistan, UAE, and Saudi Arabia: holdings, financial institutions, mining companies.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Korn Ferry Hay Group әдістемесі бойынша ұйымдық құрылымдарды әзірлеу және енгізу, лауазымдарды дизайндау, лауазым отбасыларын модельдеу, лауазымдық разрядтар құрылымын және сыйлықтау жүйесін әзірлеу жобаларының жетекшісі.</li>
            <li>Оның клиенттері арасында Ресей, Қазақстан, Өзбекстан, БАӘ және Сауд Арабиясының ірі ұлттық компаниялары бар: холдингтер, қаржы институттары, тау-кен компаниялары.</li>
        </ul>",
            ],
            'email' => 'anna.dementyeva@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Александр Сохор',
                'en' => 'Alexander Sokhor',
                'kk' => 'Александр Сохор',
            ],
            'description_short' => [
                'ru' => 'Консультант по вознаграждению и организационному дизайну',
                'en' => 'Compensation and Organizational Design Consultant',
                'kk' => 'Сыйлықтау және ұйымдық дизайн бойынша кеңесші',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Александр руководит проектами по оценке должностей, разработке политик вознаграждения и разработке систем управления эффективностью. Обладает широким опытом в области организационного дизайна и развития талантов. </li>
            <li>Ранее работал в Korn Ferry в России, Казахстане и Узбекистане, а также руководил направлением оценки и развития руководителей в крупнейшем цифровом банке России.</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Alexander manages projects in job evaluation, compensation policy development, and performance management systems. He has extensive experience in organizational design and talent development.</li>
            <li>Previously worked at Korn Ferry in Russia, Kazakhstan, and Uzbekistan, and led the executive assessment and development division at Russia's largest digital bank.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Александр лауазымдарды бағалау, сыйлықтау саясатын әзірлеу және тиімділікті басқару жүйелерін әзірлеу жобаларын басқарады. Ұйымдық дизайн және таланттарды дамыту саласында кең тәжірибеге ие.</li>
            <li>Бұрын Korn Ferry компаниясында Ресей, Қазақстан және Өзбекстанда жұмыс істеді, сондай-ақ Ресейдің ең ірі цифрлық банкінде басшыларды бағалау және дамыту бағытын басқарды.</li>
        </ul>",
            ],
            'email' => 'alexander.sokhor@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Марина Ялымова',
                'en' => 'Marina Yalymova',
                'kk' => 'Марина Ялымова',
            ],
            'description_short' => [
                'ru' => 'Партнёр, консультант по развитию управленческих команд',
                'en' => 'Partner, Management Team Development Consultant',
                'kk' => 'Серіктес, басқарушы командаларды дамыту бойынша кеңесші',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>25+ лет в сфере формирования, адаптации и развития управленческих команд для крупнейших корпораций машиностроения и потребительского сектора. Руководила практиками 'промышленность' и 'финансовые институты' в топ-3 компаниях по поиску руководителей высшего звена. </li>
            <li>10 лет на позиции советника Генерального директора госкорпорации, управляющей более чем 60 промышленными активами.</li>
            <li>Опыт на позиции директора по персоналу инвестиционной компании, управляющей активами в секторе FMCG и фармацевтики.</li>
            <li>Коуч высших руководителей, ментор, наставник</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>25+ years in forming, adapting, and developing management teams for major corporations in engineering and consumer sectors. Led 'industrial' and 'financial institutions' practices at top-3 executive search firms.</li>
            <li>10 years as Advisor to the CEO of a state corporation managing over 60 industrial assets.</li>
            <li>Experience as HR Director at an investment company managing assets in FMCG and pharmaceutical sectors.</li>
            <li>Executive coach, mentor, and advisor</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Машина жасау және тұтыну секторындағы ірі корпорациялар үшін басқарушы командаларды құру, бейімдеу және дамыту саласында 25+ жыл. Жоғары деңгейдегі басшыларды іздеу бойынша топ-3 компанияларда 'өнеркәсіп' және 'қаржы институттары' практикаларын басқарды.</li>
            <li>60-тан астам өнеркәсіптік активтерді басқаратын мемлекеттік корпорацияның Бас директорының кеңесшісі қызметінде 10 жыл.</li>
            <li>FMCG және фармацевтика секторларындағы активтерді басқаратын инвестициялық компанияда жеке құрам бөлімінің директоры қызметіндегі тәжірибе.</li>
            <li>Жоғары басшылардың коучы, менторы, кеңесшісі</li>
        </ul>",
            ],
            'email' => 'marina.yalymova@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Лилия Лобода',
                'en' => 'Liliya Loboda',
                'kk' => 'Лилия Лобода',
            ],
            'description_short' => [
                'ru' => 'Руководитель практики Executive Search',
                'en' => 'Head of Executive Search Practice',
                'kk' => 'Executive Search практикасының басшысы',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Лилия руководит проектами по поиску руководителей, в особенности в секторе финансовых институтов и на международных рынках. Ранее работала в московской команде Spencer Stuart, где занималась поисками руководителей, в том числе в области финансов и инвестиций. </li>
            <li>Кроме того, руководила несколькими эксклюзивными образовательными проектами для руководителей высшего звена</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Liliya manages executive search projects, particularly in the financial institutions sector and international markets. Previously worked at Spencer Stuart's Moscow team, focusing on executive search in finance and investments.</li>
            <li>She also led several exclusive educational projects for top executives</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Лилия басшыларды іздеу жобаларын, әсіресе қаржы институттары секторында және халықаралық нарықтарда басқарады. Бұрын Spencer Stuartтың Мәскеу командасында жұмыс істеді, онда қаржы және инвестициялар саласында басшыларды іздеумен айналысты.</li>
            <li>Сонымен қатар, жоғары деңгейдегі басшылар үшін бірнеше эксклюзивті білім беру жобаларын басқарды</li>
        </ul>",
            ],
            'email' => 'lilia.chistiukhina@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Алиса Горбачева',
                'en' => 'Alisa Gorbacheva',
                'kk' => 'Алиса Горбачева',
            ],
            'description_short' => [
                'ru' => 'Эксперт в области организационного дизайна и оценки должностей',
                'en' => 'Expert in organizational design and job evaluation',
                'kk' => 'Ұйымдық дизайн және лауазымдарды бағалау саласындағы сарапшы',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Алиса— эксперт в области организационного дизайна и оценки должностей с многолетним опытом работы в различных отраслях.</li>
            <li>На протяжении нескольких лет участвовала в проектах по оценке должностей и созданию систем грейдов. </li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Alisa is an expert in organizational design and job evaluation with many years of experience across various industries.</li>
            <li>For several years, she has participated in job evaluation and grade system creation projects.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Алиса — әртүрлі салаларда көпжылдық тәжірибесі бар ұйымдық дизайн және лауазымдарды бағалау саласындағы сарапшы.</li>
            <li>Бірнеше жыл бойы лауазымдарды бағалау және грейд жүйелерін құру жобаларына қатысты.</li>
        </ul>",
            ],
            'email' => 'alisa.gorbacheva@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Эльминур Курбанова',
                'en' => 'Elminur Kurbanova',
                'kk' => 'Эльминур Курбанова',
            ],
            'description_short' => [
                'ru' => 'Аналитик, обзоры вознаграждений',
                'en' => 'Analyst, Compensation Surveys',
                'kk' => 'Аналитик, сыйлықтау шолулары',
            ],
            'description' => [
                'ru' => 'Эльминур поддерживает клиентов в работе с цифровой платформой вознаграждений в регионе.',
                'en' => 'Elminur supports clients in working with the digital compensation platform in the region.',
                'kk' => 'Эльминур аймақтағы цифрлық сыйлықтау платформасымен жұмыс істеуде клиенттерге қолдау көрсетеді.',
            ],
            'email' => 'elminur.kurbanova@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Айым Елеупова',
                'en' => 'Aiym Yeleupova',
                'kk' => 'Айым Елеупова',
            ],
            'description_short' => [
                'ru' => 'Консультант по поиску руководителей',
                'en' => 'Executive Search Consultant',
                'kk' => 'Басшыларды іздеу бойынша кеңесші',
            ],
            'description' => [
                'ru' => 'Айым работает над международными проектами по поиску руководителей.',
                'en' => 'Aiym works on international executive search projects.',
                'kk' => 'Айым халықаралық басшыларды іздеу жобалары бойынша жұмыс істейді.',
            ],
            'email' => 'aiym.yeleupova@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Кирилл Цицорин',
                'en' => 'Kirill Tstsorin',
                'kk' => 'Кирилл Цицорин',
            ],
            'description_short' => [
                'ru' => 'Руководитель цифровой платформы Birge',
                'en' => 'Head of Birge Digital Platform',
                'kk' => 'Birge цифрлық платформасының басшысы',
            ],
            'description' => [
                'ru' => 'Кирилл руководит разработкой и развитием цифровой платформы Бирге для сбора и анализа данных о вознаграждении.',
                'en' => 'Kirill leads the development and growth of the Birge digital platform for compensation data collection and analysis.',
                'kk' => 'Кирилл сыйлықтау деректерін жинау және талдау үшін Birge цифрлық платформасын әзірлеуді және дамытуды басқарады.',
            ],
            'email' => '',
        ],
        [
            'name' => [
                'ru' => 'Галина Редкокашина',
                'en' => 'Galina Redkokashina',
                'kk' => 'Галина Редкокашина',
            ],
            'description_short' => [
                'ru' => 'Консультант по развитию и трансформации HR',
                'en' => 'HR Development and Transformation Consultant',
                'kk' => 'HR дамыту және трансформация бойынша кеңесші',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Галина занимается программами трансформации HR, оценкой и развитием руководителей, а также программами преемственности и другим решениям для высокоэффективных команд</li>
            <li>У Галины значительный опыт развития талантов в Европе, Африке, Азии и странах СНГ, в том числе 11 лет работы в телекоммуникационном холдинге Veon.</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Galina works on HR transformation programs, executive assessment and development, as well as succession planning and other solutions for high-performance teams</li>
            <li>Galina has significant experience in talent development in Europe, Africa, Asia, and CIS countries, including 11 years at telecommunications holding Veon.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Галина HR трансформация бағдарламаларымен, басшыларды бағалау және дамытумен, сондай-ақ мұрагерлік жоспарлау және жоғары тиімді командалар үшін басқа шешімдермен айналысады</li>
            <li>Галинаның Еуропа, Африка, Азия және ТД елдерінде таланттарды дамыту бойынша үлкен тәжірибесі бар, соның ішінде Veon телекоммуникациялық холдингінде 11 жыл жұмыс істеді.</li>
        </ul>",
            ],
            'email' => 'galina.redkokashina@birgeteam.com',
        ],
        [
            'name' => [
                'ru' => 'Наталия Симонова',
                'en' => 'Natalia Simonova',
                'kk' => 'Наталия Симонова',
            ],
            'description_short' => [
                'ru' => 'Руководитель направления «Обзоры вознаграждений»',
                'en' => 'Head of "Compensation Surveys" Division',
                'kk' => '"Сыйлықтау шолулары" бағытының басшысы',
            ],
            'description' => [
                'ru' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Наталья руководит развитием платформы вознаграждений Birge, практикой клубных и общих обзоров вознаграждений.</li>
            <li>Принимает участие в проектах по оценке должностей и разработке систем вознаграждения. Обладает 18-летним опытом проведения исследований рынка, бизнес-аналитики инвестиционных проектов, а также участия в проектах HR-аналитики.</li>
        </ul>",
                'en' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Natalia leads the development of the Birge compensation platform and the practice of club and general compensation surveys.</li>
            <li>Participates in job evaluation and compensation system development projects. Has 18 years of experience in market research, business analysis of investment projects, and HR analytics projects.</li>
        </ul>",
                'kk' => "<ul class='list-disc pl-5 space-y-6'>
            <li>Наталья Birge сыйлықтау платформасын дамытумен, клубтық және жалпы сыйлықтау шолулары практикасымен басқарады.</li>
            <li>Лауазымдарды бағалау және сыйлықтау жүйелерін әзірлеу жобаларына қатысады. Нарықты зерттеу, инвестициялық жобалардың бизнес-аналитикасы және HR-аналитика жобаларында 18 жылдық тәжірибеге ие.</li>
        </ul>",
            ],
            'email' => 'natalia.simonova@birgeteam.com',
        ],
    ];

    public $articles = [
        [
            'title' => [
                'ru' => 'Архитектура должностей в компании сегодня: основные вызовы',
                'en' => 'Job Architecture in Companies Today: Key Challenges',
                'kk' => 'Бүгінгі компаниялардағы лауазымдар архитектурасы: негізгі қиындықтар',
            ],
            'date' => '2024-10-15',
            'description' => [
                'ru' => 'Как адаптировать систему грейдов к современным реалиям бизнеса и сделать её гибким инструментом для справедливой оценки и развития сотрудников.',
                'en' => 'How to adapt the grading system to modern business realities and make it a flexible tool for fair employee evaluation and development.',
                'kk' => 'Грейд жүйесін қазіргі бизнес шындықтарына бейімдеп, қызметкерлерді әділ бағалау және дамыту үшін икемді құралға айналдыру қалай.',
            ],
        ],
        [
            'title' => [
                'ru' => 'Результаты исследования 2024: динамика корпоративного управления в Казахстане',
                'en' => '2024 Research Results: Corporate Governance Dynamics in Kazakhstan',
                'kk' => '2024 зерттеу нәтижелері: Қазақстанда корпоративтік басқарудың динамикасы',
            ],
            'date' => '2024-10-15',
            'description' => [
                'ru' => 'Ключевые изменения в работе советов директоров и трансформация подходов к управлению в новой экономической реальности.',
                'en' => 'Key changes in board of directors operations and transformation of management approaches in the new economic reality.',
                'kk' => 'Директорлар кеңесінің жұмысындағы негізгі өзгерістер және жаңа экономикалық шындықта басқару тәсілдерінің трансформациясы.',
            ],
        ],
        [
            'title' => [
                'ru' => 'Российские компании стали реже мотивировать сотрудников акциями',
                'en' => 'Russian Companies Less Frequently Motivate Employees with Stock Options',
                'kk' => 'Ресей компаниялары қызметкерлерді акциялармен сирек мотивациялайды',
            ],
            'date' => '2024-10-15',
            'description' => [
                'ru' => 'Почему компании отказываются от акционных программ в пользу денежных выплат и как меняются ожидания сотрудников.',
                'en' => 'Why companies are abandoning stock programs in favor of cash payments and how employee expectations are changing.',
                'kk' => 'Компаниялар акциялық бағдарламалардан бас тартып, ақша төлемдерін таңдауының себебі және қызметкерлердің күтулері қалай өзгеріп жатыр.',
            ],
        ],
        [
            'title' => [
                'ru' => 'С какими проблемами чаще всего сталкиваются CEO компаний',
                'en' => 'What Problems Do Company CEOs Most Frequently Face',
                'kk' => 'Компания CEO-лары ең жиі қандай мәселелерге ұшырайды',
            ],
            'date' => '2024-10-15',
            'description' => [
                'ru' => 'Зачастую руководители обозначают проблему буквально теми же словами, как и неизвестные им лидеры на другом континенте',
                'en' => 'Often, executives describe problems using the exact same words as leaders unknown to them on another continent',
                'kk' => 'Көбінесе басшылар мәселені басқа құрылымдағы оларға белгісіз басшылар сияқты дәл сол сөздермен сипаттайды',
            ],
        ],
        [
            'title' => [
                'ru' => '11 причин не садиться в кресло CEO',
                'en' => '11 Reasons Not to Take the CEO Seat',
                'kk' => 'CEO орындығына отырмаудың 11 себебі',
            ],
            'date' => '2024-10-15',
            'description' => [
                'ru' => 'Почему роль CEO связана с высоким стрессом, ответственностью и серьёзными личными компромиссами.',
                'en' => 'Why the CEO role is associated with high stress, responsibility, and serious personal compromises.',
                'kk' => 'Неліктен CEO рөлі жоғары стресс, жауапкершілік және қатты жеке компромиссилермен байланысты.',
            ],
        ]
    ];

    public array $telegramPosts = [
        ['date' => '20.04.2026', 'title' => "BIRGE REWARD MEET UP\nReward Architecture Reboot"],
        ['date' => '16.04.2026', 'title' => 'Партнёр Birge Ирина Чернозубова приняла участие в международной конференции организованной ASSET HR в Ташкенте'],
        ['date' => '14.04.2026', 'title' => 'Некому работать: бизнес меняет правила найма'],
        ['date' => '07.04.2026', 'title' => 'Региональные различия — это не столько география, сколько экономика'],
        ['date' => '02.04.2026', 'title' => 'Инфляция — не главный драйвер изменений, а усилитель'],
        ['date' => '27.03.2026', 'title' => 'Ирокез в 40 лет: карьерный риск или личная свобода?'],
    ];

    public $articleContent = [
        'ru' => [
            [
                "title" => 'Введение: зачем сегодня нужна архитектура должностей',
                "title_content" => 'Введение: зачем сегодня нужна архитектура должностей',
                "text" => "Современный рынок труда и динамичное развитие бизнеса требуют гибкости и эффективности в структуре компании. Архитектура должностей — это основа организационной структуры, которая должна быть не только эффективной, но и адаптивной к изменениям внешней среды. Однако, с учетом новых реалий, компании сталкиваются с рядом вызовов при построении эффективной архитектуры должностей. Возникает вопрос: нужно ли по-прежнему проводить оценку должностей и внедрять грейды? Посмотрим на основные вызовы сегодня и их связь с архитектурой должностей и грейдами."
            ],
            [
                "title" => '1. Гибкость и адаптация к изменениям',
                "title_content" => 'Гибкость vs структура',
                "text" => "В условиях быстрого изменения технологий, экономики и корпоративной культуры традиционная иерархия становится менее актуальной. Компании сталкиваются с необходимостью перехода к более гибким моделям, которые позволяют быстро реагировать на изменения внешней среды. Вопрос в том, как сохранить баланс между гибкостью и необходимостью чётко структурировать обязанности. Отправной точкой для этого является систематизация данных о функционале должностей. Хотя грейдинг традиционно ассоциируется с жёсткой иерархией, современные системы грейдинга могут быть достаточно гибкими. Важно, чтобы система могла адаптироваться к меняющимся условиям работы и бизнеса. Применение гибких моделей грейдинга позволяет учитывать новые роли и обязанности, не нарушая общей структуры. Это помогает компаниям быстро реагировать на изменения внешней среды, одновременно поддерживая порядок и справедливость внутри организации."
            ],
            [
                "title" => '2. Управление сложностью и многозадачностью',
                "title_content" => 'Управление сложностью и многозадачностью',
                "text" => "С развитием технологий и интеграцией цифровых инструментов всё больше сотрудников выполняют несколько функций одновременно. Это требует пересмотра традиционных должностных ролей и грамотного распределения задач между сотрудниками, чтобы избежать перегрузки и повысить эффективность. Применение подходов к оценке должностей, где используется профилирование (например, методология Hay), помогает разграничить роли и установить критерии оценки выполнения множества задач. Это позволяет избежать перегрузки сотрудников и обеспечить справедливое распределение обязанностей, соответствующее их квалификации и опыту."
            ]
        ],

        'en' => [
            [
                "title" => 'Introduction: Why Job Architecture Matters Today',
                "title_content" => 'Introduction: Why Job Architecture Matters Today',
                "text" => "Today's labor market and rapidly evolving business environment require organizations to be flexible and efficient. Job architecture forms the foundation of an organizational structure that must not only be effective but also adaptable to constant change. In modern conditions, companies face numerous challenges when designing and maintaining an effective job architecture. This raises an important question: do organizations still need job evaluation and grading systems? Let's explore the key challenges and understand how they relate to job architecture and grading."
            ],
            [
                "title" => '1. Flexibility and Adaptation to Change',
                "title_content" => 'Flexibility vs. Structure',
                "text" => "As technology, the economy, and corporate culture evolve rapidly, traditional hierarchical structures are becoming less relevant. Organizations increasingly need flexible operating models that enable them to respond quickly to changing business conditions. The challenge lies in balancing flexibility with clearly defined responsibilities. The starting point is a structured understanding of job functions. Although grading systems have traditionally been associated with rigid hierarchies, modern grading approaches can be highly flexible. They should evolve alongside the business, allowing new roles and responsibilities to be introduced without compromising organizational consistency. This enables companies to remain agile while preserving transparency, fairness, and internal order."
            ],
            [
                "title" => '2. Managing Complexity and Multitasking',
                "title_content" => 'Managing Complexity and Multitasking',
                "text" => "With the growing adoption of digital technologies, employees increasingly perform multiple functions simultaneously. This requires organizations to rethink traditional job roles and distribute responsibilities more effectively to prevent overload and improve productivity. Modern job evaluation methodologies, including profiling approaches such as the Hay Method, help distinguish responsibilities and establish clear evaluation criteria for complex roles. This ensures a fair distribution of work while aligning responsibilities with employees' qualifications, experience, and capabilities."
            ]
        ],

        'kk' => [
            [
                "title" => 'Кіріспе: Бүгінде лауазымдар архитектурасы не үшін қажет',
                "title_content" => 'Кіріспе: Бүгінде лауазымдар архитектурасы не үшін қажет',
                "text" => "Қазіргі еңбек нарығы мен бизнестің қарқынды дамуы компаниялардан икемділік пен тиімділікті талап етеді. Лауазымдар архитектурасы ұйым құрылымының негізі болып табылады және ол тек тиімді ғана емес, сонымен қатар сыртқы ортадағы өзгерістерге бейімделе алуы тиіс. Қазіргі жағдайда компаниялар тиімді лауазымдар архитектурасын қалыптастыру барысында көптеген қиындықтарға тап болады. Осыған байланысты маңызды сұрақ туындайды: бүгінгі күні де лауазымдарды бағалау мен грейд жүйесін енгізу қажет пе? Осы негізгі мәселелерді және олардың лауазымдар архитектурасымен байланысын қарастырайық."
            ],
            [
                "title" => '1. Икемділік және өзгерістерге бейімделу',
                "title_content" => 'Икемділік және құрылым',
                "text" => "Технологиялардың, экономиканың және корпоративтік мәдениеттің қарқынды өзгеруі дәстүрлі иерархиялық құрылымдардың маңызын төмендетуде. Компанияларға сыртқы өзгерістерге жылдам бейімделуге мүмкіндік беретін икемді басқару модельдері қажет. Негізгі міндет – икемділік пен нақты анықталған жауапкершіліктің арасындағы тепе-теңдікті сақтау. Бұл үшін ең алдымен лауазымдардың функционалын жүйелеу қажет. Дәстүрлі түрде грейдинг қатаң иерархиямен байланысты болғанымен, қазіргі заманғы грейд жүйелері әлдеқайда икемді болуы мүмкін. Олар бизнеспен бірге дамып, жаңа рөлдер мен міндеттерді ұйым құрылымын бұзбай енгізуге мүмкіндік береді. Бұл компанияларға өзгерістерге жедел жауап беруге және сонымен бірге әділдік пен тәртіпті сақтауға көмектеседі."
            ],
            [
                "title" => '2. Күрделілік пен көп міндеттілікті басқару',
                "title_content" => 'Күрделілік пен көп міндеттілікті басқару',
                "text" => "Цифрлық технологиялардың кеңінен енгізілуімен қызметкерлер бір уақытта бірнеше функцияны атқаратын жағдайлар жиілеп келеді. Бұл дәстүрлі лауазымдық рөлдерді қайта қарауды және қызметкерлер арасындағы міндеттерді тиімді бөлуді талап етеді. Мұндай тәсіл қызметкерлердің шамадан тыс жүктелуінің алдын алып, жалпы тиімділікті арттырады. Hay әдістемесі сияқты лауазымдарды бағалау тәсілдері әртүрлі міндеттердің шекарасын анықтап, оларды бағалау критерийлерін белгілеуге мүмкіндік береді. Нәтижесінде міндеттер қызметкерлердің біліктілігі мен тәжірибесіне сәйкес әділ бөлінеді."
            ]
        ],
    ];

    public $articleCategories = [
        'Организационный дизайн',
        'Корпоративное управление',
        'Вознаграждение',
        'Карьера',
        'Lifestyle'
    ];

    public function run(): void
    {
        $file = new Filesystem;
        $file->cleanDirectory(storage_path('app/public/media'));

        foreach ($this->experts as $key => $expert) {
            $expertCreated = Expert::create($expert);

            $key = $key + 1;
            $expertCreated->addMedia(public_path("tmp/expert-$key.png"))
                ->preservingOriginal()
                ->toMediaCollection('image');
        }

        foreach ($this->articleCategories as $category) {
            ArticleCategory::create([
                'name' => $category,
            ]);
        }

        foreach ($this->telegramPosts as $key => $telegramPost) {
            TelegramPost::create([
                'telegram_message_id' => $key,
                'chat_id' => $key,
                'text' => $telegramPost['title'],
                'published_at' => Carbon::createFromFormat('d.m.Y', $telegramPost['date']),
            ]);
        }

        foreach ($this->articles as $key => $article) {
            $slug = [
                'ru' => Str::slug($article['title']['ru']),
                'en' => Str::slug($article['title']['en']),
                'kk' => Str::slug($article['title']['kk']),
            ];

            $articleCreated = Article::create([
                'title' => $article['title'],
                'slug' => $slug,
                'description' => $article['description'],
                'date' => $article['date'],
                'article_category_id' => $key+1,
                'content' => $this->articleContent
            ]);

            $key = $key + 1;
            $articleCreated->addMedia(public_path("tmp/article-cover-$key.png"))
                ->preservingOriginal()
                ->toMediaCollection('cover');
        }

        $email = config('app.env') == ('local') ? 'admin@mail.ru' : config('admin.email');
        $password = config('app.env') == ('local') ? '12345678' : config('admin.password');
        $admin = User::create([
            'name' => 'admin',
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'remember_token' => Str::random(10),
        ]);


    }
}
