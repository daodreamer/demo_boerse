import type { EurexData } from '../types/api'

interface Props {
  data: EurexData
}

export function EurexSection({ data }: Props) {
  return (
    <section id="eurex" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Eurex</h2>
      <div className="grid lg:grid-cols-2 gap-6">
        {/* Futures */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Futures</h3>
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-surface-container-low border-b border-outline-variant/10">
                <th className="px-5 py-2 text-left text-xs font-bold text-secondary uppercase tracking-wider">Kontrakt</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Letzt.</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">%</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Vol.</th>
              </tr>
            </thead>
            <tbody>
              {data.futures.map((row) => (
                <tr key={row.name} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <td className="px-5 py-3">
                    <p className="font-medium text-on-surface">{row.name}</p>
                    <p className="text-xs text-secondary mt-0.5">Fälligkeit: {row.expiry}</p>
                  </td>
                  <td className="px-5 py-3 text-right font-body">{row.last}</td>
                  <td className={`px-5 py-3 text-right font-bold ${row.bullish ? 'text-primary' : 'text-error'}`}>{row.pct}</td>
                  <td className="px-5 py-3 text-right text-secondary text-xs">{row.volume}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* Optionen */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Optionen</h3>
          <table className="w-full text-sm">
            <thead>
              <tr className="bg-surface-container-low border-b border-outline-variant/10">
                <th className="px-5 py-2 text-left text-xs font-bold text-secondary uppercase tracking-wider">Option</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Prämie</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">IV</th>
                <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Vol.</th>
              </tr>
            </thead>
            <tbody>
              {data.options.map((row) => (
                <tr key={row.name} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <td className="px-5 py-3">
                    <p className="font-medium text-on-surface">{row.name}</p>
                    <p className="text-xs text-secondary mt-0.5">Fälligkeit: {row.expiry}</p>
                  </td>
                  <td className="px-5 py-3 text-right font-body">{row.last}</td>
                  <td className="px-5 py-3 text-right text-secondary">{row.iv}</td>
                  <td className="px-5 py-3 text-right text-secondary text-xs">{row.volume}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  )
}
