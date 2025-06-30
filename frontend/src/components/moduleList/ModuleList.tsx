import React from 'react';
import ModuleCard from './ModuleCard';
import { useModule } from '../../contexts/DisplayContext';

const ModuleList: React.FC<{
  onModuleDetails: (moduleId: number) => void;
  onModuleUpdate: (moduleId: number) => void;
}> = ({ onModuleDetails, onModuleUpdate }) => {
  const { modules } = useModule();

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
          onUpdate={() => onModuleUpdate(module.id)}
        />
      ))}
    </div>
  );
};

export default ModuleList;
