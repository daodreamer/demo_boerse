import type { HeroStory, NewsItem } from '../types/api'

interface Props {
  hero: HeroStory
  newsItems: NewsItem[]
}

export function HeroSection({ hero, newsItems }: Props) {
  const cardNews = newsItems.filter((n) => n.style === 'card')
  const listNews = newsItems.filter((n) => n.style === 'list')

  return (
    <section id="news" className="mb-8">
      <div className="grid lg:grid-cols-2 gap-6">
        {/* Hero */}
        <div className="relative rounded-xl overflow-hidden cursor-pointer group aspect-[16/9]">
          <img src={hero.image} alt={hero.headline} className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
          <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent" />
          <div className="absolute bottom-0 left-0 right-0 p-6">
            <span className="inline-block bg-primary text-on-primary text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">
              {hero.tag}
            </span>
            <h2 className="font-headline font-bold text-white text-xl leading-snug mb-2">{hero.headline}</h2>
            <p className="font-body text-white/80 text-sm line-clamp-2">{hero.lead}</p>
            <button className="mt-4 btn-primary text-xs">
              Jetzt lesen <span className="material-symbols-outlined text-sm align-middle">arrow_forward</span>
            </button>
          </div>
        </div>

        {/* News */}
        <div className="flex flex-col gap-4">
          {cardNews.map((item, i) => (
            <div key={i} className="flex gap-4 bg-white ghost-border rounded-xl overflow-hidden cursor-pointer hover:shadow-md transition-shadow">
              <img src={item.image} alt={item.title} className="w-28 h-24 object-cover flex-shrink-0" />
              <div className="p-3 flex flex-col justify-center">
                <div className="flex items-center gap-2 mb-1">
                  <span className="text-[10px] font-bold text-primary uppercase tracking-wider">{item.category}</span>
                  <span className="text-[10px] text-secondary">{item.timestamp}</span>
                </div>
                <p className="font-headline font-bold text-on-surface text-sm line-clamp-2">{item.title}</p>
                <p className="font-body text-secondary text-xs mt-1 line-clamp-2">{item.excerpt}</p>
              </div>
            </div>
          ))}

          {listNews.map((item, i) => (
            <div key={i} className="flex gap-3 cursor-pointer hover:bg-surface-container-low rounded-lg px-2 py-1.5 transition-colors">
              <span className="material-symbols-outlined text-secondary mt-0.5 text-base">chevron_right</span>
              <div>
                <div className="flex items-center gap-2 mb-0.5">
                  <span className="text-[10px] font-bold text-primary uppercase tracking-wider">{item.category}</span>
                  <span className="text-[10px] text-secondary">{item.timestamp}</span>
                </div>
                <p className="font-headline font-semibold text-on-surface text-sm line-clamp-2">{item.title}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
