import React from 'react';
import ModuleCard from './ModuleCard';
import { Module } from '../../types';
interface ModuleListProps {
  modules: Module[];
  onModuleDetails: (module: Module) => void;
}

const ModuleList: React.FC<ModuleListProps> = ({
  modules,
  onModuleDetails,
}) => {
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
          onDetails={() => {
            onModuleDetails(module);
          }}
        />
      ))}
    </div>
  );
};

export default ModuleList;
