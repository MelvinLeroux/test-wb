import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import ModuleListPage from './pages/Modules';
import ModuleDetails from './pages/ModuleDetails';
import LoginPage from './pages/Login';
import SignupPage from './pages/SignUp';
import { ThemeProvider } from './contexts/ThemeContext';
import './App.css';
import { ModuleProvider } from './contexts/ModuleContext';
import { AuthProvider } from './contexts/AuthContext';
import { ErrorBoundary } from 'react-error-boundary';
import { ErrorBoundaryComponent } from './components/errors/ErrorBoundaryComponent';
import * as Sentry from '@sentry/react';
import { createRoot } from 'react-dom/client';

Sentry.init({
  dsn: 'https://f1eb8c978f027bc91d7b708c77b27eab@o4509637677678592.ingest.de.sentry.io/4509637679120464',
  // Setting this option to true will send default PII data to Sentry.
  // For example, automatic IP address collection on events
  sendDefaultPii: true,
});

function App() {
  return (
    <ErrorBoundary FallbackComponent={ErrorBoundaryComponent}>
      <AuthProvider>
        <ThemeProvider>
          <ModuleProvider>
            <Router>
              <Routes>
                <Route path='/login' element={<LoginPage />} />
                <Route path='/' element={<ModuleListPage />} />
                <Route path='/modules/:id' element={<ModuleDetails />} />
                <Route path='/signup' element={<SignupPage></SignupPage>} />
              </Routes>
            </Router>
          </ModuleProvider>
        </ThemeProvider>
      </AuthProvider>
    </ErrorBoundary>
  );
}
const container = document.getElementById('app'); // ⚠️ doit correspondre à <div id="app"></div> dans index.html

if (container) {
  const root = createRoot(container);
  root.render(<App />);
} else {
  console.error('Élément #app introuvable dans le DOM.');
}
export default App;
