import type { IndizesRow, DevisenRow, RohstoffRow } from '../types/api'

interface Props {
  indizes: IndizesRow[]
  devisen: DevisenRow[]
  rohstoffe: RohstoffRow[]
}

export function IndizesTable({ indizes, devisen, rohstoffe }: Props) {
  return (
    <section id="indizes" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Indizes und Märkte</h2>
      <div className="bg-white ghost-border rounded-xl overflow-hidden mb-6">
        <table className="w-full text-sm">
          <thead>
            <tr className="border-b border-outline-variant/10 bg-surface-container-low">
              <th className="px-5 py-3 text-left text-xs font-bold text-secondary uppercase tracking-wider">Index</th>
              <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Aktuell</th>
              <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">Pkt</th>
              <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">%</th>
              <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">52W H</th>
              <th className="px-5 py-3 text-right text-xs font-bold text-secondary uppercase tracking-wider">52W T</th>
            </tr>
          </thead>
          <tbody>
            {indizes.map((row) => (
              <tr key={row.name} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                <td className="px-5 py-3 font-medium text-on-surface">{row.name}</td>
                <td className="px-5 py-3 text-right font-body">{row.aktuell}</td>
                <td className={`px-5 py-3 text-right font-body ${row.bullish ? 'text-primary' : 'text-error'}`}>{row.pkt}</td>
                <td className={`px-5 py-3 text-right font-bold ${row.bullish ? 'text-primary' : 'text-error'}`}>{row.pct}</td>
                <td className="px-5 py-3 text-right text-secondary text-xs">{row.high52}</td>
                <td className="px-5 py-3 text-right text-secondary text-xs">{row.low52}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <div id="devisen" className="grid lg:grid-cols-2 gap-6">
        {/* Devisen */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Devisen</h3>
          <table className="w-full text-sm">
            <tbody>
              {devisen.map((row) => (
                <tr key={row.pair} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <td className="px-5 py-3 font-medium text-on-surface">{row.pair}</td>
                  <td className="px-5 py-3 text-right font-body">{row.kurs}</td>
                  <td className={`px-5 py-3 text-right font-bold ${row.bullish ? 'text-primary' : 'text-error'}`}>{row.pct}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* Rohstoffe */}
        <div id="rohstoffe" className="bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Rohstoffe</h3>
          <table className="w-full text-sm">
            <tbody>
              {rohstoffe.map((row) => (
                <tr key={row.name} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <td className="px-5 py-3 font-medium text-on-surface">{row.name}</td>
                  <td className="px-5 py-3 text-right font-body">{row.kurs}</td>
                  <td className={`px-5 py-3 text-right font-bold ${row.bullish ? 'text-primary' : 'text-error'}`}>{row.pct}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  )
}
