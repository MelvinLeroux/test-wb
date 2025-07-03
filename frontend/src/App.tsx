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

function App() {
  return (
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
  );
}

export default App;
