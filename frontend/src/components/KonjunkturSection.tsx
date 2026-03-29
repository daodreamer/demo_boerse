import type { KonjunkturItem, AnlagestrategItem } from '../types/api'

interface Props {
  konjunktur: KonjunkturItem[]
  anlagestrategen: AnlagestrategItem[]
}

const badgeColors: Record<string, string> = {
  STRATEGIE: 'bg-primary/10 text-primary',
  ANALYSE:   'bg-secondary-container text-secondary',
  KOLUMNE:   'bg-surface-container-high text-on-surface-variant',
}

export function KonjunkturSection({ konjunktur, anlagestrategen }: Props) {
  return (
    <section className="mb-8">
      <div className="grid lg:grid-cols-2 gap-6">
        {/* Konjunktur */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h2 className="font-headline font-bold text-on-surface text-base px-5 py-4 border-b border-outline-variant/10">
            Konjunktur-Meldungen
          </h2>
          <div className="divide-y divide-outline-variant/10">
            {konjunktur.map((item, i) => (
              <div key={i} className="px-5 py-3 hover:bg-surface-container-low transition-colors cursor-pointer">
                <p className="text-[10px] text-secondary mb-1 uppercase tracking-wider">{item.datetime}</p>
                <p className="font-body text-sm text-on-surface">{item.title}</p>
              </div>
            ))}
          </div>
        </div>

        {/* Anlagestrategien */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <h2 className="font-headline font-bold text-on-surface text-base px-5 py-4 border-b border-outline-variant/10">
            Anlagestrategien
          </h2>
          <div className="divide-y divide-outline-variant/10">
            {anlagestrategen.map((item, i) => (
              <div key={i} className="px-5 py-4 hover:bg-surface-container-low transition-colors cursor-pointer flex gap-3 items-start">
                <span className={`text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider flex-shrink-0 mt-0.5 ${badgeColors[item.badge] ?? 'bg-surface-container text-secondary'}`}>
                  {item.badge}
                </span>
                <div>
                  <p className="font-headline font-semibold text-on-surface text-sm line-clamp-2">{item.title}</p>
                  <p className="text-xs text-secondary mt-1">{item.author}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
