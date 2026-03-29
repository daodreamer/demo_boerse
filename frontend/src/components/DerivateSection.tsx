import type { DerivateData } from '../types/api'

interface Props {
  data: DerivateData
}

export function DerivateSection({ data }: Props) {
  return (
    <section id="derivate" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Derivate</h2>
      <div className="grid lg:grid-cols-3 gap-4 mb-6">
        {data.categories.map((cat) => (
          <div key={cat.name} className="bg-white ghost-border rounded-xl p-5 cursor-pointer hover:shadow-md transition-shadow">
            <div className="text-2xl mb-2">{cat.icon}</div>
            <p className="font-headline font-bold text-on-surface text-sm mb-1">{cat.name}</p>
            <p className="text-xs text-secondary mb-3">{cat.description}</p>
            <p className="text-xs text-secondary">{cat.count.toLocaleString()} Produkte</p>
          </div>
        ))}
      </div>

      <div className="bg-white ghost-border rounded-xl overflow-hidden">
        <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Meistgehandelte Derivate</h3>
        <table className="w-full text-sm">
          <thead>
            <tr className="bg-surface-container-low border-b border-outline-variant/10">
              <th className="px-5 py-2 text-left text-xs font-bold text-secondary uppercase tracking-wider">Produkt</th>
              <th className="px-5 py-2 text-left text-xs font-bold text-secondary uppercase tracking-wider">Emittent</th>
              <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Bid</th>
              <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">Ask</th>
              <th className="px-5 py-2 text-right text-xs font-bold text-secondary uppercase tracking-wider">+/-</th>
            </tr>
          </thead>
          <tbody>
            {data.popular.map((item) => (
              <tr key={item.name} className="border-t border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                <td className="px-5 py-3 font-medium text-on-surface">{item.name}</td>
                <td className="px-5 py-3 text-secondary text-xs">{item.issuer}</td>
                <td className="px-5 py-3 text-right font-body">{item.bid}</td>
                <td className="px-5 py-3 text-right font-body">{item.ask}</td>
                <td className={`px-5 py-3 text-right font-bold ${item.bullish ? 'text-primary' : 'text-error'}`}>{item.change}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </section>
  )
}
