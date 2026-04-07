import { useState } from 'react'
import { Link } from 'react-router-dom'

interface PlannedIpo {
  company: string
  branche: string
  segment: string
  preisspanne: string
  volumen: string
  zeichnung: string
  boersenstart: string
}

interface RecentIpo {
  datum: string
  company: string
  branche: string
  ausgabepreis: string
  aktuell: string
  performance: number
}

const plannedIpos: PlannedIpo[] = [
  {
    company: 'Lemonero AG',
    branche: 'Fintech',
    segment: 'Scale',
    preisspanne: '€ 18,00 – € 22,00',
    volumen: '€ 45 Mio.',
    zeichnung: '10.04. – 24.04.2026',
    boersenstart: '02.05.2026',
  },
  {
    company: 'GreenPower Solutions GmbH',
    branche: 'Erneuerbare Energie',
    segment: 'Prime Standard',
    preisspanne: '€ 12,50 – € 15,00',
    volumen: '€ 120 Mio.',
    zeichnung: '15.04. – 29.04.2026',
    boersenstart: '08.05.2026',
  },
  {
    company: 'MedVision SE',
    branche: 'Medizintechnik',
    segment: 'Prime Standard',
    preisspanne: '€ 25,00 – € 30,00',
    volumen: '€ 200 Mio.',
    zeichnung: '22.04. – 06.05.2026',
    boersenstart: '14.05.2026',
  },
  {
    company: 'LogiTrack AG',
    branche: 'Logistik & Software',
    segment: 'General Standard',
    preisspanne: '€ 8,00 – € 10,50',
    volumen: '€ 30 Mio.',
    zeichnung: '05.05. – 16.05.2026',
    boersenstart: '26.05.2026',
  },
]

const recentIpos: RecentIpo[] = [
  { datum: '14.03.2026', company: 'DataFlow AG', branche: 'Software / KI', ausgabepreis: '€ 22,50', aktuell: '€ 25,29', performance: 12.4 },
  { datum: '28.02.2026', company: 'NordTech GmbH', branche: 'Halbleiter', ausgabepreis: '€ 15,00', aktuell: '€ 16,23', performance: 8.2 },
  { datum: '12.02.2026', company: 'BioPharm SE', branche: 'Pharmazeutik', ausgabepreis: '€ 31,00', aktuell: '€ 30,04', performance: -3.1 },
  { datum: '26.01.2026', company: 'CloudBase AG', branche: 'Cloud-Infrastruktur', ausgabepreis: '€ 18,50', aktuell: '€ 23,05', performance: 24.6 },
  { datum: '10.01.2026', company: 'AutoDrive SE', branche: 'Mobilität / E-Auto', ausgabepreis: '€ 42,00', aktuell: '€ 39,14', performance: -6.8 },
  { datum: '05.12.2025', company: 'FinanZ Digital AG', branche: 'Fintech', ausgabepreis: '€ 9,50', aktuell: '€ 11,20', performance: 17.9 },
  { datum: '18.11.2025', company: 'SolarGrid GmbH', branche: 'Energie', ausgabepreis: '€ 14,00', aktuell: '€ 13,30', performance: -5.0 },
  { datum: '03.11.2025', company: 'RetailMind SE', branche: 'E-Commerce / KI', ausgabepreis: '€ 27,00', aktuell: '€ 31,40', performance: 16.3 },
]

type Tab = 'geplant' | '2026' | '2025'

