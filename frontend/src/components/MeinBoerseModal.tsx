import { useState } from 'react'
import { useLoginModal } from '../hooks/useLoginModal'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogDescription,
} from '@/components/ui/dialog'
import { Tabs, TabsList, TabsTrigger, TabsContent } from '@/components/ui/tabs'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox'

const benefits = [
  {
    icon: 'dashboard',
    title: 'mein.boerse.de-Startseite',
    desc: 'Individualisierte Markt- und Portfolioübersicht',
  },
  {
    icon: 'account_balance',
    title: 'mein.boerse.de-Musterdepots',
    desc: 'Depots und Watchlists zum risikolosen Testen von Anlagestrategien',
  },
  {
    icon: 'show_chart',
    title: 'Charts personalisieren',
    desc: 'Individuell konfigurierbares Profi-Chart-Tool',
  },
  {
    icon: 'card_giftcard',
    title: 'mein.boerse.de-Prämienprogramm',
    desc: 'Attraktive Prämien rund um das Thema Börse',
  },
]

export function MeinBoerseModal() {
  const { view, openArea, close } = useLoginModal()

  const [username, setUsername] = useState('')
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [passwordRepeat, setPasswordRepeat] = useState('')
  const [consent, setConsent] = useState(false)

  const [loginUser, setLoginUser] = useState('')
  const [loginPass, setLoginPass] = useState('')

  return (
    <Dialog open={view === 'mein-boerse'} onOpenChange={(open) => !open && close()}>
      <DialogContent className="max-w-3xl p-0 overflow-hidden max-h-[90vh] overflow-y-auto">
        {/* Header */}
        <DialogHeader className="px-8 py-6 border-b border-outline-variant/10">
          <div className="flex items-center gap-3">
            <div className="size-10 rounded-xl bg-primary/10 flex items-center justify-center">
              <span className="material-symbols-outlined text-primary">person</span>
            </div>
            <div>
              <DialogTitle className="font-headline font-black text-xl text-primary text-left">
                mein.boerse.de
              </DialogTitle>
              <DialogDescription className="text-xs text-secondary text-left">
                Das persönliche Finanzportal
              </DialogDescription>
            </div>
          </div>
        </DialogHeader>

        {/* Body */}
        <div className="p-8 grid md:grid-cols-2 gap-8">
          {/* Left: Benefits */}
          <div className="bg-surface-container-low rounded-xl p-6">
            <h3 className="font-headline font-bold text-on-surface text-sm mb-5 uppercase tracking-wider text-secondary">
              Vorteile für Mitglieder
            </h3>
            <div className="flex flex-col gap-4">
              {benefits.map((b) => (
                <div key={b.title} className="flex items-start gap-3">
                  <div className="size-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0 mt-0.5">
                    <span className="material-symbols-outlined text-primary text-base">{b.icon}</span>
                  </div>
                  <div>
                    <p className="font-headline font-bold text-on-surface text-sm">{b.title}</p>
                    <p className="font-body text-xs text-secondary mt-0.5 leading-relaxed">{b.desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Right: Tabs */}
          <div>
            <Tabs defaultValue="register">
              <TabsList className="w-full mb-6 bg-surface-container-low rounded-xl p-1">
                <TabsTrigger
                  value="register"
                  className="flex-1 rounded-lg font-headline font-semibold data-[state=active]:bg-white data-[state=active]:text-primary data-[state=active]:shadow-sm"
                >
                  Registrieren
                </TabsTrigger>
                <TabsTrigger
                  value="login"
                  className="flex-1 rounded-lg font-headline font-semibold data-[state=active]:bg-white data-[state=active]:text-primary data-[state=active]:shadow-sm"
                >
                  Anmelden
                </TabsTrigger>
              </TabsList>

              {/* Register */}
              <TabsContent value="register">
                <form className="flex flex-col gap-3" onSubmit={(e) => e.preventDefault()}>
                  <Input
                    type="text"
                    placeholder="Benutzername*"
                    value={username}
                    onChange={(e) => setUsername(e.target.value)}
                    className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
                  />
                  <Input
                    type="email"
                    placeholder="E-Mail*"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
                  />
                  <Input
                    type="password"
                    placeholder="Passwort*"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
                  />
                  <Input
                    type="password"
                    placeholder="Passwort wiederholen*"
                    value={passwordRepeat}
                    onChange={(e) => setPasswordRepeat(e.target.value)}
                    className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
                  />

                  <div className="flex items-start gap-3 pt-1">
                    <Checkbox
                      id="consent"
                      checked={consent}
                      onCheckedChange={(v) => setConsent(Boolean(v))}
                      className="mt-0.5 accent-primary"
                    />
                    <label htmlFor="consent" className="text-xs text-secondary leading-relaxed cursor-pointer">
                      Hiermit stimme ich der{' '}
                      <a href="#" className="text-primary underline hover:no-underline">
                        Datenschutzerklärung
                      </a>{' '}
                      zu.
                    </label>
                  </div>

                  <Button type="submit" className="btn-primary w-full py-3 h-auto rounded-full">
                    Jetzt kostenlos registrieren
                  </Button>

                  <p className="text-[10px] text-secondary leading-relaxed pt-1">
                    * Pflichtfeld. Ich bin damit einverstanden, dass die TM Börsenverlag AG und die
                    Schwestergesellschaft boerse.de Vermögensverwaltung GmbH mir regelmäßig Informationen
                    zuschickt. Meine Einwilligung kann ich jederzeit widerrufen.
                  </p>
                </form>
              </TabsContent>

              {/* Login */}
              <TabsContent value="login">
                <form className="flex flex-col gap-3" onSubmit={(e) => e.preventDefault()}>
                  <Input
                    type="text"
                    placeholder="Benutzername oder E-Mail"
                    value={loginUser}
                    onChange={(e) => setLoginUser(e.target.value)}
                    className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
                  />
                  <Input
                    type="password"
                    placeholder="Passwort"
                    value={loginPass}
                    onChange={(e) => setLoginPass(e.target.value)}
                    className="bg-surface-container-highest border-none rounded-xl py-3 font-body placeholder:text-secondary"
                  />

                  <Button type="submit" className="btn-primary w-full py-3 h-auto rounded-full">
                    Jetzt anmelden
                  </Button>

                  <div className="text-right">
                    <a href="#" className="text-xs text-primary hover:underline">
                      Passwort vergessen?
                    </a>
                  </div>

                  <div className="pt-3 border-t border-outline-variant/10 text-center flex flex-col gap-2">
                    <p className="text-xs text-secondary">Noch kein Konto?</p>
                  </div>
                </form>
              </TabsContent>
            </Tabs>

            {/* Back to area selection */}
            <div className="pt-4 border-t border-outline-variant/10 text-center">
              <button
                onClick={openArea}
                className="text-xs text-secondary hover:text-primary transition-colors"
              >
                ← Anderen Login-Bereich wählen
              </button>
            </div>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  )
}
