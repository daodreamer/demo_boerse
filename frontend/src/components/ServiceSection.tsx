import type { ServiceData } from '../types/api'

interface Props {
  data: ServiceData
}

export function ServiceSection({ data }: Props) {
  return (
    <section id="service" className="mb-8">
      <h2 className="font-headline font-bold text-on-surface text-base mb-4">Service</h2>
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
        {data.items.map((item) => (
          <div key={item.name} className="bg-white ghost-border rounded-xl p-5 flex flex-col gap-3 cursor-pointer hover:shadow-md transition-shadow">
            <span className="text-2xl">{item.icon}</span>
            <div className="flex-1">
              <p className="font-headline font-bold text-on-surface text-sm mb-1">{item.name}</p>
              <p className="text-xs text-secondary">{item.description}</p>
            </div>
            <a href="#" className="text-xs font-semibold text-primary hover:underline">{item.cta} →</a>
          </div>
        ))}
      </div>
    </section>
  )
}
