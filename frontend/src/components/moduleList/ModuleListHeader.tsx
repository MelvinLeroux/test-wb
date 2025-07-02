import React from 'react';
import { Button } from '../../design-system/Button';
interface ModuleListHeaderProps {
  onAdd: () => void;
  onToggleDarkMode: () => void;
  darkMode: boolean;
}

const ModuleListHeader: React.FC<ModuleListHeaderProps> = ({
  onAdd,
  onToggleDarkMode,
  darkMode,
}) => (
  <div className='flex justify-between items-center mb-8'>
    <h1 className='text-3xl font-bold text-gray-900 dark:text-white'>
      Modules
    </h1>
    <div className='flex items-center gap-4'>
      <Button
        onClick={onAdd}
        className='px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
      >
        Ajouter un module
      </Button>
      <Button onClick={onToggleDarkMode} size='xs' variant='secondary'>
        {darkMode ? '☀️' : '🌙'}
      </Button>
    </div>
  </div>
);

export default ModuleListHeader;
