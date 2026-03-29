import type { TopsFlops as TopsFlopsData, MostSearchedItem } from '../types/api'

interface Props {
  data: TopsFlopsData
  mostSearched: MostSearchedItem[]
}

function Sparkline({ path, bullish }: { path: string | null; bullish: boolean }) {
  if (!path) return <span className="text-secondary text-xs">–</span>
  return (
    <svg viewBox="0 0 100 30" className="w-16 h-6" preserveAspectRatio="none">
      <polyline
        points={path.replace(/[ML]/g, '').trim()}
        fill="none"
        stroke={bullish ? '#002655' : '#ba1a1a'}
        strokeWidth="2"
        strokeLinecap="round"
        strokeLinejoin="round"
      />
    </svg>
  )
}

export function TopsFlops({ data, mostSearched }: Props) {
  return (
    <section className="mb-8">
      <div className="grid lg:grid-cols-3 gap-6">
        {/* Tops & Flops */}
        <div className="lg:col-span-2 bg-white ghost-border rounded-xl overflow-hidden">
          <div className="flex items-center justify-between px-5 py-4 border-b border-outline-variant/10">
            <h2 className="font-headline font-bold text-on-surface text-base">Aktien Tops &amp; Flops</h2>
          </div>
          <div className="grid grid-cols-2 divide-x divide-outline-variant/10">
            {/* Tops */}
            <div>
              <p className="px-5 py-3 text-xs font-bold text-primary uppercase tracking-wider border-b border-outline-variant/10 bg-surface-container-low">
                ↑ Tops
              </p>
              {data.tops.map((item) => (
                <div key={item.name} className="flex items-center justify-between px-5 py-3 border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <span className="font-body text-sm font-medium text-on-surface">{item.name}</span>
                  <div className="flex items-center gap-3">
                    <Sparkline path={item.sparkline} bullish />
                    <span className="text-sm font-bold text-primary w-16 text-right">{item.change}</span>
                  </div>
                </div>
              ))}
            </div>
            {/* Flops */}
            <div>
              <p className="px-5 py-3 text-xs font-bold text-error uppercase tracking-wider border-b border-outline-variant/10 bg-surface-container-low">
                ↓ Flops
              </p>
              {data.flops.map((item) => (
                <div key={item.name} className="flex items-center justify-between px-5 py-3 border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
                  <span className="font-body text-sm font-medium text-on-surface">{item.name}</span>
                  <div className="flex items-center gap-3">
                    <Sparkline path={item.sparkline} bullish={false} />
                    <span className="text-sm font-bold text-error w-16 text-right">{item.change}</span>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* Most Searched */}
        <div className="bg-white ghost-border rounded-xl overflow-hidden">
          <div className="px-5 py-4 border-b border-outline-variant/10">
            <h2 className="font-headline font-bold text-on-surface text-base">Meistgesucht</h2>
          </div>
          {mostSearched.map((item, i) => (
            <div key={item.name} className="flex items-center gap-4 px-5 py-3 border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors cursor-pointer">
              <span className="w-5 h-5 rounded-full bg-surface-container flex items-center justify-center text-[10px] font-bold text-secondary">
                {i + 1}
              </span>
              <span className="font-body text-sm font-medium text-on-surface flex-1">{item.name}</span>
              <span className="text-xs text-secondary">{item.count}</span>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