export function IpoPage() {
  const [activeTab, setActiveTab] = useState<Tab>('geplant')

  const tabs: { id: Tab; label: string }[] = [
    { id: 'geplant', label: 'Geplant' },
    { id: '2026', label: '2026' },
    { id: '2025', label: '2025' },
  ]

  const filtered2026 = recentIpos.filter((ipo) => ipo.datum.endsWith('2026'))
  const filtered2025 = recentIpos.filter((ipo) => ipo.datum.endsWith('2025'))

  return (
    <main className="px-6 lg:px-10 py-6 w-full">
      {/* Breadcrumb */}
      <nav className="flex items-center gap-1.5 text-xs text-secondary mb-4">
        <Link to="/" className="hover:text-primary transition-colors">Startseite</Link>
        <span className="material-symbols-outlined text-sm">chevron_right</span>
        <span className="hover:text-primary transition-colors cursor-pointer">Aktien</span>
        <span className="material-symbols-outlined text-sm">chevron_right</span>
        <span className="text-on-surface font-medium">IPOs</span>
      </nav>

      {/* Page title */}
      <div className="mb-6">
        <h1 className="font-headline font-bold text-2xl text-on-surface mb-1">
          IPOs – Börsengänge
        </h1>
        <p className="text-sm text-secondary">
          Aktuelle und geplante Börsengänge (Initial Public Offerings) im Überblick. Alle Neuemissionen mit Preisspanne, Zeichnungsfrist und Performance nach dem Börsenstart.
        </p>
      </div>

      {/* Stats bar */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {[
          { label: 'Geplante IPOs', value: '4', icon: 'schedule' },
          { label: 'IPOs 2026', value: '5', icon: 'trending_up' },
          { label: 'Ø Performance 2026', value: '+11,3 %', icon: 'bar_chart', bullish: true },
          { label: 'Gesamtvolumen 2026', value: '€ 395 Mio.', icon: 'payments' },
        ].map((stat) => (
          <div key={stat.label} className="bg-white dark:bg-[#001a3a] ghost-border rounded-xl px-5 py-4">
            <div className="flex items-center gap-2 mb-1">
              <span className="material-symbols-outlined text-base text-primary">{stat.icon}</span>
              <span className="text-xs text-secondary">{stat.label}</span>
            </div>
            <p className={`font-headline font-bold text-xl ${stat.bullish ? 'text-primary' : 'text-on-surface'}`}>
              {stat.value}
            </p>
          </div>
        ))}
      </div>

      {/* Tabs */}
      <div className="flex gap-0 mb-0 border-b border-outline-variant/15">
        {tabs.map((tab) => (
          <button
            key={tab.id}
            onClick={() => setActiveTab(tab.id)}
            className={`px-5 py-2.5 text-sm font-medium border-b-2 transition-colors ${
              activeTab === tab.id
                ? 'border-primary text-primary'
                : 'border-transparent text-secondary hover:text-on-surface'
            }`}
          >
            {tab.label}
          </button>
        ))}
      </div>

      {/* Tab: Geplant */}
      {activeTab === 'geplant' && (
        <div className="bg-white dark:bg-[#001a3a] ghost-border rounded-b-xl rounded-tr-xl overflow-hidden">
          <div className="px-5 py-4 border-b border-outline-variant/10 bg-surface-container-low flex items-center justify-between">
            <h2 className="font-headline font-bold text-sm text-on-surface">Geplante Börsengänge</h2>
            <span className="text-xs text-secondary">{plannedIpos.length} Einträge</span>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="border-b border-outline-variant/10">
                  <th className="px-5 py-3 text-left text-xs font-bold text-secondary uppercase tracking-wider">Unternehmen</th>
                  <th className="px-5 py-3 text-left text-xs font-bold text-secondary uppercase tracking-wider">Branche</th>
                  <th className="px-5 py-3 text-left text-xs font-bold text-secondary uppercase tracking-wider">Segment</th>
                  <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Preisspanne</th>
                  <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Volumen</th>
                  <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Zeichnungsfrist</th>
                  <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Börsenstart</th>
                </tr>
              </thead>
              <tbody>
                {plannedIpos.map((ipo) => (
                  <tr
                    key={ipo.company}
                    className="border-t border-outline-variant/10 hover:bg-surface-container-low dark:hover:bg-white/5 transition-colors cursor-pointer"
                  >
                    <td className="px-5 py-3.5">
                      <span className="font-medium text-on-surface hover:text-primary transition-colors">
                        {ipo.company}
                      </span>
                    </td>
                    <td className="px-5 py-3.5 text-secondary">{ipo.branche}</td>
                    <td className="px-5 py-3.5">
                      <span className="text-xs bg-surface-container-low dark:bg-white/10 text-secondary px-2 py-0.5 rounded-full">
                        {ipo.segment}
                      </span>
                    </td>
                    <td className="px-5 py-3.5 text-right font-body text-on-surface">{ipo.preisspanne}</td>
                    <td className="px-5 py-3.5 text-right text-secondary">{ipo.volumen}</td>
                    <td className="px-5 py-3.5 text-right text-secondary text-xs">{ipo.zeichnung}</td>
                    <td className="px-5 py-3.5 text-right">
                      <span className="text-xs font-medium text-primary">{ipo.boersenstart}</span>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
          <div className="px-5 py-3 border-t border-outline-variant/10 bg-surface-container-low">
            <p className="text-xs text-secondary">
              * Alle Angaben ohne Gewähr. Preisspannen und Termine können sich ändern.
            </p>
          </div>
        </div>
      )}

      {/* Tab: 2026 / 2025 */}
      {(activeTab === '2026' || activeTab === '2025') && (
        <div className="bg-white dark:bg-[#001a3a] ghost-border rounded-b-xl rounded-tr-xl overflow-hidden">
          <div className="px-5 py-4 border-b border-outline-variant/10 bg-surface-container-low flex items-center justify-between">
            <h2 className="font-headline font-bold text-sm text-on-surface">
              Börsengänge {activeTab}
            </h2>
            <span className="text-xs text-secondary">
              {activeTab === '2026' ? filtered2026.length : filtered2025.length} Einträge
            </span>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="border-b border-outline-variant/10">
                  <th className="px-5 py-3 text-left text-xs font-bold text-secondary uppercase tracking-wider">Datum</th>
                  <th className="px-5 py-3 text-left text-xs font-bold text-secondary uppercase tracking-wider">Unternehmen</th>
                  <th className="px-5 py-3 text-left text-xs font-bold text-secondary uppercase tracking-wider">Branche</th>
                  <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Ausgabepreis</th>
                  <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Aktuell</th>
                  <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Performance</th>
                </tr>
              </thead>
              <tbody>
                {(activeTab === '2026' ? filtered2026 : filtered2025).map((ipo) => (
                  <tr
                    key={ipo.company}
                    className="border-t border-outline-variant/10 hover:bg-surface-container-low dark:hover:bg-white/5 transition-colors cursor-pointer"
                  >
                    <td className="px-5 py-3.5 text-secondary text-xs">{ipo.datum}</td>
                    <td className="px-5 py-3.5 font-medium text-on-surface hover:text-primary transition-colors">
                      {ipo.company}
                    </td>
                    <td className="px-5 py-3.5 text-secondary">{ipo.branche}</td>
                    <td className="px-5 py-3.5 text-right font-body text-on-surface">{ipo.ausgabepreis}</td>
                    <td className="px-5 py-3.5 text-right font-body text-on-surface">{ipo.aktuell}</td>
                    <td className={`px-5 py-3.5 text-right font-bold ${ipo.performance >= 0 ? 'text-primary' : 'text-error'}`}>
                      {ipo.performance >= 0 ? '+' : ''}{ipo.performance.toFixed(1).replace('.', ',')} %
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      )}

      {/* Info box */}
      <div className="mt-6 bg-white dark:bg-[#001a3a] ghost-border rounded-xl p-5">
        <h3 className="font-headline font-bold text-sm text-on-surface mb-3 flex items-center gap-2">
          <span className="material-symbols-outlined text-base text-primary">info</span>
          Was ist ein IPO?
        </h3>
        <p className="text-sm text-secondary leading-relaxed mb-2">
          Ein <strong className="text-on-surface">IPO (Initial Public Offering)</strong> oder Börsengang bezeichnet den erstmaligen Verkauf von Aktien eines Unternehmens an die Öffentlichkeit über eine Wertpapierbörse. Durch den Börsengang erhält das Unternehmen Zugang zu Kapital von einer breiten Investorenbasis.
        </p>
        <p className="text-sm text-secondary leading-relaxed">
          Anleger können während der <strong className="text-on-surface">Zeichnungsfrist</strong> Aktien zum Ausgabepreis zeichnen. Nach dem Börsenstart werden die Aktien frei gehandelt, und der Kurs kann sowohl über als auch unter dem Ausgabepreis liegen.
        </p>
      </div>
    </main>
  )
}
