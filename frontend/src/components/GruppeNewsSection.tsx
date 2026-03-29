import type { GruppeNewsItem } from '../types/api'

interface Props {
  items: GruppeNewsItem[]
}

export function GruppeNewsSection({ items }: Props) {
  return (
    <section className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Neues aus der boerse.de-Gruppe</h2>
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
        {items.map((item) => (
          <div key={item.label} className="bg-white ghost-border rounded-xl p-5 flex flex-col gap-3 cursor-pointer hover:shadow-md transition-shadow">
            <p className="font-headline font-bold text-primary text-sm">{item.label}</p>
            <p className="font-body text-secondary text-xs flex-1">{item.title}</p>
            <a href="#" className="text-xs font-semibold text-primary hover:underline">{item.link}</a>
          </div>
        ))}
      </div>
    </section>
  )
}
