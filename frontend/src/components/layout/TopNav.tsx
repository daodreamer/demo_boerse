import { useState } from 'react'
import { useDarkMode } from '../../hooks/useDarkMode'
import { useActiveSection } from '../../hooks/useActiveSection'
import { useLoginModal } from '../../hooks/useLoginModal'
import { navItems } from '../../data/navItems'
import { MobileNav } from './MobileNav'

export function TopNav() {
  const [dark, toggleDark] = useDarkMode()
  const { activeHref, handleNavClick } = useActiveSection()
  const { openArea } = useLoginModal()
  const [mobileOpen, setMobileOpen] = useState(false)

  return (
    <>
      <nav
        className="fixed left-0 w-full bg-white/80 dark:bg-[#002655]/80 backdrop-blur-md
                   z-50 border-b border-[#002655]/10 dark:border-white/10 shadow-sm"
        style={{ top: '2.5rem' }}
      >
        {/* Top row: logo + search + actions */}
        <div className="w-full max-w-7xl mx-auto px-6 flex items-center justify-between py-2">
          {/* Hamburger (mobile only) */}
          <button
            onClick={() => setMobileOpen(true)}
            className="md:hidden p-2 -ml-2 rounded-lg hover:bg-surface-container transition-colors text-outline"
            aria-label="Menü öffnen"
          >
            <span className="material-symbols-outlined">menu</span>
          </button>

          <a href="/" className="text-2xl font-black text-primary dark:text-white font-headline">
            boerse.de
          </a>

          <div className="flex items-center gap-4">
            <div className="relative hidden lg:block">
              <span className="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">
                search
              </span>
              <input
                type="text"
                placeholder="Suche nach WKN/ISIN..."
                className="bg-surface-container-highest rounded-full pl-10 pr-4 py-1.5 text-sm
                           focus:ring-0 border-none w-64 font-body"
              />
            </div>

            <button
              onClick={toggleDark}
              aria-label="Farbmodus wechseln"
              className="p-2 rounded-full hover:bg-surface-container transition-colors text-outline"
            >
              <span className="material-symbols-outlined">
                {dark ? 'light_mode' : 'dark_mode'}
              </span>
            </button>

            <button onClick={openArea} className="btn-primary text-sm hidden sm:block">Login</button>
          </div>
        </div>

        {/* Secondary nav: visible only on md (768–1023px), hidden on sm and lg+ */}
        <div className="hidden md:block lg:hidden border-t border-[#002655]/10 dark:border-white/10 overflow-x-auto">
          <div className="flex items-center px-6">
            {navItems.map((item) => (
              <a
                key={item.label}
                href={item.href}
                onClick={(e) => handleNavClick(e, item.href)}
                className={`whitespace-nowrap px-4 py-2 text-sm font-headline font-semibold transition-colors border-b-2 ${
                  activeHref === item.href
                    ? 'text-primary dark:text-white border-primary dark:border-blue-400'
                    : 'text-slate-600 dark:text-slate-300 border-transparent hover:text-primary dark:hover:text-white hover:border-primary/40'
                }`}
              >
                {item.label}
              </a>
            ))}
          </div>
        </div>
      </nav>

      <MobileNav open={mobileOpen} onClose={() => setMobileOpen(false)} />
    </>
  )
}
