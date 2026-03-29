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
