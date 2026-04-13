import type React from 'react'
import { navItems, kostenlosLinks, boerseInhalteLinks } from '../../data/navItems'
import { useActiveSection } from '../../hooks/useActiveSection'
import {
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
} from '@/components/ui/sheet'
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'
import { Badge } from '@/components/ui/badge'

interface Props {
  open: boolean
  onClose: () => void
}

function CollapsibleGroup({ title, icon, links }: {
  title: string
  icon: string
  links: { label: string; href: string; neu?: boolean }[]
}) {
  return (
    <Collapsible>
      <CollapsibleTrigger className="w-full flex items-center gap-3 px-5 py-3 text-slate-500 hover:text-primary transition-colors group">
        <span className="material-symbols-outlined">{icon}</span>
        <span className="font-body text-sm font-medium flex-1 text-left">{title}</span>
        <span className="material-symbols-outlined text-base transition-transform group-data-[state=open]:rotate-180">
          expand_more
        </span>
      </CollapsibleTrigger>
      <CollapsibleContent>
        <div className="pl-12 pb-2 flex flex-col gap-1">
          {links.map((link) => (
            <a
              key={link.label}
              href={link.href}
              className="flex items-center gap-2 py-2 text-sm text-on-surface hover:text-primary transition-colors"
            >
              <span>{link.label}</span>
              {link.neu && (
                <Badge variant="destructive" className="text-[9px] px-1.5 py-0.5 rounded-full uppercase">
                  NEU
                </Badge>
              )}
            </a>
          ))}
        </div>
      </CollapsibleContent>
    </Collapsible>
  )
}

export function MobileNav({ open, onClose }: Props) {
  const { activeHref, handleNavClick } = useActiveSection()

  function onItemClick(e: React.MouseEvent<HTMLAnchorElement>, href: string) {
    handleNavClick(e, href)
    onClose()
  }

  return (
    <Sheet open={open} onOpenChange={(o) => !o && onClose()}>
      <SheetContent side="left" className="w-72 p-0 bg-white dark:bg-[#001a3a]">
        <SheetHeader className="px-5 py-4 border-b border-outline-variant/15">
          <SheetTitle className="font-headline font-bold text-primary text-lg text-left">
            Menü
          </SheetTitle>
        </SheetHeader>

        <div className="overflow-y-auto h-full pb-10">
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
      </SheetContent>
    </Sheet>
  )
}
