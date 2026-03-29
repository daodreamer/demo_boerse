<?php

namespace App\Repository;

use App\Entity\SiteConfig;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Aggregates all home page data from the database.
 */
class HomeDataRepository
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function getHomeData(): array
    {
        $cfg = fn(string $key) => $this->em->getRepository(SiteConfig::class)->find($key)?->getValue();

        $ticker = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\TickerItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $fondsStripFunds = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\FondsStripFund::class)->findBy([], ['sortOrder' => 'ASC']));

        $marketIndices = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\MarketIndex::class)->findBy([], ['sortOrder' => 'ASC']));

        $newsItems = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\NewsItem::class)->findBy([], ['sortOrder' => 'ASC']));

        // Tagestrends tabs
        $tabRows = [];
        $tabs = $this->em->getRepository(\App\Entity\TagesTab::class)->findBy([], ['rowIndex' => 'ASC', 'sortOrder' => 'ASC']);
        foreach ($tabs as $tab) {
            $tabRows[$tab->getRowIndex()][] = ['id' => $tab->getTabId(), 'label' => $tab->getLabel()];
        }
        ksort($tabRows);
        $tabRows = array_values($tabRows);

        $panelEntities = $this->em->getRepository(\App\Entity\TagesPanel::class)->findAll();
        $panels = [];
        foreach ($panelEntities as $panel) {
            $panels[$panel->getTabId()] = $panel->toArray();
        }

        $experts = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\Expert::class)->findBy([], ['sortOrder' => 'ASC']));

        $events = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\EventItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $analysesList = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\AnalysisListItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $topsRaw   = $this->em->getRepository(\App\Entity\TopFlopItem::class)->findBy(['type' => 'top'],  ['sortOrder' => 'ASC']);
        $flopsRaw  = $this->em->getRepository(\App\Entity\TopFlopItem::class)->findBy(['type' => 'flop'], ['sortOrder' => 'ASC']);

        $mostSearched = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\MostSearchedItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $aktienNews = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\AktienNewsItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $indizesTable = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\IndizesRow::class)->findBy([], ['sortOrder' => 'ASC']));

        $devisen = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\DevisenRow::class)->findBy([], ['sortOrder' => 'ASC']));

        $rohstoffe = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\RohstoffRow::class)->findBy([], ['sortOrder' => 'ASC']));

        $konjunktur = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\KonjunkturItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $anlagestrategen = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\AnlagestrategItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $gruppeNews = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\GruppeNewsItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $fondsCategories = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\FondsCategory::class)->findBy([], ['sortOrder' => 'ASC']));

        $fondsNews = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\FondsNewsItem::class)->findBy([], ['sortOrder' => 'ASC']));

        $derivateCategories = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\DerivateCategory::class)->findBy([], ['sortOrder' => 'ASC']));

        $derivateProducts = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\DerivateProduct::class)->findBy([], ['sortOrder' => 'ASC']));

        $etfCategories = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\EtfCategory::class)->findBy([], ['sortOrder' => 'ASC']));

        $etfProducts = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\EtfProduct::class)->findBy([], ['sortOrder' => 'ASC']));

        $eurexFutures = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\EurexFuture::class)->findBy([], ['sortOrder' => 'ASC']));

        $eurexOptions = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\EurexOption::class)->findBy([], ['sortOrder' => 'ASC']));

        $wissenCategories = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\WissenCategory::class)->findBy([], ['sortOrder' => 'ASC']));

        $serviceItems = array_map(fn($e) => $e->toArray(),
            $this->em->getRepository(\App\Entity\ServiceItem::class)->findBy([], ['sortOrder' => 'ASC']));

        return [
            'ticker'          => $ticker,
            'fondsStrip'      => [
                'funds' => $fondsStripFunds,
                'gold'  => $cfg('fonds_strip_gold') ?? [],
                'bcdi'  => $cfg('fonds_strip_bcdi') ?? [],
            ],
            'marketIndices'   => $marketIndices,
            'heroStory'       => $cfg('hero_story') ?? [],
            'newsItems'       => $newsItems,
            'tagestrends'     => [
                'date'     => $cfg('tagestrends_date') ?? '',
                'tab_rows' => $tabRows,
                'panels'   => $panels,
            ],
            'experts'         => $experts,
            'events'          => $events,
            'analyses'        => [
                'featured' => $cfg('analyses_featured') ?? [],
                'list'     => $analysesList,
            ],
            'topsFlops'       => [
                'tops'  => array_map(fn($e) => $e->toArray(), $topsRaw),
                'flops' => array_map(fn($e) => $e->toArray(), $flopsRaw),
            ],
            'mostSearched'    => $mostSearched,
            'featuredStock'   => $cfg('featured_stock') ?? [],
            'aktienNews'      => $aktienNews,
            'indizesTable'    => $indizesTable,
            'devisen'         => $devisen,
            'rohstoffe'       => $rohstoffe,
            'konjunktur'      => $konjunktur,
            'anlagestrategen' => $anlagestrategen,
            'gruppeNews'      => $gruppeNews,
            'fonds'           => ['news' => $fondsNews, 'categories' => $fondsCategories],
            'derivate'        => ['categories' => $derivateCategories, 'popular' => $derivateProducts],
            'etfs'            => ['categories' => $etfCategories, 'popular' => $etfProducts],
            'eurex'           => ['futures' => $eurexFutures, 'options' => $eurexOptions],
            'wissen'          => ['categories' => $wissenCategories],
            'service'         => ['items' => $serviceItems],
        ];
    }
}
