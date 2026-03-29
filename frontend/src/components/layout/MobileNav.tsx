import { useState } from 'react'
import { navItems, kostenlosLinks, boerseInhalteLinks } from '../../data/navItems'
import { useActiveSection } from '../../hooks/useActiveSection'

interface Props {
  open: boolean
  onClose: () => void
}

function CollapsibleGroup({ title, icon, links }: {
  title: string
  icon: string
  links: { label: string; href: string; neu?: boolean }[]
}) {
  const [expanded, setExpanded] = useState(false)

  return (
    <div>
      <button
        onClick={() => setExpanded((v) => !v)}
        className="w-full flex items-center gap-3 px-5 py-3 text-slate-500 hover:text-primary transition-colors"
      >
        <span className="material-symbols-outlined">{icon}</span>
        <span className="font-body text-sm font-medium flex-1 text-left">{title}</span>
        <span className={`material-symbols-outlined text-base transition-transform ${expanded ? 'rotate-180' : ''}`}>
          expand_more
        </span>
      </button>
      {expanded && (
        <div className="pl-12 pb-2 space-y-1">
          {links.map((link) => (
            <a
              key={link.label}
              href={link.href}
              className="flex items-center gap-2 py-2 text-sm text-on-surface hover:text-primary transition-colors"
            >
              <span>{link.label}</span>
              {link.neu && (
                <span className="text-[9px] font-bold bg-error text-white px-1.5 py-0.5 rounded-full uppercase">
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

export function MobileNav({ open, onClose }: Props) {
  const { activeHref, handleNavClick } = useActiveSection()

  function onItemClick(e: React.MouseEvent<HTMLAnchorElement>, href: string) {
    handleNavClick(e, href)
    onClose()
  }

  return (
    <>
      {/* Backdrop */}
      <div
        className={`fixed inset-0 bg-black/40 backdrop-blur-sm z-[70] transition-opacity ${
          open ? 'opacity-100' : 'opacity-0 pointer-events-none'
        }`}
        onClick={onClose}
      />

      {/* Drawer */}
      <div
        className={`fixed top-0 left-0 h-full w-72 bg-white dark:bg-[#001a3a] z-[80] shadow-2xl transition-transform ${
          open ? 'translate-x-0' : '-translate-x-full'
        }`}
      >
        {/* Header */}
        <div className="flex items-center justify-between px-5 py-4 border-b border-outline-variant/15">
          <h2 className="font-headline font-bold text-primary text-lg">Menü</h2>
          <button onClick={onClose} className="p-1 rounded-lg hover:bg-surface-container transition-colors">
            <span className="material-symbols-outlined text-outline">close</span>
          </button>
        </div>

        {/* Scrollable content */}
        <div className="overflow-y-auto" style={{ height: 'calc(100% - 3.5rem)' }}>
          <CollapsibleGroup title="Kostenlos" icon="card_giftcard" links={kostenlosLinks} />
          <CollapsibleGroup title="boerse.de Inhalte" icon="star" links={boerseInhalteLinks} />

          <div className="border-t border-outline-variant/15 mt-1 pt-1">
            {navItems.map((item) => (
              <a
                key={item.label}
                href={item.href}
                onClick={(e) => onItemClick(e, item.href)}
                className={`flex items-center gap-3 px-5 py-3 transition-colors ${
                  activeHref === item.href
                    ? 'text-primary font-bold bg-surface-container-low'
                    : 'text-slate-500 hover:text-primary hover:bg-surface-container-low'
                }`}
              >
                <span className="material-symbols-outlined">{item.icon}</span>
                <span className="font-body text-sm font-medium">{item.label}</span>
              </a>
            ))}
          </div>
        </div>
      </div>
    </>
  )
}
