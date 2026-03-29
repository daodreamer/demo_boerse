const brands = [
  { label: 'TM Börsenverlag',               sub: 'Est. 1987',                              bold: false },
  { label: 'boerse.de',                     sub: 'Europas erstes Finanzportal · seit 1994', bold: true  },
  { label: 'BOERSE.DE VERMÖGENSVERWALTUNG', sub: '',                                        bold: false },
  { label: 'boerse.de INSTITUT',            sub: '',                                        bold: false },
  { label: 'boerse.de SHOP',                sub: '',                                        bold: false },
  { label: 'BOERSE.DE GOLD',                sub: '',                                        bold: false },
  { label: 'BOERSE.DE GROUP AG',            sub: 'FinTech seit 1987',                       bold: true  },
]

export function GroupBar() {
  return (
    <div className="fixed left-0 w-full bg-white z-[60]" style={{ top: 0, height: '2.5rem', borderBottom: '1px solid #e8eaed' }}>
      <div className="h-full flex items-stretch w-full">
        {brands.map((b, i) => (
          <a
            key={b.label}
            href="#"
            className="flex flex-col items-center justify-center transition-colors hover:bg-surface-container-low"
            style={{
              flex: 1,
              borderRight: '1px solid #e8eaed',
              textDecoration: 'none',
              borderLeft: i === 0 ? '1px solid #e8eaed' : undefined,
            }}
          >
            <span className="font-headline leading-none text-center whitespace-nowrap" style={{ fontSize: 11, fontWeight: b.bold ? 800 : 600, color: '#002655' }}>
              {b.label}
            </span>
            {b.sub && (
              <span className="font-body leading-none mt-0.5 text-center whitespace-nowrap" style={{ fontSize: 9, color: '#737782' }}>
                {b.sub}
              </span>
            )}
          </a>
        ))}
      </div>
    </div>
  )
}
