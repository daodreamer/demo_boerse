const footerColumns = [
  {
    heading: 'WISSEN',
    links: ['Leitfaden für Ihr Vermögen', 'Investment-Philosophie', 'Börsenvision', 'Performance-Analyse', 'Champions-Aktien'],
  },
  {
    heading: 'INFOS',
    links: ['boerse.de Aktien-Ausblick', 'Thomas Müller Realdepot', 'myC100-Millionen-Depot', 'boerse.de-Stiftung', 'Spenden'],
  },
  {
    heading: 'SPECIAL',
    links: ['Mission pro Börse', 'Rosenheimer Investorenabend', 'Börsenmuseum', 'boerse.de-Investoren-Club', 'boerse.de-Broker'],
  },
  {
    heading: 'ÜBER UNS',
    links: ['Wer wir sind', 'boerse.de-Aktienbrief', 'boerse.de-Gold', 'boerse.de-Fonds', 'boerse.de-Einzelkontenverwaltung'],
  },
]

const legalLinks = ['Kontakt', 'Sitemap', 'Werben auf boerse.de', 'Impressum', 'Disclaimer/Datenschutz', 'Datenschutz-Einstellungen']
const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('')

export function Footer() {
  return (
    <footer style={{ paddingLeft: 0 }}>
      {/* Newsletter */}
      <div className="bg-surface-container-low text-center" style={{ padding: '3.5rem 2rem', paddingLeft: 'calc(16rem + 2rem)' }}>
        <p className="font-headline font-bold text-primary" style={{ fontSize: '1.25rem', marginBottom: '0.5rem' }}>
          Jetzt kostenlos: boerse.de Aktien-Ausblick
        </p>
        <p className="font-body text-secondary" style={{ fontSize: '0.875rem', marginBottom: '2rem' }}>
          Wöchentliche Marktanalyse direkt in Ihrem Postfach. Kostenlos und jederzeit abbestellbar.
        </p>
        <form style={{ display: 'inline-flex', gap: '0.75rem', alignItems: 'center', marginBottom: '1rem' }}>
          <input
            type="email"
            placeholder="Ihre E-Mail-Adresse"
            className="font-body bg-white ghost-border text-on-surface"
            style={{ outline: 'none', width: 260, padding: '0.625rem 1.25rem', borderRadius: 9999, fontSize: '0.875rem' }}
          />
          <button type="submit" className="btn-primary font-bold" style={{ padding: '0.625rem 1.5rem', borderRadius: 9999, fontSize: '0.875rem', whiteSpace: 'nowrap' }}>
            Kostenlos eintragen
          </button>
        </form>
        <p className="font-body text-secondary" style={{ fontSize: '0.7rem', opacity: 0.7 }}>
          Mit der Anmeldung stimmen Sie unserer Datenschutzerklärung zu. Abmeldung jederzeit möglich.
        </p>
      </div>

      {/* Dark body */}
      <div style={{ background: '#1e2527', padding: '4rem 4rem 4rem calc(16rem + 4rem)' }}>
        <div className="grid" style={{ gridTemplateColumns: 'repeat(4, minmax(0, 1fr))', gap: '3rem' }}>
          {footerColumns.map((col) => (
            <div key={col.heading}>
              <p className="text-xs font-bold tracking-widest uppercase mb-6" style={{ color: 'rgba(255,255,255,0.45)' }}>
                {col.heading}
              </p>
              <ul className="space-y-3">
                {col.links.map((link) => (
                  <li key={link}>
                    <a href="#" className="text-sm transition-colors" style={{ color: 'rgba(255,255,255,0.7)' }}
                      onMouseOver={(e) => (e.currentTarget.style.color = '#fff')}
                      onMouseOut={(e) => (e.currentTarget.style.color = 'rgba(255,255,255,0.7)')}>
                      {link}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </div>

      {/* Bottom bar */}
      <div style={{ background: '#1e2527', borderTop: '1px solid rgba(255,255,255,0.08)', padding: '2rem 4rem 2rem calc(16rem + 4rem)' }}>
        <div style={{ display: 'flex', flexDirection: 'column', gap: '0.75rem' }}>
          <div className="flex flex-wrap items-center gap-y-1">
            {legalLinks.map((item, i) => (
              <span key={item} className="flex items-center">
                <a href="#" className="text-xs transition-colors" style={{ color: 'rgba(255,255,255,0.45)' }}
                  onMouseOver={(e) => (e.currentTarget.style.color = 'rgba(255,255,255,0.8)')}
                  onMouseOut={(e) => (e.currentTarget.style.color = 'rgba(255,255,255,0.45)')}>
                  {item}
                </a>
                {i < legalLinks.length - 1 && (
                  <span className="text-xs px-3" style={{ color: 'rgba(255,255,255,0.2)' }}>|</span>
                )}
              </span>
            ))}
          </div>
          <p style={{ fontSize: 11, color: 'rgba(255,255,255,0.3)' }}>
            © 1994–2026 by boerse.de – Quelle für Kurse und Daten: ariva.ag – boerse.de übernimmt keine Gewähr
          </p>
          <div className="flex flex-wrap items-center gap-y-1">
            <span className="text-[11px] font-bold uppercase tracking-widest mr-3" style={{ color: 'rgba(255,255,255,0.3)' }}>
              Beliebteste Werte
            </span>
            {alphabet.map((letter) => (
              <a key={letter} href="#" className="text-[11px] font-bold px-1 transition-colors"
                style={{ color: 'rgba(255,255,255,0.35)' }}
                onMouseOver={(e) => (e.currentTarget.style.color = '#fff')}
                onMouseOut={(e) => (e.currentTarget.style.color = 'rgba(255,255,255,0.35)')}>
                {letter}
              </a>
            ))}
          </div>
        </div>
      </div>
    </footer>
  )
}
