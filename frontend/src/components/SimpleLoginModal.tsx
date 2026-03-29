import { useState } from 'react'
import { useLoginModal } from '../hooks/useLoginModal'
import type { LoginView } from '../hooks/useLoginModal'

interface Config {
  view: LoginView
  icon: string
  title: string
  subtitle: string
  userLabel: string
  forgotLabel: string
  hint?: string
}

const configs: Record<string, Config> = {
  boersenverlag: {
    view: 'boersenverlag',
    icon: 'menu_book',
    title: 'Börsenverlag',
    subtitle: 'Ihr Abobereich · Seit 1987',
    userLabel: 'Benutzername oder E-Mail',
    forgotLabel: 'Passwort vergessen?',
    hint: 'Ihr Zugang zu allen Börsenverlag-Abonnements und Newslettern.',
  },
  'investoren-club': {
    view: 'investoren-club',
    icon: 'groups',
    title: 'BOERSE.DE Investoren-Club',
    subtitle: 'Ihr Investorenbereich',
    userLabel: 'Benutzername oder E-Mail',
    forgotLabel: 'Passwort vergessen?',
    hint: 'Exklusiver Zugang zu Investorenanalysen, Musterdepots und Club-Events.',
  },
}

interface Props {
  configKey: 'boersenverlag' | 'investoren-club'
}

export function SimpleLoginModal({ configKey }: Props) {
  const { view, openArea, close } = useLoginModal()
  const cfg = configs[configKey]

  const [user, setUser] = useState('')
  const [pass, setPass] = useState('')

  if (view !== cfg.view) return null

  const inputClass =
    'w-full bg-surface-container-highest border-none rounded-xl px-4 py-3 text-sm font-body text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-secondary'

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4" onClick={close}>
      <div className="absolute inset-0 bg-black/40 backdrop-blur-sm" />

      <div
        className="relative bg-white dark:bg-[#001a3a] rounded-2xl shadow-2xl w-full max-w-md"
        onClick={(e) => e.stopPropagation()}
      >
        {/* Close */}
        <button
          onClick={close}
          className="absolute top-4 right-4 p-1.5 rounded-full hover:bg-surface-container transition-colors text-outline"
        >
          <span className="material-symbols-outlined">close</span>
        </button>

        {/* Header */}
        <div className="px-8 py-6 border-b border-outline-variant/10 flex items-center gap-3">
          <div className="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
            <span className="material-symbols-outlined text-primary">{cfg.icon}</span>
          </div>
          <div>
            <h2 className="font-headline font-black text-on-surface text-lg">{cfg.title}</h2>
            <p className="text-xs text-secondary">{cfg.subtitle}</p>
          </div>
        </div>

        {/* Body */}
        <div className="px-8 py-6 space-y-4">
          {cfg.hint && (
            <p className="text-sm text-secondary bg-surface-container-low rounded-xl px-4 py-3 leading-relaxed">
              {cfg.hint}
            </p>
          )}

          <form className="space-y-3" onSubmit={(e) => e.preventDefault()}>
            <input
              type="text"
              placeholder={cfg.userLabel}
              value={user}
              onChange={(e) => setUser(e.target.value)}
              className={inputClass}
            />
            <input
              type="password"
              placeholder="Passwort"
              value={pass}
              onChange={(e) => setPass(e.target.value)}
              className={inputClass}
            />

            <button type="submit" className="btn-primary w-full py-3 text-sm justify-center">
              Jetzt anmelden
            </button>

            <div className="flex items-center justify-between pt-1">
              <a href="#" className="text-xs text-primary hover:underline">{cfg.forgotLabel}</a>
            </div>
          </form>

          {/* Back link */}
          <div className="pt-3 border-t border-outline-variant/10 text-center">
            <button
              onClick={openArea}
              className="text-xs text-secondary hover:text-primary transition-colors"
            >
              ← Anderen Login-Bereich wählen
            </button>
          </div>
        </div>
      </div>
    </div>
  )
}
