import { createContext, useContext, useState, useCallback } from 'react'
import type React from 'react'

interface ActiveSectionContextValue {
  activeHref: string | null
  handleNavClick: (e: React.MouseEvent<HTMLAnchorElement>, href: string) => void
}

const SCROLL_OFFSET = 96 // 6rem header height

export const ActiveSectionContext = createContext<ActiveSectionContextValue>({
  activeHref: null,
  handleNavClick: () => {},
})

export function useActiveSectionProvider() {
  const [activeHref, setActiveHref] = useState<string | null>(null)

  const handleNavClick = useCallback(
    (e: React.MouseEvent<HTMLAnchorElement>, href: string) => {
      if (href === '#') return
      e.preventDefault()
      const target = document.querySelector(href)
      if (!target) return
      const top = target.getBoundingClientRect().top + window.scrollY - SCROLL_OFFSET
      window.scrollTo({ top, behavior: 'smooth' })
      setActiveHref(href)
    },
    [],
  )

  return { activeHref, handleNavClick }
}

export function useActiveSection() {
  return useContext(ActiveSectionContext)
}
