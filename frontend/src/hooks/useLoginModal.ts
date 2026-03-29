import { createContext, useContext, useState, useCallback } from 'react'

export type LoginView = 'area' | 'mein-boerse' | 'boersenverlag' | 'investoren-club' | null

interface LoginModalContextValue {
  view: LoginView
  openArea: () => void
  openMeinBoerse: () => void
  openBoersenverlag: () => void
  openInvestorenClub: () => void
  close: () => void
}

export const LoginModalContext = createContext<LoginModalContextValue>({
  view: null,
  openArea: () => {},
  openMeinBoerse: () => {},
  openBoersenverlag: () => {},
  openInvestorenClub: () => {},
  close: () => {},
})

export function useLoginModalProvider() {
  const [view, setView] = useState<LoginView>(null)

  const openArea = useCallback(() => setView('area'), [])
  const openMeinBoerse = useCallback(() => setView('mein-boerse'), [])
  const openBoersenverlag = useCallback(() => setView('boersenverlag'), [])
  const openInvestorenClub = useCallback(() => setView('investoren-club'), [])
  const close = useCallback(() => setView(null), [])

  return { view, openArea, openMeinBoerse, openBoersenverlag, openInvestorenClub, close }
}

export function useLoginModal() {
  return useContext(LoginModalContext)
}
