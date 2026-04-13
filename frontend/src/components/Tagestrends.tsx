import { useState } from 'react'
import {
  AreaChart,
  Area,
  XAxis,
  YAxis,
  CartesianGrid,
} from 'recharts'
import {
  ChartContainer,
  ChartTooltip,
  ChartTooltipContent,
} from '@/components/ui/chart'
import type { Tagestrends as TagesData, TagesPanel } from '../types/api'

interface Props {
  data: TagesData
}

function parseNum(s: string): number {
  return parseFloat(s.replace(/\./g, '').replace(',', '.'))
}

export function Tagestrends({ data }: Props) {
  const firstId = data.tab_rows[0]?.[0]?.id ?? 'dax'
  const [activeId, setActiveId] = useState(firstId)

  const panel: TagesPanel | undefined = data.panels[activeId]

  const activeLabel = (() => {
    for (const row of data.tab_rows) {
      const tab = row.find((t) => t.id === activeId)
      if (tab) return tab.label
    }
    return activeId
  })()

  if (!panel) return null

  const color = panel.bullish ? '#002655' : '#ba1a1a'
  const hiNum = parseNum(panel.high)
  const loNum = parseNum(panel.low)
  const domain: [number, number] = [loNum * 0.999, hiNum * 1.001]

  return (
    <section id="aktien" className="mb-8">
      <div className="bg-white ghost-border rounded-xl overflow-hidden">
        {/* Header */}
        <div className="flex items-center justify-between px-6 pt-5 pb-3 border-b border-outline-variant/10">
          <div>
            <h2 className="font-headline font-bold text-on-surface text-base">Tagestrends</h2>
            <p className="text-xs text-secondary">{data.date}</p>
          </div>
          <span className="flex items-center gap-1.5 text-xs font-bold text-error bg-error-container px-2.5 py-1 rounded-full">
            <span className="w-1.5 h-1.5 bg-error rounded-full animate-pulse inline-block" />
            LIVE
          </span>
        </div>

        {/* Tabs */}
        <div className="px-4 pt-3 pb-0 space-y-2 border-b border-outline-variant/10">
          {data.tab_rows.map((row, ri) => (
            <div key={ri} className="flex gap-1.5 w-full justify-between">
              {row.map((tab) => {
                const isActive = tab.id === activeId
                return (
                  <button
                    key={tab.id}
                    onClick={() => setActiveId(tab.id)}
                    className={`flex-1 text-xs px-3 py-1 rounded-full font-body font-medium transition-colors ${
                      isActive
                        ? 'bg-primary text-on-primary'
                        : 'text-secondary hover:text-primary hover:bg-surface-container-low'
                    }`}
                  >
                    {tab.label}
                  </button>
                )
              })}
            </div>
          ))}
        </div>

        {/* Chart + Table */}
        <div className="grid lg:grid-cols-2 gap-0">
          {/* Chart */}
          <div className="p-4 border-r border-outline-variant/10">
            <div className="flex items-center justify-between mb-2">
              <p className="font-body text-xs text-secondary uppercase tracking-wider">{activeLabel}</p>
              <div className="flex items-center gap-3 text-xs font-body text-secondary">
                <span>H: <strong className="text-on-surface">{panel.high}</strong></span>
                <span>L: <strong className="text-on-surface">{panel.low}</strong></span>
              </div>
            </div>
            <ChartContainer
              config={{ value: { label: activeLabel, color } }}
              className="h-[140px] w-full"
            >
              <AreaChart data={panel.line} margin={{ top: 4, right: 4, bottom: 0, left: 0 }}>
                <defs>
                  <linearGradient id={`grad-${activeId}`} x1="0" y1="0" x2="0" y2="1">
                    <stop offset="5%" stopColor={color} stopOpacity={0.15} />
                    <stop offset="95%" stopColor={color} stopOpacity={0} />
                  </linearGradient>
                </defs>
                <CartesianGrid vertical={false} strokeDasharray="3 3" stroke="#c3c6d215" />
                <XAxis
                  dataKey="time"
                  tick={{ fontSize: 10, fill: '#515f74' }}
                  tickLine={false}
                  axisLine={false}
                  interval="preserveStartEnd"
                />
                <YAxis
                  domain={domain}
                  tick={{ fontSize: 10, fill: '#515f74' }}
                  tickLine={false}
                  axisLine={false}
                  width={62}
                  tickFormatter={(v: number) =>
                    v.toLocaleString('de-DE', { minimumFractionDigits: 0, maximumFractionDigits: 0 })
                  }
                />
                <ChartTooltip
                  cursor={{ stroke: color, strokeWidth: 1, strokeDasharray: '4 4' }}
                  content={
                    <ChartTooltipContent
                      formatter={(v) =>
                        (v as number).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                      }
                    />
                  }
                />
                <Area
                  type="monotone"
                  dataKey="value"
                  stroke={color}
                  strokeWidth={2}
                  fill={`url(#grad-${activeId})`}
                  dot={false}
                  activeDot={{ r: 4, fill: color, strokeWidth: 0 }}
                />
              </AreaChart>
            </ChartContainer>
          </div>

          {/* Stocks table */}
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="border-b border-outline-variant/10">
                  <th className="px-4 py-2.5 text-left text-xs font-bold text-secondary uppercase tracking-wider">Titel</th>
                  <th className="px-4 py-2.5 text-right text-xs font-bold text-secondary uppercase tracking-wider">Kurs</th>
                  <th className="px-4 py-2.5 text-right text-xs font-bold text-secondary uppercase tracking-wider">+/−</th>
                </tr>
              </thead>
              <tbody>
                {panel.stocks.map((s, i) => (
                  <tr key={i} className="hover:bg-surface-container-low transition-colors cursor-pointer border-t border-outline-variant/10">
                    <td className="px-4 py-2.5 font-medium text-primary flex items-center gap-1">
                      {s.bullish ? (
                        <svg className="inline w-3 h-3 mb-0.5" viewBox="0 0 24 24" fill="none" stroke="#002655" strokeWidth="3">
                          <path d="M12 19V5M5 12l7-7 7 7" />
                        </svg>
                      ) : (
                        <svg className="inline w-3 h-3 mb-0.5" viewBox="0 0 24 24" fill="none" stroke="#ba1a1a" strokeWidth="3">
                          <path d="M12 5v14M19 12l-7 7-7-7" />
                        </svg>
                      )}
                      <span>{s.name}</span>
                    </td>
                    <td className="px-4 py-2.5 text-right font-body">{s.price}</td>
                    <td className={`px-4 py-2.5 text-right font-bold ${s.bullish ? 'text-primary' : 'text-error'}`}>{s.change}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  )
}
