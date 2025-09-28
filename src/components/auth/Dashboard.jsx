// src/components/auth/Dashboard.jsx
import React from 'react';
import { User, LogIn } from 'lucide-react';
import { useAuth } from '../../contexts/AuthContext';
import Button from '../ui/Button';

// Dashboard Component (when user is logged in)
const Dashboard = () => {
  const { user, logout } = useAuth();

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center px-4">
      <div className="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <div className="text-center mb-6">
          <div className="w-20 h-20 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
            <User className="w-10 h-10 text-white" />
          </div>
          <h2 className="text-3xl font-bold text-gray-800 mb-2">Welcome, {user?.name}!</h2>
          <p className="text-gray-600">{user?.email}</p>
        </div>
        
        <Button onClick={logout} variant="secondary">
          <LogIn className="w-5 h-5 transform rotate-180" />
          <span>Logout</span>
        </Button>
      </div>
    </div>
  );
};

export default Dashboard;