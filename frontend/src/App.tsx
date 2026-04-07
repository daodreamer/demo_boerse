import { Routes, Route } from 'react-router-dom'
import { ActiveSectionContext, useActiveSectionProvider } from './hooks/useActiveSection'
import { LoginModalContext, useLoginModalProvider } from './hooks/useLoginModal'
import { LoginAreaModal } from './components/LoginAreaModal'
import { MeinBoerseModal } from './components/MeinBoerseModal'
import { SimpleLoginModal } from './components/SimpleLoginModal'
import { GroupBar } from './components/layout/GroupBar'
import { TopNav } from './components/layout/TopNav'
import { Sidebar } from './components/layout/Sidebar'
import { Footer } from './components/layout/Footer'
import { HomePage } from './pages/HomePage'
import { IpoPage } from './pages/IpoPage'

export default function App() {
  const activeSectionValue = useActiveSectionProvider()
  const loginModalValue = useLoginModalProvider()

  return (
    <LoginModalContext.Provider value={loginModalValue}>
    <ActiveSectionContext.Provider value={activeSectionValue}>
      <div className="min-h-screen bg-surface font-body">
        <GroupBar />
        <TopNav />
        <Sidebar />

        {/* pt-24 (6rem) on sm + lg+, pt-[8.5rem] on md where secondary nav is visible */}
        <div className="lg:pl-64 pt-24 md:pt-[8.5rem] lg:pt-24">
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/ipos" element={<IpoPage />} />
          </Routes>
          <Footer />
        </div>
      </div>

      <LoginAreaModal />
      <MeinBoerseModal />
      <SimpleLoginModal configKey="boersenverlag" />
      <SimpleLoginModal configKey="investoren-club" />
    </ActiveSectionContext.Provider>
    </LoginModalContext.Provider>
  )
}
