// src/components/ui/Button.jsx
import React from 'react';

// Button Component
const Button = ({ children, onClick, disabled = false, variant = 'primary', className = '' }) => {
  const baseClasses = "w-full py-3 px-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center space-x-2 transform hover:scale-[1.02] active:scale-[0.98]";
  
  const variants = {
    primary: "bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none",
    secondary: "bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
  };

  return (
    <button
      onClick={onClick}
      disabled={disabled}
      className={`${baseClasses} ${variants[variant]} ${className}`}
    >
      {children}
    </button>
  );
};

export default Button;