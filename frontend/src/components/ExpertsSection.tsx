import type { Expert } from '../types/api'

interface Props {
  experts: Expert[]
}

export function ExpertsSection({ experts }: Props) {
  return (
    <section id="experten" className="mb-8">
      <div className="flex items-center justify-between mb-4">
        <h2 className="font-headline font-bold text-on-surface text-base">Expertenmeinungen</h2>
        <a href="#" className="text-xs text-primary font-medium hover:underline">
          Alle Meinungen <span className="material-symbols-outlined text-sm align-middle">chevron_right</span>
        </a>
      </div>
      <div className="grid lg:grid-cols-3 gap-4">
        {experts.map((expert) => (
          <div key={expert.name} className="bg-white ghost-border rounded-xl p-5 cursor-pointer hover:shadow-md transition-shadow flex flex-col gap-3">
            <div className="flex items-center gap-3">
              <img src={expert.image} alt={expert.name} className="w-12 h-12 rounded-full object-cover" />
              <div>
                <p className="font-headline font-bold text-on-surface text-sm">{expert.name}</p>
                <p className="text-xs text-secondary">{expert.role}</p>
              </div>
            </div>
            <p className="font-headline font-semibold text-on-surface text-sm line-clamp-2">{expert.title}</p>
            <p className="font-body text-secondary text-xs italic line-clamp-3">{expert.quote}</p>
            <p className="text-[10px] text-secondary uppercase tracking-wider">{expert.timestamp}</p>
          </div>
        ))}
      </div>
    </section>
  )
}
