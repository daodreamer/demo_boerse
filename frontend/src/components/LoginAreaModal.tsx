import { useLoginModal } from '../hooks/useLoginModal'

const areas = [
  {
    id: 'mein-boerse',
    icon: 'person',
    title: 'mein.boerse.de',
    tagline: 'Ihr persönliches Finanzportal',
    badge: null,
  },
  {
    id: 'boersenverlag',
    icon: 'menu_book',
    title: 'Börsenverlag',
    tagline: 'Ihr Abobereich',
    badge: 'Seit 1987',
  },
  {
    id: 'investoren-club',
    icon: 'groups',
    title: 'Investoren-Club',
    tagline: 'Ihr Investorenbereich',
    badge: null,
  },
  {
    id: 'mychampions',
    icon: 'emoji_events',
    title: 'myChampions100',
    tagline: 'Der geniale Direktanlageservice',
    badge: null,
  },
]

export function LoginAreaModal() {
  const { view, openMeinBoerse, openBoersenverlag, openInvestorenClub, close } = useLoginModal()

  if (view !== 'area') return null

  function handleSelect(id: string) {
    if (id === 'mein-boerse') { openMeinBoerse(); return }
    if (id === 'boersenverlag') { openBoersenverlag(); return }
    if (id === 'investoren-club') { openInvestorenClub(); return }
    if (id === 'mychampions') { window.open('https://app.mychampions.de/login', '_blank'); close(); return }
  }

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4" onClick={close}>
      <div className="absolute inset-0 bg-black/40 backdrop-blur-sm" />

      <div
        className="relative bg-white dark:bg-[#001a3a] rounded-2xl shadow-2xl w-full max-w-2xl p-8"
        onClick={(e) => e.stopPropagation()}
      >
        <button
          onClick={close}
          className="absolute top-4 right-4 p-1.5 rounded-full hover:bg-surface-container transition-colors text-outline"
        >
          <span className="material-symbols-outlined">close</span>
        </button>

        <h2 className="font-headline font-bold text-on-surface text-xl text-center mb-2">
          Login-Bereich wählen
        </h2>
        <p className="text-sm text-secondary text-center mb-8">
          Bitte wählen Sie Ihren Bereich
        </p>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          {areas.map((area) => (
            <button
              key={area.id}
              onClick={() => handleSelect(area.id)}
              className="flex flex-col items-center gap-3 p-5 rounded-xl ghost-border hover:border-primary/30 hover:bg-surface-container-low hover:shadow-md transition-all group text-left"
            >
              <div className="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary/15 transition-colors">
                <span className="material-symbols-outlined text-primary">{area.icon}</span>
              </div>
              <div className="text-center">
                {area.badge && (
                  <span className="text-[9px] font-bold bg-secondary-container text-secondary px-1.5 py-0.5 rounded-full uppercase tracking-wider block mb-1">
                    {area.badge}
                  </span>
                )}
                <p className="font-headline font-bold text-on-surface text-sm">{area.title}</p>
                <p className="text-xs text-secondary mt-1 leading-snug">{area.tagline}</p>
              </div>
            </button>
          ))}
        </div>
      </div>
    </div>
  )
}
