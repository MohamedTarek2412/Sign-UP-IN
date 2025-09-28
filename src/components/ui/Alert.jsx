// src/components/ui/Alert.jsx
import React from 'react';
import { CheckCircle, XCircle } from 'lucide-react';

// Alert Component
const Alert = ({ type = 'info', message, onClose }) => {
  const types = {
    success: {
      bg: 'bg-green-50 border-green-200',
      text: 'text-green-800',
      icon: CheckCircle,
      iconColor: 'text-green-500'
    },
    error: {
      bg: 'bg-red-50 border-red-200',
      text: 'text-red-800',
      icon: XCircle,
      iconColor: 'text-red-500'
    }
  };

  const config = types[type];
  const IconComponent = config.icon;

  return (
    <div className={`p-4 rounded-lg border ${config.bg} ${config.text} mb-4`}>
      <div className="flex items-center">
        <IconComponent className={`w-5 h-5 mr-2 ${config.iconColor}`} />
        <span>{message}</span>
        {onClose && (
          <button
            onClick={onClose}
            className="ml-auto text-gray-400 hover:text-gray-600"
          >
            ×
          </button>
        )}
      </div>
    </div>
  );
};

export default Alert;