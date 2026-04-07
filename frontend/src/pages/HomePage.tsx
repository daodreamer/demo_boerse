import { useEffect } from 'react'
import { useHomeData } from '../hooks/useHomeData'
import { TickerBar } from '../components/TickerBar'
import { FondsStrip } from '../components/FondsStrip'
import { HeroSection } from '../components/HeroSection'
import { Tagestrends } from '../components/Tagestrends'
import { ExpertsSection } from '../components/ExpertsSection'
import { TopsFlops } from '../components/TopsFlops'
import { IndizesTable } from '../components/IndizesTable'
import { KonjunkturSection } from '../components/KonjunkturSection'
import { GruppeNewsSection } from '../components/GruppeNewsSection'
import { FondsSection } from '../components/FondsSection'
import { DerivateSection } from '../components/DerivateSection'
import { EtfSection } from '../components/EtfSection'
import { EurexSection } from '../components/EurexSection'
import { AnalysenSection } from '../components/AnalysenSection'
import { WissenSection } from '../components/WissenSection'
import { ServiceSection } from '../components/ServiceSection'

const SCROLL_OFFSET = 96

export function HomePage() {
  const { data, loading, error } = useHomeData()

  // After data renders, scroll to hash if navigated here from another page
  useEffect(() => {
    if (!data || !window.location.hash) return
    const hash = window.location.hash
    const timer = setTimeout(() => {
      const target = document.querySelector(hash)
      if (target) {
        const top = target.getBoundingClientRect().top + window.scrollY - SCROLL_OFFSET
        window.scrollTo({ top, behavior: 'smooth' })
      }
    }, 100)
    return () => clearTimeout(timer)
  }, [data])

  return (
    <>
      {data && <TickerBar items={data.ticker} />}

      <main className="px-6 lg:px-10 py-6 w-full">
        {loading && (
          <div className="flex items-center justify-center h-64">
            <div className="w-8 h-8 border-4 border-primary border-t-transparent rounded-full animate-spin" />
          </div>
        )}

        {error && (
          <div className="bg-error-container text-error rounded-xl p-6 text-center">
            <p className="font-bold mb-1">Fehler beim Laden</p>
            <p className="text-sm">{error}</p>
            <p className="text-xs mt-2 text-secondary">Symfony-Server läuft auf localhost:8000?</p>
          </div>
        )}

        {data && (
          <>
            <FondsStrip data={data.fondsStrip} />
            <HeroSection hero={data.heroStory} newsItems={data.newsItems} />
            <Tagestrends data={data.tagestrends} />
            <TopsFlops data={data.topsFlops} mostSearched={data.mostSearched} />
            <FondsSection data={data.fonds} />
            <DerivateSection data={data.derivate} />
            <IndizesTable indizes={data.indizesTable} devisen={data.devisen} rohstoffe={data.rohstoffe} />
            <EtfSection data={data.etfs} />
            <EurexSection data={data.eurex} />
            <AnalysenSection data={data.analyses} />
            <ExpertsSection experts={data.experts} />
            <WissenSection data={data.wissen} />
            <ServiceSection data={data.service} />
            <KonjunkturSection konjunktur={data.konjunktur} anlagestrategen={data.anlagestrategen} />
            <GruppeNewsSection items={data.gruppeNews} />
          </>
        )}
      </main>
    </>
  )
}
