import type { FondsData } from '../types/api'

interface Props {
  data: FondsData
}

export function FondsSection({ data }: Props) {
  return (
    <section id="fonds" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Fonds</h2>
      <div className="grid lg:grid-cols-2 gap-6">
        {/* Kategorien */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Fondskategorien</h3>
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-surface-container-low border-b border-outline-variant/10">
                <th className="px-5 py-2 text-left text-xs font-bold text-secondary uppercase tracking-wider">Kategorie</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Fonds</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">YTD</th>
              </tr>
            </thead>
            <tbody>
              {data.categories.map((cat) => (
                <tr key={cat.name} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <td className="px-5 py-3">
                    <p className="font-medium text-on-surface">{cat.name}</p>
                    <p className="text-xs text-secondary mt-0.5">Top: {cat.topPerformer}</p>
                  </td>
                  <td className="px-5 py-3 text-right text-secondary">{cat.count.toLocaleString()}</td>
                  <td className={`px-5 py-3 text-right font-bold ${cat.bullish ? 'text-primary' : 'text-error'}`}>{cat.ytd}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* News */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Fonds-News</h3>
          <div className="divide-y divide-outline-variant/10">
            {data.news.map((item, i) => (
              <div key={i} className="px-5 py-3 hover:bg-surface-container-low transition-colors cursor-pointer">
                <p className="text-[10px] text-secondary mb-1 uppercase tracking-wider">{item.time}</p>
                <p className="font-body text-sm text-on-surface">{item.title}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
