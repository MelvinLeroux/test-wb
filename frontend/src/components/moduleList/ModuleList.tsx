import React from 'react';
import ModuleCard from './ModuleCard';
import { useDisplay } from '../../contexts/DisplayContext';

const ModuleList: React.FC<{ onModuleDetails: (moduleId: number) => void }> = ({
  onModuleDetails,
}) => {
  const { modules } = useDisplay();

  if (modules.length === 0) {
    return (
      <div className='text-center text-gray-500 dark:text-gray-400'>
        Aucun module disponible
      </div>
    );
  }

  return (
    <div className='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6'>
      {modules.map(module => (
        <ModuleCard
          key={module.id}
          module={module}
          onDetails={() => onModuleDetails(module.id)}
        />
      ))}
    </div>
  );
};

export default ModuleList;
