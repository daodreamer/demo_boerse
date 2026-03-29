export interface TickerItem {
  name: string
  price: string
  change: string
  bullish: boolean
}

export interface FundVariant {
  price: string
  change: string
  bullish: boolean
}

export interface Fund {
  name: string
  thes: FundVariant
  aussh: FundVariant
}

export interface GoldData {
  price: string
  change: string
  wkn: string
  bullish: boolean
}

export interface BcdiItem {
  name: string
  price: string
  change: string
  bullish: boolean
}

export interface FondsStrip {
  funds: Fund[]
  gold: GoldData
  bcdi: BcdiItem[]
}

export interface MarketIndex {
  name: string
  price: string
  change: string
  bullish: boolean
  sparkline: string
}

export interface HeroStory {
  image: string
  tag: string
  headline: string
  lead: string
}

export interface NewsItem {
  image: string
  category: string
  timestamp: string
  title: string
  excerpt: string
  style: 'card' | 'list'
}

export interface TagesTab {
  id: string
  label: string
}

export interface TagesStock {
  name: string
  price: string
  change: string
  bullish: boolean
}

export interface TagesPanel {
  bullish: boolean
  high: string
  low: string
  line: string
  stocks: TagesStock[]
}

export interface Tagestrends {
  date: string
  tab_rows: TagesTab[][]
  panels: Record<string, TagesPanel>
}

export interface Expert {
  image: string
  name: string
  role: string
  title: string
  quote: string
  timestamp: string
}

export interface UpcomingEvent {
  date: string
  company: string
  type: string
}

export interface AnalysisItem {
  time: string
  title: string
}

export interface Analyses {
  featured: {
    image: string
    title: string
    excerpt: string
  }
  list: AnalysisItem[]
}

export interface TopFlopItem {
  name: string
  change: string
  sparkline: string | null
}

export interface TopsFlops {
  tops: TopFlopItem[]
  flops: TopFlopItem[]
}

export interface MostSearchedItem {
  name: string
  count: string
}

export interface FeaturedStock {
  name: string
  wkn: string
  since: string
  price: string
  currency: string
  change: string
  bullish: boolean
  excerpt: string
}

export interface AktienNewsItem {
  time: string
  title: string
}

export interface IndizesRow {
  name: string
  aktuell: string
  pkt: string
  pct: string
  bullish: boolean
  high52: string
  low52: string
}

export interface DevisenRow {
  pair: string
  kurs: string
  pct: string
  bullish: boolean
}

export interface RohstoffRow {
  name: string
  kurs: string
  pct: string
  bullish: boolean
}

export interface KonjunkturItem {
  datetime: string
  title: string
}

export interface AnlagestrategItem {
  badge: string
  title: string
  author: string
}

export interface GruppeNewsItem {
  label: string
  title: string
  link: string
}

// Fonds
export interface FondsCategoryItem {
  name: string
  count: number
  topPerformer: string
  ytd: string
  bullish: boolean
}

export interface FondsNewsItem {
  time: string
  title: string
}

export interface FondsData {
  categories: FondsCategoryItem[]
  news: FondsNewsItem[]
}

// Derivate
export interface DerivateCategoryItem {
  name: string
  icon: string
  description: string
  count: number
}

export interface DerivatePopularItem {
  name: string
  issuer: string
  bid: string
  ask: string
  change: string
  bullish: boolean
}

export interface DerivateData {
  categories: DerivateCategoryItem[]
  popular: DerivatePopularItem[]
}

// ETFs
export interface EtfCategoryItem {
  name: string
  count: number
  example: string
  ter: string
  aum: string
}

export interface EtfPopularItem {
  name: string
  isin: string
  price: string
  change: string
  bullish: boolean
  ytd: string
}

export interface EtfsData {
  categories: EtfCategoryItem[]
  popular: EtfPopularItem[]
}

// Eurex
export interface EurexFutureItem {
  name: string
  expiry: string
  last: string
  change: string
  pct: string
  bullish: boolean
  volume: string
}

export interface EurexOptionItem {
  name: string
  expiry: string
  last: string
  iv: string
  volume: string
}

export interface EurexData {
  futures: EurexFutureItem[]
  options: EurexOptionItem[]
}

// Wissen
export interface WissenCategory {
  title: string
  icon: string
  articles: string[]
}

export interface WissenData {
  categories: WissenCategory[]
}

// Service
export interface ServiceItem {
  name: string
  description: string
  cta: string
  icon: string
}

export interface ServiceData {
  items: ServiceItem[]
}

export interface HomeData {
  ticker: TickerItem[]
  fondsStrip: FondsStrip
  marketIndices: MarketIndex[]
  heroStory: HeroStory
  newsItems: NewsItem[]
  tagestrends: Tagestrends
  experts: Expert[]
  events: UpcomingEvent[]
  analyses: Analyses
  topsFlops: TopsFlops
  mostSearched: MostSearchedItem[]
  featuredStock: FeaturedStock
  aktienNews: AktienNewsItem[]
  indizesTable: IndizesRow[]
  devisen: DevisenRow[]
  rohstoffe: RohstoffRow[]
  konjunktur: KonjunkturItem[]
  anlagestrategen: AnlagestrategItem[]
  gruppeNews: GruppeNewsItem[]
  fonds: FondsData
  derivate: DerivateData
  etfs: EtfsData
  eurex: EurexData
  wissen: WissenData
  service: ServiceData
}
