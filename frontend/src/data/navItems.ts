export interface NavItem {
  icon: string
  label: string
  href: string
}

export const navItems: NavItem[] = [
  { icon: 'trending_up',            label: 'Aktien',    href: '#aktien'    },
  { icon: 'account_balance_wallet', label: 'Fonds',     href: '#fonds'     },
  { icon: 'query_stats',            label: 'Derivate',  href: '#derivate'  },
  { icon: 'currency_exchange',      label: 'Devisen',   href: '#devisen'   },
  { icon: 'layers',                 label: 'ETFs',      href: '#etfs'      },
  { icon: 'analytics',              label: 'Eurex',     href: '#eurex'     },
  { icon: 'show_chart',             label: 'Indizes',   href: '#indizes'   },
  { icon: 'oil_barrel',             label: 'Rohstoffe', href: '#rohstoffe' },
  { icon: 'article',                label: 'News',      href: '#news'      },
  { icon: 'bar_chart',              label: 'Analysen',  href: '#analysen'  },
  { icon: 'person',                 label: 'Experten',  href: '#experten'  },
  { icon: 'school',                 label: 'Wissen',    href: '#wissen'    },
  { icon: 'build',                  label: 'Service',   href: '#service'   },
]

export const kostenlosLinks = [
  { label: 'mein.boerse.de',                href: '#' },
  { label: 'boerse.de-Investoren-Club',      href: '#' },
  { label: 'boerse.de-Aktien-Ausblick',      href: '#' },
  { label: 'Der Leitfaden für Ihr Vermögen', href: '#' },
  { label: 'Aktienbrief (Gratis-PDF)',        href: '#' },
  { label: 'Mission pro Börse',               href: '#' },
]

export const boerseInhalteLinks = [
  { label: 'boerse.de-Fonds',                 href: '#', neu: false },
  { label: 'myChampions100',                  href: '#', neu: false },
  { label: 'boerse.de Vermögensverwaltung',   href: '#', neu: false },
  { label: 'boerse.de-Indizes',               href: '#', neu: false },
  { label: 'boerse.de-Aktienbrief',           href: '#', neu: false },
  { label: 'boerse.de-Gold',                  href: '#', neu: false },
  { label: 'Protect-Megatrend-Portfolio!',    href: '#', neu: true  },
]

export interface AktienLink {
  label: string
  href: string
  neu?: boolean
  highlight?: boolean
}

export interface AktienGroup {
  title: string
  links: AktienLink[]
}

export const aktienMegaMenu: AktienGroup[][] = [
  // Column 1
  [
    {
      title: 'News & Analysen',
      links: [
        { label: 'Adhocs', href: '#' },
        { label: 'Aktien-News', href: '#' },
        { label: 'Aktiensplits', href: '#' },
        { label: 'Banken-Prognosen', href: '#' },
        { label: 'Dividenden', href: '#' },
        { label: 'Insider Trades', href: '#' },
        { label: 'IPOs', href: '/ipos' },
        { label: 'Unternehmenstermine', href: '#' },
      ],
    },
    {
      title: 'Analysen & Tools',
      links: [
        { label: 'Aktien-Chartanalysen', href: '#' },
        { label: 'Chart-Tool', href: '#' },
        { label: 'Beliebteste Aktien', href: '#' },
        { label: 'Kursmarken-Suche', href: '#' },
        { label: 'Performance-Checks', href: '#' },
      ],
    },
  ],
  // Column 2
  [
    {
      title: 'Wissen & Services',
      links: [
        { label: 'Aktien-Ausblick', href: '#' },
        { label: 'boerse.de-Aktienbrief', href: '#' },
        { label: 'Börsendienste', href: '#' },
        { label: 'Experten', href: '#' },
        { label: 'Leitfaden', href: '#' },
        { label: 'Investoren-Club', href: '#' },
        { label: 'Verdoppeln ist das Mindeste!', href: '#' },
        { label: 'Börsenwohlstand für Alle!', href: '#' },
      ],
    },
    {
      title: 'Kurse & Indizes',
      links: [
        { label: 'Aktienkurse (Übersicht)', href: '#' },
        { label: 'Realtimekurse (Übersicht)', href: '#' },
      ],
    },
    {
      title: 'Deutsche Indizes',
      links: [
        { label: 'Dax 40 Realtimekurse', href: '#' },
        { label: 'MDax Realtimekurse', href: '#' },
        { label: 'TecDax Realtimekurse', href: '#' },
        { label: 'SDax Realtimekurse', href: '#' },
      ],
    },
  ],
  // Column 3
  [
    {
      title: 'Internationale Indizes',
      links: [
        { label: 'Dow Jones Realtimekurse', href: '#' },
        { label: 'Nasdaq Realtimekurse', href: '#' },
        { label: 'S&P 500 Realtimekurse', href: '#' },
        { label: 'MSCI World Realtimekurse', href: '#' },
        { label: 'Euro Stoxx 50 Realtimekurse', href: '#' },
        { label: 'BCI Realtimekurse', href: '#' },
      ],
    },
    {
      title: 'Investments & Strategien',
      links: [
        { label: 'BCDI', href: '#' },
        { label: 'boerse.de-Fonds', href: '#' },
        { label: 'boerse.de Vermögensverwaltung', href: '#' },
        { label: 'myChampions100', href: '#' },
        { label: 'myChampions100GOLD', href: '#', highlight: true, neu: true },
        { label: 'myChampions100BITCOIN', href: '#', highlight: true },
        { label: 'myChampions100GOLD-BITCOIN', href: '#', highlight: true },
        { label: 'myChampionsPREMIUM', href: '#' },
        { label: 'Protect-Megatrend-Portfolio', href: '#', neu: true },
        { label: 'Erfolgreiche Vermögensverwaltung', href: '#' },
        { label: 'Depot eröffnen', href: '#' },
        { label: 'Mission pro Börse', href: '#' },
        { label: 'boerse.de-Stiftung', href: '#' },
        { label: 'TM-Depot', href: '#' },
        { label: 'Millionen-Depot', href: '#' },
      ],
    },
  ],
  // Column 4
  [
    {
      title: 'boerse.de-Fonds',
      links: [
        { label: 'boerse.de-Aktienfonds (thesaurierend)', href: '#' },
        { label: 'boerse.de-Aktienfonds (ausschüttend)', href: '#' },
        { label: 'boerse.de-Weltfonds (thesaurierend)', href: '#' },
        { label: 'boerse.de-Weltfonds (ausschüttend)', href: '#' },
        { label: 'boerse.de-Technologiefonds (thesaurierend)', href: '#' },
        { label: 'boerse.de-Technologiefonds (ausschüttend)', href: '#' },
        { label: 'boerse.de-Dividendenfonds (thesaurierend)', href: '#' },
        { label: 'boerse.de-Dividendenfonds (ausschüttend)', href: '#' },
      ],
    },
    {
      title: 'BCDI-Indizes',
      links: [
        { label: 'BCDI Realtimekurse', href: '#' },
        { label: 'BCDI Deutschland Realtimekurse', href: '#' },
        { label: 'BCDI USA Realtimekurse', href: '#' },
      ],
    },
    {
      title: 'Aktien-Kategorien',
      links: [
        { label: 'Technologie-Aktien', href: '#' },
        { label: 'Deutsche Aktien', href: '#' },
        { label: 'US-Aktien', href: '#' },
        { label: 'boerse.de-Aktien-Reports', href: '#', neu: true, highlight: true },
      ],
    },
  ],
]
