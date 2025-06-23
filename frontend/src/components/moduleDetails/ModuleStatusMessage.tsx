import { Button } from '../../design-system/Button';
import React from 'react';

interface ModuleStatusMessageProps {
  loading: boolean;
  error: string | null;
  status: boolean | number;
  name: string;
  onBack: () => void;
}

const ModuleStatusMessage: React.FC<ModuleStatusMessageProps> = ({
  loading,
  error,
  status,
  name,
  onBack,
}) => {
  if (loading) {
    return (
      <div className='min-h-screen bg-gray-100 dark:bg-gray-900 flex items-center justify-center'>
        <div className='text-xl text-gray-700 dark:text-gray-300'>
          Chargement...
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className='min-h-screen bg-gray-100 dark:bg-gray-900 flex items-center justify-center'>
        <div className='text-xl text-red-500'>{error}</div>
      </div>
    );
  }

  if (status === 0 || status === false) {
    return (
      <div className='min-h-screen bg-gray-100 dark:bg-gray-900 flex items-center justify-center'>
        <div className='bg-white dark:bg-gray-800 p-8 rounded-lg shadow text-center'>
          <h1 className='text-3xl font-bold text-gray-900 dark:text-white mb-4'>
            {name}
          </h1>
          <p className='text-xl text-red-600 dark:text-red-400 mb-4'>
            Ce module est arrêté. Les graphiques ne sont pas disponibles.
          </p>
          <Button
            onClick={onBack}
            className='px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600'
          >
            Retour à la liste
          </Button>
        </div>
      </div>
    );
  }

  return null;
};

export default ModuleStatusMessage;
