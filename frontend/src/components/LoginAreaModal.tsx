import { useLoginModal } from '../hooks/useLoginModal'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogDescription,
} from '@/components/ui/dialog'
import { Badge } from '@/components/ui/badge'

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

  function handleSelect(id: string) {
    if (id === 'mein-boerse') { openMeinBoerse(); return }
    if (id === 'boersenverlag') { openBoersenverlag(); return }
    if (id === 'investoren-club') { openInvestorenClub(); return }
    if (id === 'mychampions') { window.open('https://app.mychampions.de/login', '_blank'); close(); return }
  }

  return (
    <Dialog open={view === 'area'} onOpenChange={(open) => !open && close()}>
      <DialogContent className="max-w-2xl">
        <DialogHeader className="text-center">
          <DialogTitle className="font-headline font-bold text-on-surface text-xl text-center">
            Login-Bereich wählen
          </DialogTitle>
          <DialogDescription className="text-sm text-secondary text-center">
            Bitte wählen Sie Ihren Bereich
          </DialogDescription>
        </DialogHeader>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
          {areas.map((area) => (
            <button
              key={area.id}
              onClick={() => handleSelect(area.id)}
              className="flex flex-col items-center gap-3 p-5 rounded-xl ghost-border hover:border-primary/30 hover:bg-surface-container-low hover:shadow-md transition-all group text-left"
            >
              <div className="size-12 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary/15 transition-colors">
                <span className="material-symbols-outlined text-primary">{area.icon}</span>
              </div>
              <div className="text-center">
                {area.badge && (
                  <Badge variant="secondary" className="text-[9px] mb-1 uppercase tracking-wider">
                    {area.badge}
                  </Badge>
                )}
                <p className="font-headline font-bold text-on-surface text-sm">{area.title}</p>
                <p className="text-xs text-secondary mt-1 leading-snug">{area.tagline}</p>
              </div>
            </button>
          ))}
        </div>
      </DialogContent>
    </Dialog>
  )
}
