import { useHomeData } from './hooks/useHomeData'
import { ActiveSectionContext, useActiveSectionProvider } from './hooks/useActiveSection'
import { LoginModalContext, useLoginModalProvider } from './hooks/useLoginModal'
import { LoginAreaModal } from './components/LoginAreaModal'
import { MeinBoerseModal } from './components/MeinBoerseModal'
import { SimpleLoginModal } from './components/SimpleLoginModal'
import { GroupBar } from './components/layout/GroupBar'
import { TopNav } from './components/layout/TopNav'
import { Sidebar } from './components/layout/Sidebar'
import { Footer } from './components/layout/Footer'
import { TickerBar } from './components/TickerBar'
import { FondsStrip } from './components/FondsStrip'
import { HeroSection } from './components/HeroSection'
import { Tagestrends } from './components/Tagestrends'
import { ExpertsSection } from './components/ExpertsSection'
import { TopsFlops } from './components/TopsFlops'
import { IndizesTable } from './components/IndizesTable'
import { KonjunkturSection } from './components/KonjunkturSection'
import { GruppeNewsSection } from './components/GruppeNewsSection'
import { FondsSection } from './components/FondsSection'
import { DerivateSection } from './components/DerivateSection'
import { EtfSection } from './components/EtfSection'
import { EurexSection } from './components/EurexSection'
import { AnalysenSection } from './components/AnalysenSection'
import { WissenSection } from './components/WissenSection'
import { ServiceSection } from './components/ServiceSection'

export default function App() {
  const { data, loading, error } = useHomeData()
  const activeSectionValue = useActiveSectionProvider()
  const loginModalValue = useLoginModalProvider()

  return (
    <LoginModalContext.Provider value={loginModalValue}>
    <ActiveSectionContext.Provider value={activeSectionValue}>
      <div className="min-h-screen bg-surface font-body">
        <GroupBar />
        <TopNav />
        <Sidebar />

        {/* pt-24 (6rem) on sm + lg+, pt-[8.5rem] on md where secondary nav is visible */}
        <div className="lg:pl-64 pt-24 md:pt-[8.5rem] lg:pt-24">
          {/* Ticker */}
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

          <Footer />
        </div>
      </div>

      <LoginAreaModal />
      <MeinBoerseModal />
      <SimpleLoginModal configKey="boersenverlag" />
      <SimpleLoginModal configKey="investoren-club" />
    </ActiveSectionContext.Provider>
    </LoginModalContext.Provider>
  )
}
