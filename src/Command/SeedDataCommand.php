<?php

namespace App\Command;

use App\Entity\AktienNewsItem;
use App\Entity\AnalysisListItem;
use App\Entity\AnlagestrategItem;
use App\Entity\DerivateCategory;
use App\Entity\DerivateProduct;
use App\Entity\DevisenRow;
use App\Entity\EtfCategory;
use App\Entity\EtfProduct;
use App\Entity\EurexFuture;
use App\Entity\EurexOption;
use App\Entity\EventItem;
use App\Entity\Expert;
use App\Entity\FondsCategory;
use App\Entity\FondsNewsItem;
use App\Entity\FondsStripFund;
use App\Entity\GruppeNewsItem;
use App\Entity\IndizesRow;
use App\Entity\KonjunkturItem;
use App\Entity\MarketIndex;
use App\Entity\MostSearchedItem;
use App\Entity\NewsItem;
use App\Entity\RohstoffRow;
use App\Entity\ServiceItem;
use App\Entity\SiteConfig;
use App\Entity\TagesPanel;
use App\Entity\TagesTab;
use App\Entity\TickerItem;
use App\Entity\TopFlopItem;
use App\Entity\WissenCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:seed-data', description: 'Seed the database with initial demo data')]
class SeedDataCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Seeding demo data...');

        $this->truncateAll();
        $this->seedTicker();
        $this->seedFondsStrip();
        $this->seedMarketIndices();
        $this->seedSiteConfig();
        $this->seedNewsItems();
        $this->seedTagestrends();
        $this->seedExperts();
        $this->seedEvents();
        $this->seedAnalyses();
        $this->seedTopsFlops();
        $this->seedMostSearched();
        $this->seedAktienNews();
        $this->seedIndizes();
        $this->seedDevisen();
        $this->seedRohstoffe();
        $this->seedKonjunktur();
        $this->seedAnlagestrategen();
        $this->seedGruppeNews();
        $this->seedFonds();
        $this->seedDerivate();
        $this->seedEtfs();
        $this->seedEurex();
        $this->seedWissen();
        $this->seedService();

        $this->em->flush();
        $io->success('All data seeded successfully!');
        return Command::SUCCESS;
    }

    private function truncateAll(): void
    {
        $conn = $this->em->getConnection();
        $conn->executeStatement('SET FOREIGN_KEY_CHECKS=0');
        $tables = [
            'ticker_items', 'fonds_strip_funds', 'market_indices', 'site_config', 'news_items',
            'tagestrends_tabs', 'tagestrends_panels', 'experts', 'event_items', 'analyses_list',
            'tops_flops', 'most_searched', 'aktien_news', 'indizes_rows', 'devisen_rows',
            'rohstoffe_rows', 'konjunktur_items', 'anlagestrategen', 'gruppe_news',
            'fonds_categories', 'fonds_news', 'derivate_categories', 'derivate_products',
            'etf_categories', 'etf_products', 'eurex_futures', 'eurex_options',
            'wissen_categories', 'service_items',
        ];
        foreach ($tables as $t) {
            $conn->executeStatement("TRUNCATE TABLE `$t`");
        }
        $conn->executeStatement('SET FOREIGN_KEY_CHECKS=1');
    }

    private function seedTicker(): void
    {
        $data = [
            ['Dax',      '22.728',  '+1,16%', true],
            ['MDax',     '28.607',  '-0,77%', false],
            ['TecDax',   '3.450',   '-0,78%', false],
            ['SDax',     '14.512',  '+0,34%', true],
            ['EUR/USD',  '1,156',   '-0,40%', false],
            ['Dow',      '46.248',  '+0,03%', true],
            ['Nasdaq',   '19.842',  '+0,58%', true],
            ['Gold',     '4.444',   '-1,37%', false],
            ['Öl (WTI)', '93,17',   '+1,81%', true],
            ['Bitcoin',  '70.960',  '+1,13%', true],
        ];
        foreach ($data as $i => [$name, $price, $change, $bullish]) {
            $e = (new TickerItem())->setName($name)->setPrice($price)->setChangeVal($change)->setBullish($bullish)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedFondsStrip(): void
    {
        $funds = [
            ['boerse.de-Aktienfonds',    '127,37', '+0,09%', true,  '128,15', '+0,13%', true],
            ['boerse.de-Weltfonds',       '118,47', '-0,12%', false, '105,16', '-0,16%', false],
            ['boerse.de-Technologiefonds','129,39', '+0,40%', true,  '127,39', '+0,39%', true],
            ['boerse.de-Dividendenfonds', '99,26',  '+0,39%', true,  '89,99',  '+0,39%', true],
        ];
        foreach ($funds as $i => [$name, $tp, $tc, $tb, $ap, $ac, $ab]) {
            $e = (new FondsStripFund())->setName($name)->setThesPrice($tp)->setThesChange($tc)->setThesBullish($tb)
                ->setAusshPrice($ap)->setAusshChange($ac)->setAusshBullish($ab)->setSortOrder($i);
            $this->em->persist($e);
        }

        $cfg = new SiteConfig();
        $cfg->setConfigKey('fonds_strip_gold')->setValue(['price' => '394,10', 'change' => '+0,53%', 'wkn' => 'TMG0LD', 'bullish' => true]);
        $this->em->persist($cfg);

        $cfg2 = new SiteConfig();
        $cfg2->setConfigKey('fonds_strip_bcdi')->setValue([
            ['name' => 'BCDI',            'price' => '201,83', 'change' => '+0,39%', 'bullish' => true],
            ['name' => 'BCDI USA',         'price' => '1.642',  'change' => '+0,74%', 'bullish' => true],
            ['name' => 'BCDI Deutschland', 'price' => '824',    'change' => '+1,12%', 'bullish' => true],
        ]);
        $this->em->persist($cfg2);
    }

    private function seedMarketIndices(): void
    {
        $data = [
            ['DAX',       '22.728,00', '+1,16%', true,  'M0,25 L10,22 L20,24 L30,15 L40,18 L50,10 L60,12 L70,5 L80,8 L90,2 L100,6'],
            ['Dow Jones', '46.248,00', '+0,03%', true,  'M0,20 L10,18 L20,22 L30,18 L40,16 L50,18 L60,15 L70,16 L80,14 L90,15 L100,14'],
            ['Gold (USD)','4.444,00',  '-1,37%', false, 'M0,10 L10,12 L20,8 L30,14 L40,12 L50,16 L60,14 L70,20 L80,22 L90,24 L100,26'],
        ];
        foreach ($data as $i => [$name, $price, $change, $bullish, $spark]) {
            $e = (new MarketIndex())->setName($name)->setPrice($price)->setChangeVal($change)->setBullish($bullish)->setSparkline($spark)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedSiteConfig(): void
    {
        $items = [
            'hero_story' => [
                'image'    => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD_aa6Ls2-04tZIoDyPNi-ViWIDRrTIBkTag63QsEfVS_Aerlmn3Zgwq0v_KbTThDWTxtU-kXcxSBhmGsyyHhf_lhp8TAPTROOOVmw4D0XeBKLUgSQtYl5GiBLqhbdRF9MZxJgFYf4sAV0ZhCDh0XWrTSDdvjCJf0XcAMHsZVxK54NzycWYH7QIl9GRblp9dQohEPYUiKVI3BAlkvxJRbqO_QaZbjmMCmjAfLQ59SkyvTrnTP_Nb2E_HiUdGPN5TdN6nI8acVPbGxc',
                'tag'      => 'Top-Story',
                'headline' => 'Marktbeben an der Wall Street: Droht jetzt die Zinswende?',
                'lead'     => 'Analysten warnen vor volatilen Phasen. Wir zeigen Ihnen, wie Sie Ihr Depot jetzt krisenfest machen und welche Sektoren profitieren.',
            ],
            'featured_stock' => [
                'name'     => 'Quanta Services',
                'wkn'      => '912294',
                'since'    => '2026',
                'price'    => '498,00',
                'currency' => 'EUR',
                'change'   => '+2,12%',
                'bullish'  => true,
                'excerpt'  => 'Mit dem Anstieg hat die Quanta Services-Aktie ein neues All-Time-High erreicht. Quanta Services ist ein Champion aus dem boerse.de-Aktienbrief.',
            ],
            'tagestrends_date' => '25.03.2026',
            'analyses_featured' => [
                'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD_aa6Ls2-04tZIoDyPNi-ViWIDRrTIBkTag63QsEfVS_Aerlmn3Zgwq0v_KbTThDWTxtU-kXcxSBhmGsyyHhf_lhp8TAPTROOOVmw4D0XeBKLUgSQtYl5GiBLqhbdRF9MZxJgFYf4sAV0ZhCDh0XWrTSDdvjCJf0XcAMHsZVxK54NzycWYH7QIl9GRblp9dQohEPYUiKVI3BAlkvxJRbqO_QaZbjmMCmjAfLQ59SkyvTrnTP_Nb2E_HiUdGPN5TdN6nI8acVPbGxc',
                'title'   => 'DZ BANK: United Internet "buy"',
                'excerpt' => 'DZ Bank hat den fairen Wert für United Internet von 35,50 auf 33,00 Euro gesenkt, aber die Einstufung auf "Kaufen" belassen.',
            ],
        ];
        foreach ($items as $key => $value) {
            $cfg = (new SiteConfig())->setConfigKey($key)->setValue($value);
            $this->em->persist($cfg);
        }
    }

    private function seedNewsItems(): void
    {
        $data = [
            [
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAONX7gDMAmDONC1j7GcCSW28j0F4EGXJ0XO92rZU0zuY0_oXk6a0bcGx3teipOfag3oXgYGndUbHJPUZqXU56ca9SAGXZMpTjqMMEJ_i1pgK5j5faeyQP7JZU2s2fjMc4DHW9hO4-97YtzdZmmu7b7XGx5X6eE3EeAPlzs3C1qSwwgA-VB4V4cm-x0gzzmXitMac_UBSxjMmzlo02uFKTrufqCiDAsJiLm4VvBx22zqbomi1D0wBkOE5lloZ1NLx8ByKkaPYPXVlE',
                'category'  => 'Technologie',
                'timestamp' => 'VOR 2 STUNDEN',
                'title'     => 'Nvidia-Rallye: Wie viel Potenzial steckt noch in der KI-Aktie?',
                'excerpt'   => 'Die jüngsten Quartalszahlen haben die Erwartungen übertroffen. Doch erste Analysten warnen vor einer Überhitzung des Marktes.',
                'style'     => 'card',
            ],
            [
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCW_oSfVoGE_cizm6_bkGaWmruf7m9auJwkpjhB4EtjqdsUkVY1wwRld7jJKpDC3d6wIVwwC4ZxsQaJrY_8RuczldZmUwQuDHiAABflj3QFp8_-ALI8mdz2wHPDNEsmSKKj6yRxmfSThNzvc2H3yXDqpKjW2XK55ZoMkGe8w9WGIPvt3K8PNbwIcjcCUBgzaAHTqj5aShpTaS9vPQE1iFH5Gx9RDfkItqhH2ftVy2qIlGkYoDL5PTGs3v2ofsX92WpxxCZ2pVqJTHw',
                'category'  => 'Devisen',
                'timestamp' => 'VOR 4 STUNDEN',
                'title'     => 'Euro unter Druck: EZB deutet Zinsschritt für Juni an',
                'excerpt'   => 'Die Gemeinschaftswährung reagiert sensibel auf die jüngsten Kommentare aus Frankfurt. Was Anleger jetzt wissen müssen.',
                'style'     => 'card',
            ],
            [
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVOALEgAq_CkwhbOH0l0X8hA08aZUSRviYLFMmUdyF_96KGwH0qhKCzomnydgqf3Oe2rfRFMgwp0N8GJYPvWnpqjBncAzREpTEuh2436gzro2tBV8mt_4XRO8H3wWqUGkXi33prYg0uqIQxlCoNB02caUtybSGFbY40qwbwOYnkmXFZsrLSXexcHrIPe5JCLZpuVuOg586ofrgJ2ovS0UOe2J3SNLr_MizHxYWPOT-qjFEb93R9T6tSNW2xCMeIRVSsyh0FOPY',
                'category'  => 'Kryptowährungen',
                'timestamp' => 'VOR 6 STUNDEN',
                'title'     => 'Bitcoin ETF-Zulassung: Ein Wendepunkt für den Krypto-Markt?',
                'excerpt'   => 'Institutionelle Investoren drängen in den Markt. Experten sehen neues Allzeithoch in Reichweite.',
                'style'     => 'list',
            ],
        ];
        foreach ($data as $i => $d) {
            $e = (new NewsItem())->setImage($d['image'])->setCategory($d['category'])->setTimestamp($d['timestamp'])
                ->setTitle($d['title'])->setExcerpt($d['excerpt'])->setStyle($d['style'])->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedTagestrends(): void
    {
        $tabRows = [
            0 => [['dax','Dax'],['mdax','MDax'],['sdax','SDax'],['tecdax','TecDax'],['dow','Dow Jones']],
            1 => [['bcdi','BCDI'],['bcdi_us','BCDI USA'],['bcdi_de','BCDI Deutschland']],
            2 => [['aktienfonds','boerse.de-Aktienfonds'],['weltfonds','boerse.de-Weltfonds']],
            3 => [['techfonds','boerse.de-Technologiefonds'],['divfonds','boerse.de-Dividendenfonds']],
        ];
        $sortCounter = 0;
        foreach ($tabRows as $rowIdx => $tabs) {
            foreach ($tabs as $tabSort => [$tabId, $label]) {
                $e = (new TagesTab())->setRowIndex($rowIdx)->setTabId($tabId)->setLabel($label)->setSortOrder($tabSort);
                $this->em->persist($e);
            }
        }

        $panels = [
            'dax'         => [false,'23.072,00','22.728,00','M0,12 C80,8 160,15 240,28 C320,42 390,55 460,62 C510,66 560,70 600,72',[
                ['name'=>'Rheinmetall','price'=>'1.487,75','change'=>'-0,10','bullish'=>false],
                ['name'=>'Scout24','price'=>'64,40','change'=>'-0,12','bullish'=>false],
                ['name'=>'Henkel Vz','price'=>'67,39','change'=>'-0,18','bullish'=>false],
                ['name'=>'Heidelberg Materials','price'=>'180,73','change'=>'-1,30','bullish'=>false],
                ['name'=>'Vonovia','price'=>'21,42','change'=>'-1,31','bullish'=>false],
                ['name'=>'Qiagen','price'=>'34,81','change'=>'-1,44','bullish'=>false],
            ]],
            'mdax'        => [false,'28.850,00','28.520,00','M0,35 C80,28 160,22 240,30 C320,38 390,34 460,42 C510,48 560,52 600,56',[
                ['name'=>'TeamViewer','price'=>'12,80','change'=>'+2,10','bullish'=>true],
                ['name'=>'Dürr','price'=>'22,45','change'=>'+1,05','bullish'=>true],
                ['name'=>'Evotec','price'=>'5,85','change'=>'-0,85','bullish'=>false],
                ['name'=>'Nordex','price'=>'13,20','change'=>'-1,20','bullish'=>false],
                ['name'=>'Thyssenkrupp','price'=>'4,92','change'=>'-2,00','bullish'=>false],
                ['name'=>'Aixtron','price'=>'18,44','change'=>'+0,76','bullish'=>true],
            ]],
            'sdax'        => [true,'14.612,00','14.420,00','M0,55 C80,48 160,40 240,35 C320,30 390,28 460,32 C510,30 560,26 600,22',[
                ['name'=>'Fielmann','price'=>'47,90','change'=>'+1,48','bullish'=>true],
                ['name'=>'SMA Solar','price'=>'16,22','change'=>'+2,00','bullish'=>true],
                ['name'=>'Nagarro','price'=>'40,10','change'=>'-0,50','bullish'=>false],
                ['name'=>'Knaus Tabbert','price'=>'22,85','change'=>'+0,88','bullish'=>true],
            ]],
            'tecdax'      => [false,'3.512,00','3.420,00','M0,18 C80,14 160,22 240,32 C320,44 390,50 460,58 C510,64 560,68 600,72',[
                ['name'=>'SAP SE','price'=>'242,30','change'=>'-0,42','bullish'=>false],
                ['name'=>'Infineon','price'=>'28,54','change'=>'-1,15','bullish'=>false],
                ['name'=>'Deutsche Telekom','price'=>'29,12','change'=>'+0,35','bullish'=>true],
                ['name'=>'QIAGEN','price'=>'34,81','change'=>'-1,44','bullish'=>false],
                ['name'=>'Nemetschek','price'=>'94,40','change'=>'+1,10','bullish'=>true],
            ]],
            'dow'         => [true,'46.410,00','46.100,00','M0,50 C80,45 160,42 240,44 C320,40 390,36 460,38 C510,36 560,34 600,32',[
                ['name'=>'Apple','price'=>'189,30','change'=>'+0,55','bullish'=>true],
                ['name'=>'Microsoft','price'=>'415,70','change'=>'+0,80','bullish'=>true],
                ['name'=>'Boeing','price'=>'172,40','change'=>'-0,90','bullish'=>false],
                ['name'=>'Goldman Sachs','price'=>'498,20','change'=>'+1,20','bullish'=>true],
                ['name'=>'Chevron','price'=>'152,80','change'=>'+2,10','bullish'=>true],
            ]],
            'bcdi'        => [true,'202,50','200,80','M0,65 C80,58 160,50 240,42 C320,33 390,26 460,20 C510,16 560,13 600,10',[
                ['name'=>'Quanta Services','price'=>'498,00','change'=>'+2,12','bullish'=>true],
                ['name'=>'Cintas','price'=>'182,40','change'=>'+0,65','bullish'=>true],
                ['name'=>'Alphabet','price'=>'175,20','change'=>'+1,08','bullish'=>true],
                ['name'=>'Booking Holdings','price'=>'4.240,00','change'=>'+0,80','bullish'=>true],
            ]],
            'bcdi_us'     => [true,'1.658,00','1.628,00','M0,60 C80,52 160,44 240,38 C320,30 390,24 460,18 C510,14 560,11 600,8',[
                ['name'=>'Apple','price'=>'189,30','change'=>'+0,55','bullish'=>true],
                ['name'=>'Visa','price'=>'280,90','change'=>'+0,32','bullish'=>true],
                ['name'=>'Mastercard','price'=>'490,20','change'=>'+0,44','bullish'=>true],
                ['name'=>'UnitedHealth','price'=>'520,80','change'=>'-0,15','bullish'=>false],
            ]],
            'bcdi_de'     => [true,'830,00','818,00','M0,68 C80,60 160,50 240,40 C320,30 390,22 460,16 C510,12 560,9 600,7',[
                ['name'=>'Allianz','price'=>'284,90','change'=>'+1,15','bullish'=>true],
                ['name'=>'SAP SE','price'=>'242,30','change'=>'-0,42','bullish'=>false],
                ['name'=>'Münchener Rück','price'=>'460,40','change'=>'+0,88','bullish'=>true],
                ['name'=>'Hannover Rück','price'=>'228,60','change'=>'+1,30','bullish'=>true],
            ]],
            'aktienfonds' => [true,'128,40','126,90','M0,55 C80,50 160,44 240,40 C320,36 390,32 460,28 C510,25 560,22 600,20',[
                ['name'=>'Quanta Services','price'=>'498,00','change'=>'+2,12','bullish'=>true],
                ['name'=>'Allianz','price'=>'284,90','change'=>'+1,15','bullish'=>true],
                ['name'=>'Alphabet','price'=>'175,20','change'=>'+1,08','bullish'=>true],
                ['name'=>'Münchener Rück','price'=>'460,40','change'=>'+0,88','bullish'=>true],
            ]],
            'weltfonds'   => [false,'119,20','117,90','M0,25 C80,30 160,36 240,40 C320,46 390,50 460,54 C510,57 560,59 600,62',[
                ['name'=>'Visa','price'=>'280,90','change'=>'+0,32','bullish'=>true],
                ['name'=>'Microsoft','price'=>'415,70','change'=>'+0,80','bullish'=>true],
                ['name'=>'LVMH','price'=>'592,00','change'=>'-0,60','bullish'=>false],
                ['name'=>'Nestlé','price'=>'82,10','change'=>'-0,85','bullish'=>false],
            ]],
            'techfonds'   => [true,'130,20','128,50','M0,60 C80,52 160,43 240,36 C320,28 390,22 460,18 C510,14 560,11 600,8',[
                ['name'=>'Nvidia','price'=>'824,40','change'=>'+3,50','bullish'=>true],
                ['name'=>'ASML','price'=>'820,00','change'=>'+1,20','bullish'=>true],
                ['name'=>'SAP SE','price'=>'242,30','change'=>'-0,42','bullish'=>false],
                ['name'=>'Infineon','price'=>'28,54','change'=>'-1,15','bullish'=>false],
            ]],
            'divfonds'    => [true,'100,10','98,80','M0,52 C80,46 160,40 240,36 C320,32 390,28 460,26 C510,24 560,22 600,20',[
                ['name'=>'Allianz','price'=>'284,90','change'=>'+1,15','bullish'=>true],
                ['name'=>'Deutsche Post','price'=>'40,22','change'=>'+0,50','bullish'=>true],
                ['name'=>'Münchener Rück','price'=>'460,40','change'=>'+0,88','bullish'=>true],
                ['name'=>'Vonovia','price'=>'21,42','change'=>'-1,31','bullish'=>false],
            ]],
        ];
        foreach ($panels as $tabId => [$bullish, $high, $low, $line, $stocks]) {
            $e = (new TagesPanel())->setTabId($tabId)->setBullish($bullish)->setHigh($high)->setLow($low)->setLine($line)->setStocks($stocks);
            $this->em->persist($e);
        }
    }

    private function seedExperts(): void
    {
        $data = [
            ['https://lh3.googleusercontent.com/aida-public/AB6AXuBsz4MHbDELmIU6OglpukXrvGwNxL2k_qGWtAz5gLm4qi8I4gYdI7Qinx1SKg6r0lIZt36fbD7oZzxvvm3NLjE3AoQSOU2KxdC7FsOgG40w9iCv78zPRUEeWtsgDTDJFmvfcveHieKAQYF4zKZt8ZgIHqGnRS-Z4HZMXroX7-HUqKx2TG1rLeJARNr8vLM6lGYApOSe370f67s63sUkc2QPs9Q8pNO0Qf431B43UfjyxH57GunKDTVUfiej1ON4dpAHYlTw0QRsXXo','Dr. Markus Bauer','Chefanalyst Investment-Check','"Die Inflation ist hartnäckiger als gedacht – Strategien für Anleger"','"Wir sehen eine strukturelle Verschiebung. Defensive Qualitätstitel sind jetzt das Gebot der Stunde..."','VOR 1 STUNDE'],
            ['https://lh3.googleusercontent.com/aida-public/AB6AXuCTYjhrSMMR6819aJOyCPeyH7naWdAq8cLk5VTXC8ATDaJoiJvqpJgWLgXtbriBvjX2_2sE3LMzSOiKlpby3QyTUDIZwezYJoT9ilZTlPOQ775Ow3R7IMbzKUfNmxLy0oN3JOA-EEO-VZiaNK-0m3Z6jALa8vZohwIPDfM4jAiPffwAkkMEMcudto8WfME2oj2MV7DL5Ft8cVCBdwGQ4RI0OfA-u_MfOCMm_fiX6AYCQ7dvLQSxlNYqO837ZD-0o38ZRcAoZhZUeBE','Sarah Lindner','Finanzexpertin & Bloggerin','"Warum der DAX-Aufstieg erst der Anfang der Sommerrallye war"','"Die Marktbreite nimmt zu. Auch Small- und MidCaps zeigen nun deutliche Lebenszeichen..."','VOR 3 STUNDEN'],
            ['https://lh3.googleusercontent.com/aida-public/AB6AXuD-3B6BGQbyTVXQIV3DvT2Un63VPERxQzZEMVE0DR3lHp8ydpcKRPDNxrwEZd1c9zinmCdE-6D96He9HR7dQMGs613sWqOlep-4I9x95msG15OHl8NF9Wr7plisfIhOflHawqrYvCDc-O2re3rX1wimc6n3vTwC1raZNMWXx8gu8vYT2eUEfUHUUDrOM1oq9Ru7Fw_a1okp2yxJDKQAtstav0XxVG2WmixcnZCKFciQiP1H4FkpUKaQ9-iasDIYHhyP6V0JZqWvycM','Thomas Müller','Eurex-Spezialist','"Absicherungstechniken: So schützen Sie Gewinne mit Optionen"','"Risikomanagement wird oft unterschätzt. Mit diesen einfachen Strategien begrenzen Sie das Drawdown..."','VOR 5 STUNDEN'],
        ];
        foreach ($data as $i => [$img, $name, $role, $title, $quote, $ts]) {
            $e = (new Expert())->setImage($img)->setName($name)->setRole($role)->setTitle($title)->setQuote($quote)->setTimestamp($ts)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedEvents(): void
    {
        $data = [
            ['25.03.26', 'AP Moeller-Maersk B', 'Hauptversammlung'],
            ['25.03.26', 'Electrolux B',        'Hauptversammlung'],
            ['25.03.26', 'Enagas',              'Hauptversammlung'],
            ['25.03.26', 'Cintas',              'Ergebniskonferenz'],
        ];
        foreach ($data as $i => [$date, $company, $type]) {
            $e = (new EventItem())->setDate($date)->setCompany($company)->setType($type)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedAnalyses(): void
    {
        $list = [
            ["16:50 Uhr", "ANALYSE-FLASH: DZ Bank hebt Nemetschek auf 'Halten' – Fairer Wert 70 Euro"],
            ["15:46 Uhr", "DZ BANK: Nemetschek \"hold\""],
            ["15:35 Uhr", "ANALYSE-FLASH: DZ Bank senkt fairen Wert für Carl Zeiss Meditec – 'Halten'"],
            ["14:36 Uhr", "JPMORGAN: K+S \"hold\""],
        ];
        foreach ($list as $i => [$time, $title]) {
            $e = (new AnalysisListItem())->setTime($time)->setTitle($title)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedTopsFlops(): void
    {
        $tops = [
            ['Lanxess',    '+16,96%', 'M0,25 L20,28 L40,15 L60,10 L80,5 L100,2'],
            ['LPKF Laser', '+9,80%',  null],
        ];
        foreach ($tops as $i => [$name, $change, $spark]) {
            $e = (new TopFlopItem())->setName($name)->setChangeVal($change)->setSparkline($spark)->setType('top')->setSortOrder($i);
            $this->em->persist($e);
        }
        $flops = [
            ['HelloFresh',        '-4,00%', 'M0,5 L20,2 L40,12 L60,18 L80,22 L100,28'],
            ['Micron Technology', '-4,49%', null],
        ];
        foreach ($flops as $i => [$name, $change, $spark]) {
            $e = (new TopFlopItem())->setName($name)->setChangeVal($change)->setSparkline($spark)->setType('flop')->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedMostSearched(): void
    {
        $data = [['Rheinmetall','60.792'],['Siemens Energy','32.712'],['Nvidia','24.553'],['SAP','22.173'],['RENK Group','19.233']];
        foreach ($data as $i => [$name, $count]) {
            $e = (new MostSearchedItem())->setName($name)->setCount($count)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedAktienNews(): void
    {
        $data = [
            ['09:15','Rheinmetall-Tochterfirma steuert Shuttlebusse aus der Ferne'],
            ['08:28','ProSiebenSat.1 verkauft zwei Vergleichsplattformen'],
            ['08:26','AKTIE IM FOKUS: Heidelberg Materials nach schwacher Dividende leicht im Minus'],
            ['08:16','IPO/Medien: SpaceX will mit Börsengang 75 Milliarden Dollar einsammeln'],
            ['08:00','EQS-News: LPKF verzeichnet leichte Ergebnisverbesserung in 2025'],
            ['08:00','Delivery Hero will weiter wachsen'],
            ['07:40','ProSiebenSat.1 erwartet wegen Werbeflaute weiteres schwieriges Jahr'],
            ['07:35','Heidelberg Materials will mehr Dividende zahlen'],
        ];
        foreach ($data as $i => [$time, $title]) {
            $e = (new AktienNewsItem())->setTime($time)->setTitle($title)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedIndizes(): void
    {
        $data = [
            ['DAX',           '22.728,00','+262,45','+1,16%',true, '23.472,30','17.024,88'],
            ['MDAX',          '28.607,00','-222,14','-0,77%',false,'29.831,55','22.407,40'],
            ['TecDAX',        '3.450,00', '-27,11', '-0,78%',false,'3.619,22', '2.841,34'],
            ['SDAX',          '14.512,00','+49,54', '+0,34%',true, '14.988,12','11.302,67'],
            ['Dow Jones',     '46.248,00','+13,87', '+0,03%',true, '47.122,88','36.611,78'],
            ['Nasdaq 100',    '19.842,00','+115,28','+0,58%',true, '20.188,44','16.442,10'],
            ['S&P 500',       '5.722,00', '+28,61', '+0,50%',true, '5.878,46', '4.682,11'],
            ['Euro Stoxx 50', '5.412,30', '+38,17', '+0,71%',true, '5.521,20', '4.468,90'],
        ];
        foreach ($data as $i => [$name,$aktuell,$pkt,$pct,$bullish,$h52,$l52]) {
            $e = (new IndizesRow())->setName($name)->setAktuell($aktuell)->setPkt($pkt)->setPct($pct)->setBullish($bullish)->setHigh52($h52)->setLow52($l52)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedDevisen(): void
    {
        $data = [
            ['EUR/USD','1,1560','-0,40%',false],
            ['EUR/GBP','0,8612','-0,12%',false],
            ['EUR/JPY','161,42','+0,28%',true],
            ['USD/JPY','139,55','+0,67%',true],
            ['GBP/USD','1,3421','-0,31%',false],
            ['EUR/CHF','0,9387','+0,09%',true],
        ];
        foreach ($data as $i => [$pair,$kurs,$pct,$bullish]) {
            $e = (new DevisenRow())->setPair($pair)->setKurs($kurs)->setPct($pct)->setBullish($bullish)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedRohstoffe(): void
    {
        $data = [
            ['Gold (USD/oz)',     '4.444,00','-1,37%',false],
            ['Silber (USD/oz)',   '48,22',   '-0,84%',false],
            ['Öl (WTI, USD)',    '93,17',   '+1,81%',true],
            ['Öl (Brent, USD)',  '96,44',   '+1,65%',true],
            ['Kupfer (USD/t)',    '9.812,00','+0,43%',true],
            ['Palladium (USD/oz)','1.184,00','-0,29%',false],
        ];
        foreach ($data as $i => [$name,$kurs,$pct,$bullish]) {
            $e = (new RohstoffRow())->setName($name)->setKurs($kurs)->setPct($pct)->setBullish($bullish)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedKonjunktur(): void
    {
        $data = [
            ['26.03.2026 10:30','US-BIP Q4 2025 bestätigt: +2,3% annualisiert'],
            ['26.03.2026 09:00','IFO-Geschäftsklima März: Leichte Erholung auf 87,5 Punkte'],
            ['25.03.2026 14:00','EZB-Protokoll: Mehrheit sieht Raum für weitere Zinssenkungen'],
            ['25.03.2026 10:00','Inflation Deutschland Februar: +2,2% gegenüber Vorjahr (endgültig)'],
            ['24.03.2026 16:00','Fed-Mitglied Williams: Zwei Zinssenkungen in 2026 realistisch'],
            ['24.03.2026 12:00','Eurozone PMI Composite März: 52,1 — Expansion setzt sich fort'],
        ];
        foreach ($data as $i => [$dt, $title]) {
            $e = (new KonjunkturItem())->setDatetime($dt)->setTitle($title)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedAnlagestrategen(): void
    {
        $data = [
            ['STRATEGIE','Champions-Aktien: Warum Qualität langfristig immer gewinnt','Thomas Müller'],
            ['ANALYSE',  'Diversifikation 2026: Rohstoffe als Depotanker',            'Jochen Appeltauer'],
            ['KOLUMNE',  'Fehler beim Vermögensaufbau: Die teuersten Irrtümer',       'Georg Kling'],
        ];
        foreach ($data as $i => [$badge, $title, $author]) {
            $e = (new AnlagestrategItem())->setBadge($badge)->setTitle($title)->setAuthor($author)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedGruppeNews(): void
    {
        $data = [
            ['boerse.de-Aktienbrief',        'Der führende Börsendienst Deutschlands.',   'Jetzt kostenlos testen →'],
            ['myChampions100',                'Das Depot der 100 besten Aktien der Welt.', 'Mehr erfahren →'],
            ['boerse.de-Gold',                'Physisches Gold einfach und sicher kaufen.','Gold kaufen →'],
            ['boerse.de Vermögensverwaltung', 'Professionelle Geldanlage für jeden.',      'Jetzt informieren →'],
        ];
        foreach ($data as $i => [$label, $title, $link]) {
            $e = (new GruppeNewsItem())->setLabel($label)->setTitle($title)->setLink($link)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedFonds(): void
    {
        $news = [
            ['14:30','Deutsche Börse-News: "So mancher bekommt kalte Füße" (Fondshandel)'],
            ['12:15','FMA-Bericht: Vermögen österreichischer Investmentfonds steigt'],
            ['10:00','Fondsindustrie verzeichnet Nettozuflüsse von 12,3 Mrd. Euro im März'],
        ];
        foreach ($news as $i => [$time, $title]) {
            $e = (new FondsNewsItem())->setTime($time)->setTitle($title)->setSortOrder($i);
            $this->em->persist($e);
        }

        $cats = [
            ['Aktienfonds',     '8.432','DWS Akkumula',        '+12,4%',true],
            ['Rentenfonds',     '4.218','PIMCO Total Return',  '+3,8%', true],
            ['Mischfonds',      '5.672','Flossbach v. Storch', '+7,2%', true],
            ['Rohstofffonds',   '1.024','BGF World Gold',      '-2,1%', false],
            ['Immobilienfonds', '892',  'Deka-ImmobilienEuropa','+1,9%',true],
            ['Garantiefonds',   '312',  'DWS Garant 80',       '+2,5%', true],
        ];
        foreach ($cats as $i => [$name, $count, $top, $ytd, $bullish]) {
            $e = (new FondsCategory())->setName($name)->setCount($count)->setTopPerformer($top)->setYtd($ytd)->setBullish($bullish)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedDerivate(): void
    {
        $cats = [
            ['Hebelprodukte',       'trending_up',    'Optionsscheine, Knock-Outs und Faktor-Zertifikate für aktive Trader.',                '1.284.000'],
            ['Anlage-Zertifikate',  'account_balance','Discount-, Bonus- und Express-Zertifikate für strategische Investments.',             '842.000'],
            ['Optionsscheine',      'swap_vert',       'Calls und Puts auf Aktien, Indizes und Rohstoffe.',                                   '624.000'],
        ];
        foreach ($cats as $i => [$name, $icon, $desc, $count]) {
            $e = (new DerivateCategory())->setName($name)->setIcon($icon)->setDescription($desc)->setCount($count)->setSortOrder($i);
            $this->em->persist($e);
        }

        $products = [
            ['DAX Call 23.000 06/26',        'Société Générale','3,42', '3,44',  '+8,2%',  true],
            ['Nvidia Turbo Long',              'BNP Paribas',     '5,18', '5,22',  '+12,5%', true],
            ['Gold Discount-Zertifikat 12/26', 'Vontobel',        '92,40','92,60', '-0,3%',  false],
            ['Euro Stoxx 50 Bonus Cap',        'HSBC',            '108,20','108,40','+1,1%', true],
        ];
        foreach ($products as $i => [$name, $issuer, $bid, $ask, $change, $bullish]) {
            $e = (new DerivateProduct())->setName($name)->setIssuer($issuer)->setBid($bid)->setAsk($ask)->setChangeVal($change)->setBullish($bullish)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedEtfs(): void
    {
        $cats = [
            ['Aktien-ETFs',    '2.148','iShares Core MSCI World',    '0,20%','52,3 Mrd.'],
            ['Anleihen-ETFs',  '892',  'iShares Euro Govt Bond',     '0,09%','18,7 Mrd.'],
            ['Rohstoff-ETFs',  '324',  'Xetra-Gold',                  '0,00%','14,2 Mrd.'],
            ['Geldmarkt-ETFs', '86',   'Xtrackers EUR Overnight Rate','0,10%','8,4 Mrd.'],
        ];
        foreach ($cats as $i => [$name, $count, $example, $ter, $aum]) {
            $e = (new EtfCategory())->setName($name)->setCount($count)->setExample($example)->setTer($ter)->setAum($aum)->setSortOrder($i);
            $this->em->persist($e);
        }

        $products = [
            ['iShares Core MSCI World',     'IE00B4L5Y983','89,24', '+0,42%',true, '+14,2%'],
            ['Vanguard FTSE All-World',      'IE00BK5BQT80','118,60','+0,38%',true, '+12,8%'],
            ['Xtrackers DAX',               'LU0274211480','198,92','+1,16%',true, '+16,5%'],
            ['iShares Core S&P 500',         'IE00B5BMR087','524,80','+0,50%',true, '+11,9%'],
            ['Amundi MSCI Emerging Markets', 'LU1681045370','5,12',  '-0,28%',false,'+4,1%'],
        ];
        foreach ($products as $i => [$name, $isin, $price, $change, $bullish, $ytd]) {
            $e = (new EtfProduct())->setName($name)->setIsin($isin)->setPrice($price)->setChangeVal($change)->setBullish($bullish)->setYtd($ytd)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedEurex(): void
    {
        $futures = [
            ['DAX-Future (FDAX)',        'Jun 2026','22.785','+268',  '+1,19%',true, '84.230'],
            ['Mini-DAX-Future',           'Jun 2026','22.780','+265',  '+1,18%',true, '42.100'],
            ['Euro STOXX 50 Future',      'Jun 2026','5.425', '+42',   '+0,78%',true, '312.450'],
            ['Euro-Bund-Future',          'Jun 2026','131,42','-0,28', '-0,21%',false,'528.900'],
            ['Euro-Bobl-Future',          'Jun 2026','117,86','-0,14', '-0,12%',false,'198.300'],
        ];
        foreach ($futures as $i => [$name, $expiry, $last, $change, $pct, $bullish, $vol]) {
            $e = (new EurexFuture())->setName($name)->setExpiry($expiry)->setLast($last)->setChangeVal($change)->setPct($pct)->setBullish($bullish)->setVolume($vol)->setSortOrder($i);
            $this->em->persist($e);
        }

        $options = [
            ['DAX-Option (ODAX) Call 23000','Jun 2026','412,00','18,2%','12.840'],
            ['DAX-Option (ODAX) Put 22000', 'Jun 2026','285,00','19,8%','9.620'],
            ['Euro STOXX 50 Call 5500',      'Jun 2026','88,40', '16,5%','28.100'],
            ['Euro STOXX 50 Put 5200',       'Jun 2026','62,20', '17,9%','18.400'],
        ];
        foreach ($options as $i => [$name, $expiry, $last, $iv, $vol]) {
            $e = (new EurexOption())->setName($name)->setExpiry($expiry)->setLast($last)->setIv($iv)->setVolume($vol)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedWissen(): void
    {
        $cats = [
            ['Börsen-Grundlagen',  'school',     ['Was ist eine Aktie?','So eröffnen Sie ein Depot','Orderausführung – was ist zu beachten?','Was sind Bullen- und Bären-Märkte?']],
            ['Anlagestrategien',   'psychology', ['Champions-Aktien: Warum Qualität langfristig gewinnt','Value Aktien – die Value Investing Strategie','Diversifikation mit Champions-Aktien','Dividendenwachstum – mehr als laufende Erträge']],
            ['Steuern & Recht',    'gavel',      ['Aktiengewinne versteuern – das müssen Sie wissen!','Kapitalertragsteuer bzw. Abgeltungssteuer','Sparerpauschbetrag – das sollten Sie wissen!','Altersvorsorgedepot: Förderung & Alternativen']],
            ['Börsenwissen',       'menu_book',  ['Was ist der Dax?','Welche Börsenarten gibt es?','Was sind Futures und Optionen?','Was sind Anleihen?']],
        ];
        foreach ($cats as $i => [$title, $icon, $articles]) {
            $e = (new WissenCategory())->setTitle($title)->setIcon($icon)->setArticles($articles)->setSortOrder($i);
            $this->em->persist($e);
        }
    }

    private function seedService(): void
    {
        $data = [
            ['Aktien-Ausblick',        'Der kostenlose große Aktien-Newsletter.',                    'Kostenlos anfordern','mail'],
            ['Leitfaden für Ihr Vermögen','Deutschlands Kultpublikation für Vermögensaufbau.',     'Gratis bestellen',   'auto_stories'],
            ['Investoren-Club',        'Exklusiver Zugang zu Veranstaltungen und Analysen.',         'Mehr erfahren',      'groups'],
            ['boerse.de-Broker',        'Handeln Sie direkt über boerse.de.',                         'Depot eröffnen',     'account_balance'],
            ['Realtime-Kurse',          'Echtzeitkurse für alle deutschen Börsenplätze.',             'Jetzt nutzen',       'speed'],
            ['Börsenlexikon',           'Über 1.000 Börsenbegriffe einfach erklärt.',                 'Nachschlagen',       'library_books'],
        ];
        foreach ($data as $i => [$name, $desc, $cta, $icon]) {
            $e = (new ServiceItem())->setName($name)->setDescription($desc)->setCta($cta)->setIcon($icon)->setSortOrder($i);
            $this->em->persist($e);
        }
    }
}
