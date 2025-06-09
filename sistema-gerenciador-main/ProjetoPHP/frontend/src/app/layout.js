import './globals.css'
import Navbar from '../components/Navbar'

export const metadata = {
  title: 'Minha App',
  description: 'App com Next.js + MUI',
}

export default function RootLayout({ children }) {
  return (
    <html lang="pt-BR">
      <body>
        {/* Wrapper geral */}
        <div style={{ flex: 1, display: 'flex', flexDirection: 'column' }}>
          <Navbar />
          {/* Área do conteúdo renderizado pelas rotas */}
          <main style={{ flex: 1, overflowY: 'auto', padding: '1rem' }}>
            {children}
          </main>
        </div>
      </body>
    </html>
  )
}
