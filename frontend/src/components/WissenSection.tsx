import type { WissenData } from '../types/api'

interface Props {
  data: WissenData
}

export function WissenSection({ data }: Props) {
  return (
    <section id="wissen" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Wissen</h2>
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-4">
        {data.categories.map((cat) => (
          <div key={cat.title} className="bg-white ghost-border rounded-xl p-5">
            <div className="flex items-center gap-3 mb-4">
              <span className="text-2xl">{cat.icon}</span>
              <h3 className="font-headline font-bold text-on-surface text-sm">{cat.title}</h3>
            </div>
            <ul className="space-y-2">
              {cat.articles.map((article, i) => (
                <li key={i} className="flex items-start gap-2 cursor-pointer hover:text-primary transition-colors">
                  <span className="text-primary mt-0.5 text-xs flex-shrink-0">›</span>
                  <span className="text-xs text-on-surface hover:text-primary">{article}</span>
                </li>
              ))}
            </ul>
          </div>
        ))}
      </div>
    </section>
  )
}
