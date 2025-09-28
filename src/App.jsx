// src/App.jsx
import React, { useState } from 'react';
import { AuthProvider } from './contexts/AuthContext';
import AuthContent from './components/auth/AuthContent';

const App = () => {
  const [currentView, setCurrentView] = useState('login');
  return (
    <div className="bg-blue-500 text-white p-4">
      <AuthProvider>
        <AuthContent currentView={currentView} setCurrentView={setCurrentView} />
      </AuthProvider>
    </div>
  );
};

export default App;