import type { FondsStrip as FondsStripType } from '../types/api'

interface Props {
  data: FondsStripType
}

export function FondsStrip({ data }: Props) {
  return (
    <div className="bg-white ghost-border rounded-xl mb-6 overflow-x-auto">
      <div className="flex divide-x divide-outline-variant/10 min-w-max">
        {/* Fund columns */}
        {data.funds.map((fund) => (
          <div key={fund.name} className="px-5 py-3 cursor-pointer hover:bg-surface-container-low transition-colors flex-1 min-w-[180px]">
            <p className="font-headline font-bold text-on-surface text-xs mb-2 whitespace-nowrap">{fund.name}</p>
            <div className="flex gap-4">
              <div>
                <p className="text-[10px] text-secondary uppercase tracking-wider mb-0.5">thesaurierend</p>
                <p className="font-body text-sm font-semibold text-on-surface">{fund.thes.price}</p>
                <p className={`text-xs font-bold ${fund.thes.bullish ? 'text-primary' : 'text-error'}`}>{fund.thes.change}</p>
              </div>
              <div>
                <p className="text-[10px] text-secondary uppercase tracking-wider mb-0.5">ausschüttend</p>
                <p className="font-body text-sm font-semibold text-on-surface">{fund.aussh.price}</p>
                <p className={`text-xs font-bold ${fund.aussh.bullish ? 'text-primary' : 'text-error'}`}>{fund.aussh.change}</p>
              </div>
            </div>
          </div>
        ))}

        {/* Gold */}
        <div className="px-5 py-3 cursor-pointer hover:bg-surface-container-low transition-colors min-w-[130px]">
          <p className="font-headline font-bold text-on-surface text-xs mb-2">boerse.de-Gold</p>
          <p className="text-[10px] text-secondary uppercase tracking-wider mb-0.5">WKN: {data.gold.wkn}</p>
          <p className="font-body text-sm font-semibold text-on-surface">{data.gold.price}</p>
          <p className={`text-xs font-bold ${data.gold.bullish ? 'text-primary' : 'text-error'}`}>{data.gold.change}</p>
        </div>

        {/* BCDI */}
        <div className="px-5 py-3 cursor-pointer hover:bg-surface-container-low transition-colors min-w-[160px]">
          <p className="font-headline font-bold text-on-surface text-xs mb-2">BCDI</p>
          <div className="space-y-1">
            {data.bcdi.map((item) => (
              <div key={item.name} className="grid grid-cols-[1fr_auto_auto] gap-x-4 items-center">
                <span className="text-xs text-secondary whitespace-nowrap">{item.name}</span>
                <span className="font-body text-xs font-semibold text-on-surface text-right tabular-nums">{item.price}</span>
                <span className={`text-xs font-bold text-right tabular-nums w-14 ${item.bullish ? 'text-primary' : 'text-error'}`}>{item.change}</span>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  )
}
