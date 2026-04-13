import type { MarketIndex } from '../types/api'
import {
  Card,
  CardContent,
  CardHeader,
} from '@/components/ui/card'

interface Props {
  indices: MarketIndex[]
}

function CardSparkline({ data, bullish }: { data: number[]; bullish: boolean }) {
  const W = 120, H = 32
  const color = bullish ? '#002655' : '#ba1a1a'
  if (data.length < 2) return <div className="h-8" />
  const min = Math.min(...data)
  const max = Math.max(...data)
  const range = max - min || 1
  const pts = data
    .map((v, i) =>
      `${((i / (data.length - 1)) * W).toFixed(1)},${(H - ((v - min) / range) * (H - 2)).toFixed(1)}`
    )
    .join(' ')
  return (
    <svg width="100%" height={H} viewBox={`0 0 ${W} ${H}`} preserveAspectRatio="none">
      <polygon points={`0,${H} ${pts} ${W},${H}`} fill={color} fillOpacity={0.08} />
      <polyline
        points={pts}
        fill="none"
        stroke={color}
        strokeWidth="1.5"
        strokeLinecap="round"
        strokeLinejoin="round"
      />
    </svg>
  )
}

export function MarketCards({ indices }: Props) {
  return (
    <div className="grid grid-cols-3 gap-3 mb-6">
      {indices.map((idx) => (
        <Card key={idx.name} className="ghost-border bg-white cursor-pointer hover:shadow-md transition-shadow">
          <CardHeader className="pb-2 pt-4 px-4">
            <div className="flex items-start justify-between">
              <div>
                <p className="font-body text-xs text-secondary uppercase tracking-wider">{idx.name}</p>
                <p className="font-headline font-bold text-on-surface text-lg">{idx.price}</p>
              </div>
              <span className={`text-sm font-bold ${idx.bullish ? 'text-primary' : 'text-error'}`}>
                {idx.change}
              </span>
            </div>
          </CardHeader>
          <CardContent className="px-4 pb-4 pt-0">
            <CardSparkline data={idx.sparkline} bullish={idx.bullish} />
          </CardContent>
        </Card>
      ))}
    </div>
  )
}
