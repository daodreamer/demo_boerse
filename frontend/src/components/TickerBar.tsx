import type { TickerItem } from '../types/api'

interface Props {
  items: TickerItem[]
}

export function TickerBar({ items }: Props) {
  const doubled = [...items, ...items]
  return (
    <div className="bg-primary text-on-primary overflow-hidden" style={{ height: '2.25rem' }}>
      <div className="flex items-center h-full ticker-scroll" style={{ width: 'max-content' }}>
        {doubled.map((item, i) => (
          <span key={i} className="flex items-center gap-1.5 px-5 text-xs font-body whitespace-nowrap">
            <span className="font-semibold opacity-90">{item.name}</span>
            <span>{item.price}</span>
            <span className={item.bullish ? 'text-blue-200' : 'text-red-300'}>{item.change}</span>
            <span className="opacity-30 ml-3">·</span>
          </span>
        ))}
      </div>
    </div>
  )
}
