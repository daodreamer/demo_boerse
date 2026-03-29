import { useState, useMemo } from 'react'
import type { Tagestrends as TagesData, TagesPanel } from '../types/api'

interface Props {
  data: TagesData
}

function parseNum(s: string): number {
  return parseFloat(s.replace(/\./g, '').replace(',', '.'))
}

function fmtDe(n: number): string {
  return n.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}

function closePath(line: string): string {
  return line + ' L600,80 L0,80 Z'
}

export function Tagestrends({ data }: Props) {
  const firstId = data.tab_rows[0]?.[0]?.id ?? 'dax'
  const [activeId, setActiveId] = useState(firstId)

  const panel: TagesPanel | undefined = data.panels[activeId]

  const { hi, lo, mid } = useMemo(() => {
    if (!panel) return { hi: 0, lo: 0, mid: '0' }
    const hi = parseNum(panel.high)
    const lo = parseNum(panel.low)
    const mid = ((hi + lo) / 2).toFixed(2).replace('.', ',')
    return { hi, lo, mid }
  }, [panel])

  if (!panel) return null

  const color = panel.bullish ? '#002655' : '#ba1a1a'
  const fillId = panel.bullish ? 'trendFill' : 'trendFillBear'

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
            <div className="flex gap-4">
              {/* Y-axis labels */}
              <div className="flex flex-col justify-between text-right text-[10px] text-secondary font-body py-1" style={{ minWidth: 60 }}>
                <span>{fmtDe(hi)}</span>
                <span>{mid}</span>
                <span>{fmtDe(lo)}</span>
              </div>
              {/* SVG */}
              <div className="flex-1">
                <svg viewBox="0 0 600 80" className="w-full" style={{ height: 120 }} preserveAspectRatio="none">
                  <defs>
                    <linearGradient id="trendFill" x1="0" y1="0" x2="0" y2="1">
                      <stop offset="0%" stopColor="#002655" stopOpacity="0.18" />
                      <stop offset="100%" stopColor="#002655" stopOpacity="0" />
                    </linearGradient>
                    <linearGradient id="trendFillBear" x1="0" y1="0" x2="0" y2="1">
                      <stop offset="0%" stopColor="#ba1a1a" stopOpacity="0.18" />
                      <stop offset="100%" stopColor="#ba1a1a" stopOpacity="0" />
                    </linearGradient>
                  </defs>
                  <path d={closePath(panel.line)} fill={`url(#${fillId})`} />
                  <path d={panel.line} fill="none" stroke={color} strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                </svg>
              </div>
            </div>
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
