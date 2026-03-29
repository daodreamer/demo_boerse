import type { MarketIndex } from '../types/api'

interface Props {
  indices: MarketIndex[]
}

export function MarketCards({ indices }: Props) {
  return (
    <div className="grid grid-cols-3 gap-3 mb-6">
      {indices.map((idx) => (
        <div key={idx.name} className="bg-white ghost-border rounded-xl p-4 cursor-pointer hover:shadow-md transition-shadow">
          <div className="flex items-start justify-between mb-3">
            <div>
              <p className="font-body text-xs text-secondary uppercase tracking-wider">{idx.name}</p>
              <p className="font-headline font-bold text-on-surface text-lg">{idx.price}</p>
            </div>
            <span className={`text-sm font-bold ${idx.bullish ? 'text-primary' : 'text-error'}`}>{idx.change}</span>
          </div>
          <svg viewBox="0 0 100 30" className="w-full h-8" preserveAspectRatio="none">
            <polyline
              points={svgPathToPoints(idx.sparkline)}
              fill="none"
              stroke={idx.bullish ? '#002655' : '#ba1a1a'}
              strokeWidth="1.5"
              strokeLinecap="round"
              strokeLinejoin="round"
            />
          </svg>
        </div>
      ))}
    </div>
  )
}

function svgPathToPoints(path: string): string {
  return path
    .replace(/M|L/g, '')
    .trim()
    .split(/\s+/)
    .map((token) => token.trim())
    .join(' ')
}
