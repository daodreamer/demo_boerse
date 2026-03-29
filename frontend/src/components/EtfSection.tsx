import type { EtfsData } from '../types/api'

interface Props {
  data: EtfsData
}

export function EtfSection({ data }: Props) {
  return (
    <section id="etfs" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">ETFs</h2>
      <div className="grid lg:grid-cols-2 gap-6">
        {/* Kategorien */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">ETF-Kategorien</h3>
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-surface-container-low border-b border-outline-variant/10">
                <th className="px-5 py-2 text-left text-xs font-bold text-secondary uppercase tracking-wider">Kategorie</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Anzahl</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Ø TER</th>
              </tr>
            </thead>
            <tbody>
              {data.categories.map((cat) => (
                <tr key={cat.name} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <td className="px-5 py-3">
                    <p className="font-medium text-on-surface">{cat.name}</p>
                    <p className="text-xs text-secondary mt-0.5">z.B. {cat.example}</p>
                  </td>
                  <td className="px-5 py-3 text-right text-secondary">{cat.count}</td>
                  <td className="px-5 py-3 text-right text-secondary">{cat.ter}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* Beliebte ETFs */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Beliebte ETFs</h3>
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-surface-container-low border-b border-outline-variant/10">
                <th className="px-5 py-2 text-left text-xs font-bold text-secondary uppercase tracking-wider">ETF</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Kurs</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">YTD</th>
              </tr>
            </thead>
            <tbody>
              {data.popular.map((etf) => (
                <tr key={etf.isin} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <td className="px-5 py-3">
                    <p className="font-medium text-on-surface">{etf.name}</p>
                    <p className="text-xs text-secondary mt-0.5">{etf.isin}</p>
                  </td>
                  <td className="px-5 py-3 text-right font-body">{etf.price}</td>
                  <td className={`px-5 py-3 text-right font-bold ${etf.bullish ? 'text-primary' : 'text-error'}`}>{etf.ytd}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  )
}
