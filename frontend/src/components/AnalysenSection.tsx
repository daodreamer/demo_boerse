import type { Analyses } from '../types/api'

interface Props {
  data: Analyses
}

export function AnalysenSection({ data }: Props) {
  return (
    <section id="analysen" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Analysen</h2>
      <div className="grid lg:grid-cols-3 gap-6">
        {/* Featured */}
        <div className="lg:col-span-1 bg-white ghost-border rounded-xl overflow-hidden cursor-pointer hover:shadow-md transition-shadow">
          <div className="h-40 bg-surface-container-low flex items-center justify-center">
            <span className="text-4xl">📊</span>
          </div>
          <div className="p-5">
            <p className="font-headline font-bold text-on-surface text-sm line-clamp-2">{data.featured.title}</p>
            <p className="text-xs text-secondary mt-2 line-clamp-3">{data.featured.excerpt}</p>
          </div>
        </div>

        {/* List */}
        <div className="lg:col-span-2 bg-white ghost-border rounded-xl overflow-hidden">
          <h3 className="font-headline font-bold text-on-surface text-sm px-5 py-4 border-b border-outline-variant/10">Aktuelle Analysen</h3>
          <div className="divide-y divide-outline-variant/10">
            {data.list.map((item, i) => (
              <div key={i} className="px-5 py-3 hover:bg-surface-container-low transition-colors cursor-pointer">
                <p className="text-[10px] text-secondary mb-1 uppercase tracking-wider">{item.time}</p>
                <p className="font-body text-sm text-on-surface">{item.title}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  )
}
