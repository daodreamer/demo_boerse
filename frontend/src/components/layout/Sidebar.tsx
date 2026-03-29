import { useState, useRef } from 'react'
import { navItems, kostenlosLinks, boerseInhalteLinks } from '../../data/navItems'
import { useActiveSection } from '../../hooks/useActiveSection'

interface FlyoutButtonProps {
  icon: string
  label: string
  title: string
  links: { label: string; href: string; neu?: boolean }[]
}

function FlyoutButton({ icon, label, title, links }: FlyoutButtonProps) {
  const [open, setOpen] = useState(false)
  const timer = useRef<ReturnType<typeof setTimeout> | null>(null)

  function show() {
    if (timer.current) clearTimeout(timer.current)
    setOpen(true)
  }

  function hide() {
    timer.current = setTimeout(() => setOpen(false), 150)
  }

  return (
    <div className="relative px-4" onMouseEnter={show} onMouseLeave={hide}>
      <button
        onClick={() => setOpen((v) => !v)}
        className="w-full flex items-center gap-3 px-0 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-white transition-colors"
      >
        <span className="material-symbols-outlined">{icon}</span>
        <span className="font-body text-sm font-medium flex-1 text-left">{label}</span>
        <span className={`material-symbols-outlined text-base transition-transform ${open ? 'rotate-90' : ''}`}>
          chevron_right
        </span>
      </button>

      {open && (
        <div
          className="absolute left-full top-0 ml-2 w-68 bg-white dark:bg-[#001a3a] rounded-xl shadow-lg border border-outline-variant/15 py-2 z-50"
          onMouseEnter={show}
          onMouseLeave={hide}
        >
          <p className="px-4 py-2 text-[10px] font-bold text-secondary uppercase tracking-wider">{title}</p>
          {links.map((link) => (
            <a
              key={link.label}
              href={link.href}
              className="flex items-center gap-2 px-4 py-2.5 text-sm text-on-surface hover:bg-surface-container-low hover:text-primary dark:hover:bg-white/5 transition-colors"
            >
              <span className="material-symbols-outlined text-base text-primary flex-shrink-0">arrow_forward</span>
              <span>{link.label}</span>
              {link.neu && (
                <span className="ml-auto text-[9px] font-bold bg-error text-white px-1.5 py-0.5 rounded-full uppercase">
                  NEU
                </span>
              )}
            </a>
          ))}
        </div>
      )}
    </div>
  )
}

export function Sidebar() {
  const { activeHref, handleNavClick } = useActiveSection()

  return (
    <aside
      className="hidden lg:flex flex-col py-6 px-4 space-y-2 fixed left-0 w-64 bg-surface dark:bg-[#001a3a] text-primary dark:text-blue-300 border-r border-outline-variant/15 z-40"
      style={{ top: '6rem', height: 'calc(100vh - 6rem)' }}
    >
      <div className="px-4 mb-4">
        <h3 className="font-headline font-bold text-lg text-primary">Marktdaten</h3>
        <p className="text-xs text-secondary">Echtzeit-Kurse &amp; Analysen</p>
      </div>

      <FlyoutButton
        icon="card_giftcard"
        label="Kostenlos"
        title="Kostenlose Angebote"
        links={kostenlosLinks}
      />
      <FlyoutButton
        icon="star"
        label="boerse.de Inhalte"
        title="boerse.de Inhalte"
        links={boerseInhalteLinks}
      />

      <nav className="flex-1 space-y-1 overflow-y-auto mt-2">
        {navItems.map((item) => {
          const isActive = activeHref === item.href
          return (
            <a
              key={item.label}
              href={item.href}
              onClick={(e) => handleNavClick(e, item.href)}
              className={`flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all ${
                isActive
                  ? 'bg-white text-primary font-bold shadow-sm'
                  : 'text-slate-500 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-white/5 hover:translate-x-1'
              }`}
            >
              <span className="material-symbols-outlined">{item.icon}</span>
              <span className="font-body text-sm font-medium">{item.label}</span>
            </a>
          )
        })}
      </nav>
    </aside>
  )
}
