// src/components/ui/Input.jsx
import React from 'react';
import { Eye, EyeOff, XCircle } from 'lucide-react';

// Input Component
const Input = ({ 
  type = "text", 
  placeholder, 
  value, 
  onChange, 
  icon: Icon, 
  error,
  disabled = false,
  showPasswordToggle = false,
  onTogglePassword,
  name
}) => {
  return (
    <div className="relative">
      <div className="relative">
        {Icon && (
          <Icon className=" left-3 top-1/2 transform -translate-y-1/2 text-gray-600 w-5 h-5" /> 
        )}
        <input
          type={type}
          name={name}
          placeholder={placeholder}
          value={value}
          onChange={onChange}
          disabled={disabled}
          className={`w-full pl-${Icon ? '10' : '3'} pr-${showPasswordToggle ? '10' : '3'} py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/10 backdrop-blur-sm text-gray-800 ${ // أضفت text-gray-800 لجعل لون النص أسود/غامق
            error 
              ? 'border-red-500 focus:ring-red-500' 
              : 'border-gray-300 hover:border-gray-400'
          } ${disabled ? 'opacity-50 cursor-not-allowed' : ''}`}
        />
        {showPasswordToggle && (
          <button
            type="button"
            onClick={onTogglePassword}
            className="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800 transition-colors" // غيرت text-gray-400 إلى text-gray-600 ليكون أغمق
          >
            {type === 'password' ? <EyeOff className="w-5 h-5" /> : <Eye className="w-5 h-5" />}
          </button>
        )}
      </div>
      {error && (
        <p className="mt-2 text-sm text-red-600 flex items-center">
          <XCircle className="w-4 h-4 mr-1" />
          {error}
        </p>
      )}
    </div>
  );
};

export default Input;