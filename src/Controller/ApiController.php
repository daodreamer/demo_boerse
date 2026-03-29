<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api/home', name: 'api_home', methods: ['GET'])]
    public function home(): JsonResponse
    {
        return $this->json([
            'ticker'          => $this->getTicker(),
            'fondsStrip'      => $this->getFondsStrip(),
            'marketIndices'   => $this->getMarketIndices(),
            'heroStory'       => $this->getHeroStory(),
            'newsItems'       => $this->getNewsItems(),
            'tagestrends'     => $this->getTagestrends(),
            'experts'         => $this->getExperts(),
            'events'          => $this->getUpcomingEvents(),
            'analyses'        => $this->getAnalyses(),
            'topsFlops'       => $this->getTopsFlops(),
            'mostSearched'    => $this->getMostSearched(),
            'featuredStock'   => $this->getFeaturedStock(),
            'aktienNews'      => $this->getAktienNews(),
            'indizesTable'    => $this->getIndizesTable(),
            'devisen'         => $this->getDevisen(),
            'rohstoffe'       => $this->getRohstoffe(),
            'konjunktur'      => $this->getKonjunktur(),
            'anlagestrategen' => $this->getAnlagestrategen(),
            'gruppeNews'      => $this->getGruppeNews(),
            'fonds'           => $this->getFondsData(),
            'derivate'        => $this->getDerivateData(),
            'etfs'            => $this->getEtfsData(),
            'eurex'           => $this->getEurexData(),
            'wissen'          => $this->getWissenData(),
            'service'         => $this->getServiceData(),
        ]);
    }

    /** @return array<int, array<string, mixed>> */
    private function getTicker(): array
    {
        return [
            ['name' => 'Dax',      'price' => '22.728',  'change' => '+1,16%', 'bullish' => true],
            ['name' => 'MDax',     'price' => '28.607',  'change' => '-0,77%', 'bullish' => false],
            ['name' => 'TecDax',   'price' => '3.450',   'change' => '-0,78%', 'bullish' => false],
            ['name' => 'SDax',     'price' => '14.512',  'change' => '+0,34%', 'bullish' => true],
            ['name' => 'EUR/USD',  'price' => '1,156',   'change' => '-0,40%', 'bullish' => false],
            ['name' => 'Dow',      'price' => '46.248',  'change' => '+0,03%', 'bullish' => true],
            ['name' => 'Nasdaq',   'price' => '19.842',  'change' => '+0,58%', 'bullish' => true],
            ['name' => 'Gold',     'price' => '4.444',   'change' => '-1,37%', 'bullish' => false],
            ['name' => 'Öl (WTI)', 'price' => '93,17',   'change' => '+1,81%', 'bullish' => true],
            ['name' => 'Bitcoin',  'price' => '70.960',  'change' => '+1,13%', 'bullish' => true],
        ];
    }

    /** @return array<string, mixed> */
    private function getFondsStrip(): array
    {
        return [
            'funds' => [
                [
                    'name'  => 'boerse.de-Aktienfonds',
                    'thes'  => ['price' => '127,37', 'change' => '+0,09%', 'bullish' => true],
                    'aussh' => ['price' => '128,15', 'change' => '+0,13%', 'bullish' => true],
                ],
                [
                    'name'  => 'boerse.de-Weltfonds',
                    'thes'  => ['price' => '118,47', 'change' => '-0,12%', 'bullish' => false],
                    'aussh' => ['price' => '105,16', 'change' => '-0,16%', 'bullish' => false],
                ],
                [
                    'name'  => 'boerse.de-Technologiefonds',
                    'thes'  => ['price' => '129,39', 'change' => '+0,40%', 'bullish' => true],
                    'aussh' => ['price' => '127,39', 'change' => '+0,39%', 'bullish' => true],
                ],
                [
                    'name'  => 'boerse.de-Dividendenfonds',
                    'thes'  => ['price' => '99,26',  'change' => '+0,39%', 'bullish' => true],
                    'aussh' => ['price' => '89,99',  'change' => '+0,39%', 'bullish' => true],
                ],
            ],
            'gold' => ['price' => '394,10', 'change' => '+0,53%', 'wkn' => 'TMG0LD', 'bullish' => true],
            'bcdi' => [
                ['name' => 'BCDI',            'price' => '201,83', 'change' => '+0,39%', 'bullish' => true],
                ['name' => 'BCDI USA',         'price' => '1.642',  'change' => '+0,74%', 'bullish' => true],
                ['name' => 'BCDI Deutschland', 'price' => '824',    'change' => '+1,12%', 'bullish' => true],
            ],
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function getMarketIndices(): array
    {
        return [
            [
                'name'      => 'DAX',
                'price'     => '22.728,00',
                'change'    => '+1,16%',
                'bullish'   => true,
                'sparkline' => 'M0,25 L10,22 L20,24 L30,15 L40,18 L50,10 L60,12 L70,5 L80,8 L90,2 L100,6',
            ],
            [
                'name'      => 'Dow Jones',
                'price'     => '46.248,00',
                'change'    => '+0,03%',
                'bullish'   => true,
                'sparkline' => 'M0,20 L10,18 L20,22 L30,18 L40,16 L50,18 L60,15 L70,16 L80,14 L90,15 L100,14',
            ],
            [
                'name'      => 'Gold (USD)',
                'price'     => '4.444,00',
                'change'    => '-1,37%',
                'bullish'   => false,
                'sparkline' => 'M0,10 L10,12 L20,8 L30,14 L40,12 L50,16 L60,14 L70,20 L80,22 L90,24 L100,26',
            ],
        ];
    }

    /** @return array<string, mixed> */
    private function getHeroStory(): array
    {
        return [
            'image'    => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD_aa6Ls2-04tZIoDyPNi-ViWIDRrTIBkTag63QsEfVS_Aerlmn3Zgwq0v_KbTThDWTxtU-kXcxSBhmGsyyHhf_lhp8TAPTROOOVmw4D0XeBKLUgSQtYl5GiBLqhbdRF9MZxJgFYf4sAV0ZhCDh0XWrTSDdvjCJf0XcAMHsZVxK54NzycWYH7QIl9GRblp9dQohEPYUiKVI3BAlkvxJRbqO_QaZbjmMCmjAfLQ59SkyvTrnTP_Nb2E_HiUdGPN5TdN6nI8acVPbGxc',
            'tag'      => 'Top-Story',
            'headline' => 'Marktbeben an der Wall Street: Droht jetzt die Zinswende?',
            'lead'     => 'Analysten warnen vor volatilen Phasen. Wir zeigen Ihnen, wie Sie Ihr Depot jetzt krisenfest machen und welche Sektoren profitieren.',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function getNewsItems(): array
    {
        return [
            [
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAONX7gDMAmDONC1j7GcCSW28j0F4EGXJ0XO92rZU0zuY0_oXk6a0bcGx3teipOfag3oQgYGndUbHJPUZqXU56ca9SAGXZMpTjqMMEJ_i1pgK5j5faeyQP7JZU2s2fjMc4DHW9hO4-97YtzdZmmu7b7XGx5X6eE3EeAPlzs3C1qSwwgA-VB4V4cm-x0gzzmXitMac_UBSxjMmzlo02uFKTrufqCiDAsJiLm4VvBx22zqbomi1D0wBkOE5lloZ1NLx8ByKkaPYPXVlE',
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
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVOALEgAq_CkwhbOH0l0X8hA08aZUSRviYLFMmUdyF_96KGwH0qhKCzomnydgqf3Eu1Oe2rfRFMgwp0N8GJYPvWnpqjBncAzREpTEuh2436gzro2tBV8mt_4XRO8H3wWqUGkXi33prYg0uqIQxlCoNB02caUtybSGFbY40qwbwOYnkmXFZsrLSXexcHrIPe5JCLZpuVuOg586ofrgJ2ovS0UOe2J3SNLr_MizHxYWPOT-qjFEb93R9T6tSNW2xCMeIRVSsyh0FOPY',
                'category'  => 'Kryptowährungen',
                'timestamp' => 'VOR 6 STUNDEN',
                'title'     => 'Bitcoin ETF-Zulassung: Ein Wendepunkt für den Krypto-Markt?',
                'excerpt'   => 'Institutionelle Investoren drängen in den Markt. Experten sehen neues Allzeithoch in Reichweite.',
                'style'     => 'list',
            ],
        ];
    }

    /** @return array<string, mixed> */
    private function getTagestrends(): array
    {
        return [
            'date' => '25.03.2026',
            'tab_rows' => [
                [
                    ['id' => 'dax',     'label' => 'Dax'],
                    ['id' => 'mdax',    'label' => 'MDax'],
                    ['id' => 'sdax',    'label' => 'SDax'],
                    ['id' => 'tecdax',  'label' => 'TecDax'],
                    ['id' => 'dow',     'label' => 'Dow Jones'],
                ],
                [
                    ['id' => 'bcdi',    'label' => 'BCDI'],
                    ['id' => 'bcdi_us', 'label' => 'BCDI USA'],
                    ['id' => 'bcdi_de', 'label' => 'BCDI Deutschland'],
                ],
                [
                    ['id' => 'aktienfonds', 'label' => 'boerse.de-Aktienfonds'],
                    ['id' => 'weltfonds',   'label' => 'boerse.de-Weltfonds'],
                ],
                [
                    ['id' => 'techfonds', 'label' => 'boerse.de-Technologiefonds'],
                    ['id' => 'divfonds',  'label' => 'boerse.de-Dividendenfonds'],
                ],
            ],
            'panels' => [
                'dax' => [
                    'bullish' => false,
                    'high'    => '23.072,00',
                    'low'     => '22.728,00',
                    'line'    => 'M0,12 C80,8 160,15 240,28 C320,42 390,55 460,62 C510,66 560,70 600,72',
                    'stocks'  => [
                        ['name' => 'Rheinmetall',         'price' => '1.487,75', 'change' => '-0,10', 'bullish' => false],
                        ['name' => 'Scout24',              'price' => '64,40',   'change' => '-0,12', 'bullish' => false],
                        ['name' => 'Henkel Vz',            'price' => '67,39',   'change' => '-0,18', 'bullish' => false],
                        ['name' => 'Heidelberg Materials', 'price' => '180,73',  'change' => '-1,30', 'bullish' => false],
                        ['name' => 'Vonovia',              'price' => '21,42',   'change' => '-1,31', 'bullish' => false],
                        ['name' => 'Qiagen',               'price' => '34,81',   'change' => '-1,44', 'bullish' => false],
                    ],
                ],
                'mdax' => [
                    'bullish' => false,
                    'high'    => '28.850,00',
                    'low'     => '28.520,00',
                    'line'    => 'M0,35 C80,28 160,22 240,30 C320,38 390,34 460,42 C510,48 560,52 600,56',
                    'stocks'  => [
                        ['name' => 'TeamViewer',   'price' => '12,80', 'change' => '+2,10', 'bullish' => true],
                        ['name' => 'Dürr',         'price' => '22,45', 'change' => '+1,05', 'bullish' => true],
                        ['name' => 'Evotec',       'price' => '5,85',  'change' => '-0,85', 'bullish' => false],
                        ['name' => 'Nordex',       'price' => '13,20', 'change' => '-1,20', 'bullish' => false],
                        ['name' => 'Thyssenkrupp', 'price' => '4,92',  'change' => '-2,00', 'bullish' => false],
                        ['name' => 'Aixtron',      'price' => '18,44', 'change' => '+0,76', 'bullish' => true],
                    ],
                ],
                'sdax' => [
                    'bullish' => true,
                    'high'    => '14.612,00',
                    'low'     => '14.420,00',
                    'line'    => 'M0,55 C80,48 160,40 240,35 C320,30 390,28 460,32 C510,30 560,26 600,22',
                    'stocks'  => [
                        ['name' => 'Fielmann',      'price' => '47,90', 'change' => '+1,48', 'bullish' => true],
                        ['name' => 'SMA Solar',     'price' => '16,22', 'change' => '+2,00', 'bullish' => true],
                        ['name' => 'Nagarro',       'price' => '40,10', 'change' => '-0,50', 'bullish' => false],
                        ['name' => 'Knaus Tabbert', 'price' => '22,85', 'change' => '+0,88', 'bullish' => true],
                    ],
                ],
                'tecdax' => [
                    'bullish' => false,
                    'high'    => '3.512,00',
                    'low'     => '3.420,00',
                    'line'    => 'M0,18 C80,14 160,22 240,32 C320,44 390,50 460,58 C510,64 560,68 600,72',
                    'stocks'  => [
                        ['name' => 'SAP SE',           'price' => '242,30', 'change' => '-0,42', 'bullish' => false],
                        ['name' => 'Infineon',         'price' => '28,54',  'change' => '-1,15', 'bullish' => false],
                        ['name' => 'Deutsche Telekom', 'price' => '29,12',  'change' => '+0,35', 'bullish' => true],
                        ['name' => 'QIAGEN',           'price' => '34,81',  'change' => '-1,44', 'bullish' => false],
                        ['name' => 'Nemetschek',       'price' => '94,40',  'change' => '+1,10', 'bullish' => true],
                    ],
                ],
                'dow' => [
                    'bullish' => true,
                    'high'    => '46.410,00',
                    'low'     => '46.100,00',
                    'line'    => 'M0,50 C80,45 160,42 240,44 C320,40 390,36 460,38 C510,36 560,34 600,32',
                    'stocks'  => [
                        ['name' => 'Apple',         'price' => '189,30', 'change' => '+0,55', 'bullish' => true],
                        ['name' => 'Microsoft',     'price' => '415,70', 'change' => '+0,80', 'bullish' => true],
                        ['name' => 'Boeing',        'price' => '172,40', 'change' => '-0,90', 'bullish' => false],
                        ['name' => 'Goldman Sachs', 'price' => '498,20', 'change' => '+1,20', 'bullish' => true],
                        ['name' => 'Chevron',       'price' => '152,80', 'change' => '+2,10', 'bullish' => true],
                    ],
                ],
                'bcdi' => [
                    'bullish' => true,
                    'high'    => '202,50',
                    'low'     => '200,80',
                    'line'    => 'M0,65 C80,58 160,50 240,42 C320,33 390,26 460,20 C510,16 560,13 600,10',
                    'stocks'  => [
                        ['name' => 'Quanta Services',  'price' => '498,00',   'change' => '+2,12', 'bullish' => true],
                        ['name' => 'Cintas',           'price' => '182,40',   'change' => '+0,65', 'bullish' => true],
                        ['name' => 'Alphabet',         'price' => '175,20',   'change' => '+1,08', 'bullish' => true],
                        ['name' => 'Booking Holdings', 'price' => '4.240,00', 'change' => '+0,80', 'bullish' => true],
                    ],
                ],
                'bcdi_us' => [
                    'bullish' => true,
                    'high'    => '1.658,00',
                    'low'     => '1.628,00',
                    'line'    => 'M0,60 C80,52 160,44 240,38 C320,30 390,24 460,18 C510,14 560,11 600,8',
                    'stocks'  => [
                        ['name' => 'Apple',        'price' => '189,30', 'change' => '+0,55', 'bullish' => true],
                        ['name' => 'Visa',         'price' => '280,90', 'change' => '+0,32', 'bullish' => true],
                        ['name' => 'Mastercard',   'price' => '490,20', 'change' => '+0,44', 'bullish' => true],
                        ['name' => 'UnitedHealth', 'price' => '520,80', 'change' => '-0,15', 'bullish' => false],
                    ],
                ],
                'bcdi_de' => [
                    'bullish' => true,
                    'high'    => '830,00',
                    'low'     => '818,00',
                    'line'    => 'M0,68 C80,60 160,50 240,40 C320,30 390,22 460,16 C510,12 560,9 600,7',
                    'stocks'  => [
                        ['name' => 'Allianz',        'price' => '284,90', 'change' => '+1,15', 'bullish' => true],
                        ['name' => 'SAP SE',         'price' => '242,30', 'change' => '-0,42', 'bullish' => false],
                        ['name' => 'Münchener Rück', 'price' => '460,40', 'change' => '+0,88', 'bullish' => true],
                        ['name' => 'Hannover Rück',  'price' => '228,60', 'change' => '+1,30', 'bullish' => true],
                    ],
                ],
                'aktienfonds' => [
                    'bullish' => true,
                    'high'    => '128,40',
                    'low'     => '126,90',
                    'line'    => 'M0,55 C80,50 160,44 240,40 C320,36 390,32 460,28 C510,25 560,22 600,20',
                    'stocks'  => [
                        ['name' => 'Quanta Services', 'price' => '498,00', 'change' => '+2,12', 'bullish' => true],
                        ['name' => 'Allianz',         'price' => '284,90', 'change' => '+1,15', 'bullish' => true],
                        ['name' => 'Alphabet',        'price' => '175,20', 'change' => '+1,08', 'bullish' => true],
                        ['name' => 'Münchener Rück',  'price' => '460,40', 'change' => '+0,88', 'bullish' => true],
                    ],
                ],
                'weltfonds' => [
                    'bullish' => false,
                    'high'    => '119,20',
                    'low'     => '117,90',
                    'line'    => 'M0,25 C80,30 160,36 240,40 C320,46 390,50 460,54 C510,57 560,59 600,62',
                    'stocks'  => [
                        ['name' => 'Visa',      'price' => '280,90', 'change' => '+0,32', 'bullish' => true],
                        ['name' => 'Microsoft', 'price' => '415,70', 'change' => '+0,80', 'bullish' => true],
                        ['name' => 'LVMH',      'price' => '592,00', 'change' => '-0,60', 'bullish' => false],
                        ['name' => 'Nestlé',    'price' => '82,10',  'change' => '-0,85', 'bullish' => false],
                    ],
                ],
                'techfonds' => [
                    'bullish' => true,
                    'high'    => '130,20',
                    'low'     => '128,50',
                    'line'    => 'M0,60 C80,52 160,43 240,36 C320,28 390,22 460,18 C510,14 560,11 600,8',
                    'stocks'  => [
                        ['name' => 'Nvidia',   'price' => '824,40', 'change' => '+3,50', 'bullish' => true],
                        ['name' => 'ASML',     'price' => '820,00', 'change' => '+1,20', 'bullish' => true],
                        ['name' => 'SAP SE',   'price' => '242,30', 'change' => '-0,42', 'bullish' => false],
                        ['name' => 'Infineon', 'price' => '28,54',  'change' => '-1,15', 'bullish' => false],
                    ],
                ],
                'divfonds' => [
                    'bullish' => true,
                    'high'    => '100,10',
                    'low'     => '98,80',
                    'line'    => 'M0,52 C80,46 160,40 240,36 C320,32 390,28 460,26 C510,24 560,22 600,20',
                    'stocks'  => [
                        ['name' => 'Allianz',        'price' => '284,90', 'change' => '+1,15', 'bullish' => true],
                        ['name' => 'Deutsche Post',  'price' => '40,22',  'change' => '+0,50', 'bullish' => true],
                        ['name' => 'Münchener Rück', 'price' => '460,40', 'change' => '+0,88', 'bullish' => true],
                        ['name' => 'Vonovia',        'price' => '21,42',  'change' => '-1,31', 'bullish' => false],
                    ],
                ],
            ],
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function getExperts(): array
    {
        return [
            [
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBsz4MHbDELmIU6OglpukXrvGwNxL2k_qGWtAz5gLm4qi8I4gYdI7Qinx1SKg6r0lIZt36fbD7oZzxvvm3NLjE3AoQSOU2KxdC7FsOgG40w9iCv78zPRUEeWtsgDTDJFmvfcveHieKAQYF4zKZt8ZgIHqGnRS-Z4HZMXroX7-HUqKx2TG1rLeJARNr8vLM6lGYApOSe370f67s63sUkc2QPs9Q8pNO0Qf431B43UfjyxH57GunKDTVUfiej1ON4dpAHYlTw0QRsXXo',
                'name'      => 'Dr. Markus Bauer',
                'role'      => 'Chefanalyst Investment-Check',
                'title'     => '"Die Inflation ist hartnäckiger als gedacht – Strategien für Anleger"',
                'quote'     => '"Wir sehen eine strukturelle Verschiebung. Defensive Qualitätstitel sind jetzt das Gebot der Stunde..."',
                'timestamp' => 'VOR 1 STUNDE',
            ],
            [
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCTYjhrSMMR6819aJOyCPeyH7naWdAq8cLk5VTXC8ATDaJoiJvqpJgWLgXtbriBvjX2_2sE3LMzSOiKlpby3QyTUDIZwezYJoT9ilZTlPOQ775Ow3R7IMbzKUfNmxLy0oN3JOA-EEO-VZiaNK-0m3Z6jALa8vZohwIPDfM4jAiPffwAkkMEMcudto8WfME2oj2MV7DL5Ft8cVCBdwGQ4RI0OfA-u_MfOCMm_fiX6AYCQ7dvLQSxlNYqO837ZD-0o38ZRcAoZhZUeBE',
                'name'      => 'Sarah Lindner',
                'role'      => 'Finanzexpertin & Bloggerin',
                'title'     => '"Warum der DAX-Aufstieg erst der Anfang der Sommerrallye war"',
                'quote'     => '"Die Marktbreite nimmt zu. Auch Small- und MidCaps zeigen nun deutliche Lebenszeichen..."',
                'timestamp' => 'VOR 3 STUNDEN',
            ],
            [
                'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD-3B6BGQbyTVXQIV3DvT2Un63VPERxQzZEMVE0DR3lHp8ydpcKRPDNxrwEZd1c9zinmCdE-6D96He9HR7dQMGs613sWqOlep-4I9x95msG15OHl8NF9Wr7plisfIhOflHawqrYvCDc-O2re3rX1wimc6n3vTwC1raZNMWXx8gu8vYT2eUEfUHUUDrOM1oq9Ru7Fw_a1okp2yxJDKQAtstav0XxVG2WmixcnZCKFciQiP1H4FkpUKaQ9-iasDIYHhyP6V0JZqWvycM',
                'name'      => 'Thomas Müller',
                'role'      => 'Eurex-Spezialist',
                'title'     => '"Absicherungstechniken: So schützen Sie Gewinne mit Optionen"',
                'quote'     => '"Risikomanagement wird oft unterschätzt. Mit diesen einfachen Strategien begrenzen Sie das Drawdown..."',
                'timestamp' => 'VOR 5 STUNDEN',
            ],
        ];
    }

    /** @return array<int, array<string, string>> */
    private function getUpcomingEvents(): array
    {
        return [
            ['date' => '25.03.26', 'company' => 'AP Moeller-Maersk B', 'type' => 'Hauptversammlung'],
            ['date' => '25.03.26', 'company' => 'Electrolux B',        'type' => 'Hauptversammlung'],
            ['date' => '25.03.26', 'company' => 'Enagas',              'type' => 'Hauptversammlung'],
            ['date' => '25.03.26', 'company' => 'Cintas',              'type' => 'Ergebniskonferenz'],
        ];
    }

    /** @return array<string, mixed> */
    private function getAnalyses(): array
    {
        return [
            'featured' => [
                'image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD_aa6Ls2-04tZIoDyPNi-ViWIDRrTIBkTag63QsEfVS_Aerlmn3Zgwq0v_KbTThDWTxtU-kXcxSBhmGsyyHhf_lhp8TAPTROOOVmw4D0XeBKLUgSQtYl5GiBLqhbdRF9MZxJgFYf4sAV0ZhCDh0XWrTSDdvjCJf0XcAMHsZVxK54NzycWYH7QIl9GRblp9dQohEPYUiKVI3BAlkvxJRbqO_QaZbjmMCmjAfLQ59SkyvTrnTP_Nb2E_HiUdGPN5TdN6nI8acVPbGxc',
                'title'   => 'DZ BANK: United Internet "buy"',
                'excerpt' => 'DZ Bank hat den fairen Wert für United Internet von 35,50 auf 33,00 Euro gesenkt, aber die Einstufung auf "Kaufen" belassen.',
            ],
            'list' => [
                ['time' => '16:50 Uhr', 'title' => "ANALYSE-FLASH: DZ Bank hebt Nemetschek auf 'Halten' – Fairer Wert 70 Euro"],
                ['time' => '15:46 Uhr', 'title' => 'DZ BANK: Nemetschek "hold"'],
                ['time' => '15:35 Uhr', 'title' => "ANALYSE-FLASH: DZ Bank senkt fairen Wert für Carl Zeiss Meditec – 'Halten'"],
                ['time' => '14:36 Uhr', 'title' => 'JPMORGAN: K+S "hold"'],
            ],
        ];
    }

    /** @return array<string, mixed> */
    private function getTopsFlops(): array
    {
        return [
            'tops' => [
                ['name' => 'Lanxess',    'change' => '+16,96%', 'sparkline' => 'M0,25 L20,28 L40,15 L60,10 L80,5 L100,2'],
                ['name' => 'LPKF Laser', 'change' => '+9,80%',  'sparkline' => null],
            ],
            'flops' => [
                ['name' => 'HelloFresh',        'change' => '-4,00%', 'sparkline' => 'M0,5 L20,2 L40,12 L60,18 L80,22 L100,28'],
                ['name' => 'Micron Technology', 'change' => '-4,49%', 'sparkline' => null],
            ],
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function getMostSearched(): array
    {
        return [
            ['name' => 'Rheinmetall',    'count' => '60.792'],
            ['name' => 'Siemens Energy', 'count' => '32.712'],
            ['name' => 'Nvidia',         'count' => '24.553'],
            ['name' => 'SAP',            'count' => '22.173'],
            ['name' => 'RENK Group',     'count' => '19.233'],
        ];
    }

    /** @return array<string, mixed> */
    private function getFeaturedStock(): array
    {
        return [
            'name'     => 'Quanta Services',
            'wkn'      => '912294',
            'since'    => '2026',
            'price'    => '498,00',
            'currency' => 'EUR',
            'change'   => '+2,12%',
            'bullish'  => true,
            'excerpt'  => 'Mit dem Anstieg hat die Quanta Services-Aktie ein neues All-Time-High erreicht. Quanta Services ist ein Champion aus dem boerse.de-Aktienbrief.',
        ];
    }

    /** @return array<int, array<string, string>> */
    private function getAktienNews(): array
    {
        return [
            ['time' => '09:15', 'title' => 'Rheinmetall-Tochterfirma steuert Shuttlebusse aus der Ferne'],
            ['time' => '08:28', 'title' => 'ProSiebenSat.1 verkauft zwei Vergleichsplattformen'],
            ['time' => '08:26', 'title' => 'AKTIE IM FOKUS: Heidelberg Materials nach schwacher Dividende leicht im Minus'],
            ['time' => '08:16', 'title' => 'IPO/Medien: SpaceX will mit Börsengang 75 Milliarden Dollar einsammeln'],
            ['time' => '08:00', 'title' => 'EQS-News: LPKF verzeichnet leichte Ergebnisverbesserung in 2025'],
            ['time' => '08:00', 'title' => 'Delivery Hero will weiter wachsen'],
            ['time' => '07:40', 'title' => 'ProSiebenSat.1 erwartet wegen Werbeflaute weiteres schwieriges Jahr'],
            ['time' => '07:35', 'title' => 'Heidelberg Materials will mehr Dividende zahlen'],
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function getIndizesTable(): array
    {
        return [
            ['name' => 'DAX',           'aktuell' => '22.728,00', 'pkt' => '+262,45', 'pct' => '+1,16%', 'bullish' => true,  'high52' => '23.472,30', 'low52' => '17.024,88'],
            ['name' => 'MDAX',          'aktuell' => '28.607,00', 'pkt' => '-222,14', 'pct' => '-0,77%', 'bullish' => false, 'high52' => '29.831,55', 'low52' => '22.407,40'],
            ['name' => 'TecDAX',        'aktuell' => '3.450,00',  'pkt' => '-27,11',  'pct' => '-0,78%', 'bullish' => false, 'high52' => '3.619,22',  'low52' => '2.841,34'],
            ['name' => 'SDAX',          'aktuell' => '14.512,00', 'pkt' => '+49,54',  'pct' => '+0,34%', 'bullish' => true,  'high52' => '14.988,12', 'low52' => '11.302,67'],
            ['name' => 'Dow Jones',     'aktuell' => '46.248,00', 'pkt' => '+13,87',  'pct' => '+0,03%', 'bullish' => true,  'high52' => '47.122,88', 'low52' => '36.611,78'],
            ['name' => 'Nasdaq 100',    'aktuell' => '19.842,00', 'pkt' => '+115,28', 'pct' => '+0,58%', 'bullish' => true,  'high52' => '20.188,44', 'low52' => '16.442,10'],
            ['name' => 'S&P 500',       'aktuell' => '5.722,00',  'pkt' => '+28,61',  'pct' => '+0,50%', 'bullish' => true,  'high52' => '5.878,46',  'low52' => '4.682,11'],
            ['name' => 'Euro Stoxx 50', 'aktuell' => '5.412,30',  'pkt' => '+38,17',  'pct' => '+0,71%', 'bullish' => true,  'high52' => '5.521,20',  'low52' => '4.468,90'],
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function getDevisen(): array
    {
        return [
            ['pair' => 'EUR/USD', 'kurs' => '1,1560', 'pct' => '-0,40%', 'bullish' => false],
            ['pair' => 'EUR/GBP', 'kurs' => '0,8612', 'pct' => '-0,12%', 'bullish' => false],
            ['pair' => 'EUR/JPY', 'kurs' => '161,42', 'pct' => '+0,28%', 'bullish' => true],
            ['pair' => 'USD/JPY', 'kurs' => '139,55', 'pct' => '+0,67%', 'bullish' => true],
            ['pair' => 'GBP/USD', 'kurs' => '1,3421', 'pct' => '-0,31%', 'bullish' => false],
            ['pair' => 'EUR/CHF', 'kurs' => '0,9387', 'pct' => '+0,09%', 'bullish' => true],
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private function getRohstoffe(): array
    {
        return [
            ['name' => 'Gold (USD/oz)',     'kurs' => '4.444,00', 'pct' => '-1,37%', 'bullish' => false],
            ['name' => 'Silber (USD/oz)',   'kurs' => '48,22',    'pct' => '-0,84%', 'bullish' => false],
            ['name' => 'Öl (WTI, USD)',    'kurs' => '93,17',    'pct' => '+1,81%', 'bullish' => true],
            ['name' => 'Öl (Brent, USD)',  'kurs' => '96,44',    'pct' => '+1,65%', 'bullish' => true],
            ['name' => 'Kupfer (USD/t)',    'kurs' => '9.812,00', 'pct' => '+0,43%', 'bullish' => true],
            ['name' => 'Palladium (USD/oz)','kurs' => '1.184,00', 'pct' => '-0,29%', 'bullish' => false],
        ];
    }

    /** @return array<int, array<string, string>> */
    private function getKonjunktur(): array
    {
        return [
            ['datetime' => '26.03.2026 10:30', 'title' => 'US-BIP Q4 2025 bestätigt: +2,3% annualisiert'],
            ['datetime' => '26.03.2026 09:00', 'title' => 'IFO-Geschäftsklima März: Leichte Erholung auf 87,5 Punkte'],
            ['datetime' => '25.03.2026 14:00', 'title' => 'EZB-Protokoll: Mehrheit sieht Raum für weitere Zinssenkungen'],
            ['datetime' => '25.03.2026 10:00', 'title' => 'Inflation Deutschland Februar: +2,2% gegenüber Vorjahr (endgültig)'],
            ['datetime' => '24.03.2026 16:00', 'title' => 'Fed-Mitglied Williams: Zwei Zinssenkungen in 2026 realistisch'],
            ['datetime' => '24.03.2026 12:00', 'title' => 'Eurozone PMI Composite März: 52,1 — Expansion setzt sich fort'],
        ];
    }

    /** @return array<int, array<string, string>> */
    private function getAnlagestrategen(): array
    {
        return [
            ['badge' => 'STRATEGIE', 'title' => 'Champions-Aktien: Warum Qualität langfristig immer gewinnt', 'author' => 'Thomas Müller'],
            ['badge' => 'ANALYSE',   'title' => 'Diversifikation 2026: Rohstoffe als Depotanker',            'author' => 'Jochen Appeltauer'],
            ['badge' => 'KOLUMNE',   'title' => 'Fehler beim Vermögensaufbau: Die teuersten Irrtümer',       'author' => 'Georg Kling'],
        ];
    }

    /** @return array<int, array<string, string>> */
    private function getGruppeNews(): array
    {
        return [
            ['label' => 'boerse.de-Aktienbrief',        'title' => 'Der führende Börsendienst Deutschlands.',   'link' => 'Jetzt kostenlos testen →'],
            ['label' => 'myChampions100',                'title' => 'Das Depot der 100 besten Aktien der Welt.', 'link' => 'Mehr erfahren →'],
            ['label' => 'boerse.de-Gold',                'title' => 'Physisches Gold einfach und sicher kaufen.','link' => 'Gold kaufen →'],
            ['label' => 'boerse.de Vermögensverwaltung', 'title' => 'Professionelle Geldanlage für jeden.',      'link' => 'Jetzt informieren →'],
        ];
    }

    private function getFondsData(): array
    {
        return [
            'news' => [
                ['time' => '14:30', 'title' => 'Deutsche Börse-News: "So mancher bekommt kalte Füße" (Fondshandel)'],
                ['time' => '12:15', 'title' => 'FMA-Bericht: Vermögen österreichischer Investmentfonds steigt'],
                ['time' => '10:00', 'title' => 'Fondsindustrie verzeichnet Nettozuflüsse von 12,3 Mrd. Euro im März'],
            ],
            'categories' => [
                ['name' => 'Aktienfonds',      'count' => '8.432', 'topPerformer' => 'DWS Akkumula',        'ytd' => '+12,4%', 'bullish' => true],
                ['name' => 'Rentenfonds',      'count' => '4.218', 'topPerformer' => 'PIMCO Total Return',  'ytd' => '+3,8%',  'bullish' => true],
                ['name' => 'Mischfonds',       'count' => '5.672', 'topPerformer' => 'Flossbach v. Storch', 'ytd' => '+7,2%',  'bullish' => true],
                ['name' => 'Rohstofffonds',    'count' => '1.024', 'topPerformer' => 'BGF World Gold',      'ytd' => '-2,1%',  'bullish' => false],
                ['name' => 'Immobilienfonds',  'count' => '892',   'topPerformer' => 'Deka-ImmobilienEuropa','ytd' => '+1,9%', 'bullish' => true],
                ['name' => 'Garantiefonds',    'count' => '312',   'topPerformer' => 'DWS Garant 80',       'ytd' => '+2,5%',  'bullish' => true],
            ],
        ];
    }

    private function getDerivateData(): array
    {
        return [
            'categories' => [
                [
                    'name' => 'Hebelprodukte',
                    'icon' => 'trending_up',
                    'description' => 'Optionsscheine, Knock-Outs und Faktor-Zertifikate für aktive Trader.',
                    'count' => '1.284.000',
                ],
                [
                    'name' => 'Anlage-Zertifikate',
                    'icon' => 'account_balance',
                    'description' => 'Discount-, Bonus- und Express-Zertifikate für strategische Investments.',
                    'count' => '842.000',
                ],
                [
                    'name' => 'Optionsscheine',
                    'icon' => 'swap_vert',
                    'description' => 'Calls und Puts auf Aktien, Indizes und Rohstoffe.',
                    'count' => '624.000',
                ],
            ],
            'popular' => [
                ['name' => 'DAX Call 23.000 06/26',       'issuer' => 'Société Générale', 'bid' => '3,42', 'ask' => '3,44', 'change' => '+8,2%',  'bullish' => true],
                ['name' => 'Nvidia Turbo Long',             'issuer' => 'BNP Paribas',      'bid' => '5,18', 'ask' => '5,22', 'change' => '+12,5%', 'bullish' => true],
                ['name' => 'Gold Discount-Zertifikat 12/26','issuer' => 'Vontobel',         'bid' => '92,40','ask' => '92,60','change' => '-0,3%',  'bullish' => false],
                ['name' => 'Euro Stoxx 50 Bonus Cap',       'issuer' => 'HSBC',             'bid' => '108,20','ask'=>'108,40','change' => '+1,1%',  'bullish' => true],
            ],
        ];
    }

    private function getEtfsData(): array
    {
        return [
            'categories' => [
                ['name' => 'Aktien-ETFs',    'count' => '2.148', 'example' => 'iShares Core MSCI World',    'ter' => '0,20%', 'aum' => '52,3 Mrd.'],
                ['name' => 'Anleihen-ETFs',  'count' => '892',   'example' => 'iShares Euro Govt Bond',     'ter' => '0,09%', 'aum' => '18,7 Mrd.'],
                ['name' => 'Rohstoff-ETFs',  'count' => '324',   'example' => 'Xetra-Gold',                  'ter' => '0,00%', 'aum' => '14,2 Mrd.'],
                ['name' => 'Geldmarkt-ETFs', 'count' => '86',    'example' => 'Xtrackers EUR Overnight Rate','ter' => '0,10%', 'aum' => '8,4 Mrd.'],
            ],
            'popular' => [
                ['name' => 'iShares Core MSCI World',      'isin' => 'IE00B4L5Y983', 'price' => '89,24', 'change' => '+0,42%', 'bullish' => true,  'ytd' => '+14,2%'],
                ['name' => 'Vanguard FTSE All-World',       'isin' => 'IE00BK5BQT80', 'price' => '118,60','change' => '+0,38%', 'bullish' => true,  'ytd' => '+12,8%'],
                ['name' => 'Xtrackers DAX',                 'isin' => 'LU0274211480', 'price' => '198,92','change' => '+1,16%', 'bullish' => true,  'ytd' => '+16,5%'],
                ['name' => 'iShares Core S&P 500',           'isin' => 'IE00B5BMR087', 'price' => '524,80','change' => '+0,50%', 'bullish' => true,  'ytd' => '+11,9%'],
                ['name' => 'Amundi MSCI Emerging Markets',  'isin' => 'LU1681045370', 'price' => '5,12',  'change' => '-0,28%', 'bullish' => false, 'ytd' => '+4,1%'],
            ],
        ];
    }

    private function getEurexData(): array
    {
        return [
            'futures' => [
                ['name' => 'DAX-Future (FDAX)',         'expiry' => 'Jun 2026', 'last' => '22.785', 'change' => '+268',   'pct' => '+1,19%', 'bullish' => true,  'volume' => '84.230'],
                ['name' => 'Mini-DAX-Future',            'expiry' => 'Jun 2026', 'last' => '22.780', 'change' => '+265',   'pct' => '+1,18%', 'bullish' => true,  'volume' => '42.100'],
                ['name' => 'Euro STOXX 50 Future',       'expiry' => 'Jun 2026', 'last' => '5.425',  'change' => '+42',    'pct' => '+0,78%', 'bullish' => true,  'volume' => '312.450'],
                ['name' => 'Euro-Bund-Future',           'expiry' => 'Jun 2026', 'last' => '131,42', 'change' => '-0,28',  'pct' => '-0,21%', 'bullish' => false, 'volume' => '528.900'],
                ['name' => 'Euro-Bobl-Future',           'expiry' => 'Jun 2026', 'last' => '117,86', 'change' => '-0,14',  'pct' => '-0,12%', 'bullish' => false, 'volume' => '198.300'],
            ],
            'options' => [
                ['name' => 'DAX-Option (ODAX) Call 23000', 'expiry' => 'Jun 2026', 'last' => '412,00', 'iv' => '18,2%', 'volume' => '12.840'],
                ['name' => 'DAX-Option (ODAX) Put 22000',  'expiry' => 'Jun 2026', 'last' => '285,00', 'iv' => '19,8%', 'volume' => '9.620'],
                ['name' => 'Euro STOXX 50 Call 5500',       'expiry' => 'Jun 2026', 'last' => '88,40',  'iv' => '16,5%', 'volume' => '28.100'],
                ['name' => 'Euro STOXX 50 Put 5200',        'expiry' => 'Jun 2026', 'last' => '62,20',  'iv' => '17,9%', 'volume' => '18.400'],
            ],
        ];
    }

    private function getWissenData(): array
    {
        return [
            'categories' => [
                [
                    'title' => 'Börsen-Grundlagen',
                    'icon'  => 'school',
                    'articles' => [
                        'Was ist eine Aktie?',
                        'So eröffnen Sie ein Depot',
                        'Orderausführung – was ist zu beachten?',
                        'Was sind Bullen- und Bären-Märkte?',
                    ],
                ],
                [
                    'title' => 'Anlagestrategien',
                    'icon'  => 'psychology',
                    'articles' => [
                        'Champions-Aktien: Warum Qualität langfristig gewinnt',
                        'Value Aktien – die Value Investing Strategie',
                        'Diversifikation mit Champions-Aktien',
                        'Dividendenwachstum – mehr als laufende Erträge',
                    ],
                ],
                [
                    'title' => 'Steuern & Recht',
                    'icon'  => 'gavel',
                    'articles' => [
                        'Aktiengewinne versteuern – das müssen Sie wissen!',
                        'Kapitalertragsteuer bzw. Abgeltungssteuer',
                        'Sparerpauschbetrag – das sollten Sie wissen!',
                        'Altersvorsorgedepot: Förderung & Alternativen',
                    ],
                ],
                [
                    'title' => 'Börsenwissen',
                    'icon'  => 'menu_book',
                    'articles' => [
                        'Was ist der Dax?',
                        'Welche Börsenarten gibt es?',
                        'Was sind Futures und Optionen?',
                        'Was sind Anleihen?',
                    ],
                ],
            ],
        ];
    }

    private function getServiceData(): array
    {
        return [
            'items' => [
                ['name' => 'Aktien-Ausblick',      'description' => 'Der kostenlose große Aktien-Newsletter.',                    'cta' => 'Kostenlos anfordern', 'icon' => 'mail'],
                ['name' => 'Leitfaden für Ihr Vermögen', 'description' => 'Deutschlands Kultpublikation für Vermögensaufbau.',     'cta' => 'Gratis bestellen',    'icon' => 'auto_stories'],
                ['name' => 'Investoren-Club',       'description' => 'Exklusiver Zugang zu Veranstaltungen und Analysen.',         'cta' => 'Mehr erfahren',       'icon' => 'groups'],
                ['name' => 'boerse.de-Broker',       'description' => 'Handeln Sie direkt über boerse.de.',                         'cta' => 'Depot eröffnen',      'icon' => 'account_balance'],
                ['name' => 'Realtime-Kurse',         'description' => 'Echtzeitkurse für alle deutschen Börsenplätze.',             'cta' => 'Jetzt nutzen',        'icon' => 'speed'],
                ['name' => 'Börsenlexikon',          'description' => 'Über 1.000 Börsenbegriffe einfach erklärt.',                 'cta' => 'Nachschlagen',        'icon' => 'library_books'],
            ],
        ];
    }
}
