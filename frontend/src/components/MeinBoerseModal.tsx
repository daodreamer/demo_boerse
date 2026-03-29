import { useState } from 'react'
import { useLoginModal } from '../hooks/useLoginModal'

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

type Tab = 'register' | 'login'

export function MeinBoerseModal() {
  const { view, openArea, close } = useLoginModal()
  const [tab, setTab] = useState<Tab>('register')

  const [username, setUsername] = useState('')
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [passwordRepeat, setPasswordRepeat] = useState('')
  const [consent, setConsent] = useState(false)

  const [loginUser, setLoginUser] = useState('')
  const [loginPass, setLoginPass] = useState('')

  if (view !== 'mein-boerse') return null

  const inputClass =
    'w-full bg-surface-container-highest border-none rounded-xl px-4 py-3 text-sm font-body text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all placeholder:text-secondary'

  return (
    <div
      className="fixed inset-0 z-[100] flex items-start justify-center overflow-y-auto p-4 py-10"
      onClick={close}
    >
      <div className="absolute inset-0 bg-black/40 backdrop-blur-sm" />

      <div
        className="relative bg-white dark:bg-[#001a3a] rounded-2xl shadow-2xl w-full max-w-3xl"
        onClick={(e) => e.stopPropagation()}
      >
        {/* Close */}
        <button
          onClick={close}
          className="absolute top-4 right-4 z-10 p-1.5 rounded-full hover:bg-surface-container transition-colors text-outline"
        >
          <span className="material-symbols-outlined">close</span>
        </button>

        {/* Header */}
        <div className="px-8 py-6 border-b border-outline-variant/10">
          <div className="flex items-center gap-3 mb-1">
            <div className="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
              <span className="material-symbols-outlined text-primary">person</span>
            </div>
            <div>
              <h2 className="font-headline font-black text-xl text-primary">mein.boerse.de</h2>
              <p className="text-xs text-secondary">Das persönliche Finanzportal</p>
            </div>
          </div>
        </div>

        {/* Body */}
        <div className="p-8 grid md:grid-cols-2 gap-8">

          {/* Left: Benefits */}
          <div className="bg-surface-container-low rounded-xl p-6">
            <h3 className="font-headline font-bold text-on-surface text-sm mb-5 uppercase tracking-wider text-secondary">
              Vorteile für Mitglieder
            </h3>
            <div className="space-y-4">
              {benefits.map((b) => (
                <div key={b.title} className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
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

          {/* Right: Tab-based register / login */}
          <div>
            {/* Tabs */}
            <div className="flex ghost-border rounded-xl p-1 mb-6 bg-surface-container-low">
              <button
                onClick={() => setTab('register')}
                className={`flex-1 py-2 text-sm font-headline font-semibold rounded-lg transition-all ${
                  tab === 'register'
                    ? 'bg-white text-primary shadow-sm'
                    : 'text-secondary hover:text-on-surface'
                }`}
              >
                Registrieren
              </button>
              <button
                onClick={() => setTab('login')}
                className={`flex-1 py-2 text-sm font-headline font-semibold rounded-lg transition-all ${
                  tab === 'login'
                    ? 'bg-white text-primary shadow-sm'
                    : 'text-secondary hover:text-on-surface'
                }`}
              >
                Anmelden
              </button>
            </div>

            {/* Register form */}
            {tab === 'register' && (
              <form className="space-y-3" onSubmit={(e) => e.preventDefault()}>
                <input
                  type="text"
                  placeholder="Benutzername*"
                  value={username}
                  onChange={(e) => setUsername(e.target.value)}
                  className={inputClass}
                />
                <input
                  type="email"
                  placeholder="E-Mail*"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  className={inputClass}
                />
                <input
                  type="password"
                  placeholder="Passwort*"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className={inputClass}
                />
                <input
                  type="password"
                  placeholder="Passwort wiederholen*"
                  value={passwordRepeat}
                  onChange={(e) => setPasswordRepeat(e.target.value)}
                  className={inputClass}
                />

                <label className="flex items-start gap-3 cursor-pointer pt-1">
                  <input
                    type="checkbox"
                    checked={consent}
                    onChange={(e) => setConsent(e.target.checked)}
                    className="mt-0.5 flex-shrink-0 accent-primary w-4 h-4"
                  />
                  <span className="text-xs text-secondary leading-relaxed">
                    Hiermit stimme ich der{' '}
                    <a href="#" className="text-primary underline hover:no-underline">
                      Datenschutzerklärung
                    </a>{' '}
                    zu.
                  </span>
                </label>

                <button
                  type="submit"
                  className="btn-primary w-full py-3 text-sm justify-center"
                >
                  Jetzt kostenlos registrieren
                </button>

                <p className="text-[10px] text-secondary leading-relaxed pt-1">
                  * Pflichtfeld. Ich bin damit einverstanden, dass die TM Börsenverlag AG und die
                  Schwestergesellschaft boerse.de Vermögensverwaltung GmbH mir regelmäßig Informationen
                  zuschickt. Meine Einwilligung kann ich jederzeit widerrufen.
                </p>
              </form>
            )}

            {/* Login form */}
            {tab === 'login' && (
              <form className="space-y-3" onSubmit={(e) => e.preventDefault()}>
                <input
                  type="text"
                  placeholder="Benutzername oder E-Mail"
                  value={loginUser}
                  onChange={(e) => setLoginUser(e.target.value)}
                  className={inputClass}
                />
                <input
                  type="password"
                  placeholder="Passwort"
                  value={loginPass}
                  onChange={(e) => setLoginPass(e.target.value)}
                  className={inputClass}
                />

                <button
                  type="submit"
                  className="btn-primary w-full py-3 text-sm justify-center"
                >
                  Jetzt anmelden
                </button>

                <div className="text-right">
                  <a href="#" className="text-xs text-primary hover:underline">
                    Passwort vergessen?
                  </a>
                </div>

                <div className="pt-3 border-t border-outline-variant/10 text-center">
                  <p className="text-xs text-secondary mb-3">Noch kein Konto?</p>
                  <button
                    type="button"
                    onClick={() => setTab('register')}
                    className="text-sm font-semibold text-primary hover:underline"
                  >
                    Jetzt kostenlos registrieren →
                  </button>
                </div>
              </form>
            )}

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
      </div>
    </div>
  )
}
