// src/components/auth/AuthContent.jsx
import React from 'react';
import { useAuth } from '../../contexts/AuthContext';
import Dashboard from './Dashboard';
import Login from './Login';
import Register from './Register';

// Auth Content Component
const AuthContent = ({ currentView, setCurrentView }) => {
  const { user } = useAuth();

  if (user) {
    return <Dashboard />;
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center px-4">
      <div className="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 w-full max-w-md border border-white/20">
        {currentView === 'login' ? (
          <Login onSwitchToRegister={() => setCurrentView('register')} />
        ) : (
          <Register onSwitchToLogin={() => setCurrentView('login')} />
        )}
      </div>
    </div>
  );
};

export default AuthContent;