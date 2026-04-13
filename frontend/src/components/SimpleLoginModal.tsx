import { useState } from 'react'
import { useLoginModal } from '../hooks/useLoginModal'
import type { LoginView } from '../hooks/useLoginModal'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogDescription,
} from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'

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

  return (
    <Dialog open={view === cfg.view} onOpenChange={(open) => !open && close()}>
      <DialogContent className="max-w-md p-0 overflow-hidden">
        {/* Header */}
        <DialogHeader className="px-8 py-6 border-b border-outline-variant/10 flex-row items-center gap-3">
          <div className="size-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
            <span className="material-symbols-outlined text-primary">{cfg.icon}</span>
          </div>
          <div>
            <DialogTitle className="font-headline font-black text-on-surface text-lg text-left">
              {cfg.title}
            </DialogTitle>
            <DialogDescription className="text-xs text-secondary text-left">
              {cfg.subtitle}
            </DialogDescription>
          </div>
        </DialogHeader>

        {/* Body */}
        <div className="px-8 py-6 flex flex-col gap-4">
          {cfg.hint && (
            <p className="text-sm text-secondary bg-surface-container-low rounded-xl px-4 py-3 leading-relaxed">
              {cfg.hint}
            </p>
          )}

          <form className="flex flex-col gap-3" onSubmit={(e) => e.preventDefault()}>
            <Input
              type="text"
              placeholder={cfg.userLabel}
              value={user}
              onChange={(e) => setUser(e.target.value)}
              className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
            />
            <Input
              type="password"
              placeholder="Passwort"
              value={pass}
              onChange={(e) => setPass(e.target.value)}
              className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
            />

            <Button type="submit" className="btn-primary w-full py-3 h-auto rounded-full">
              Jetzt anmelden
            </Button>

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
      </DialogContent>
    </Dialog>
  )
}
