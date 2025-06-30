import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import ModuleListPage from './pages/Modules';
import ModuleDetails from './pages/ModuleDetails';
import { ThemeProvider } from './contexts/ThemeContext';
import './App.css';
import { DisplayProvider } from './contexts/DisplayContext';

function App() {
  return (
    <ThemeProvider>
      <DisplayProvider>
        <Router>
          <Routes>
            <Route path='/' element={<ModuleListPage />} />
            <Route path='/modules/:id' element={<ModuleDetails />} />
          </Routes>
        </Router>
      </DisplayProvider>
    </ThemeProvider>
  );
}

export default App;
