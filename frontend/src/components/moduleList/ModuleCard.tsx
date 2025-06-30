import React from 'react';
import { Button } from '../../design-system/Button';
import { Module } from '../../types';
import { useDisplay } from '../../contexts/DisplayContext';
interface ModuleCardProps {
  module: Module;
  onDetails: () => void;
  detailsLabel?: string;
  deleteLabel?: string;
}

const ModuleCard: React.FC<ModuleCardProps> = ({
  module,
  onDetails,
  detailsLabel = 'Détails',
  deleteLabel = 'Supprimer',
}) => {
  const { deleteModuleById } = useDisplay();

  return (
    <div className='bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 w-72 max-w-xs flex flex-col justify-between transition-colors duration-300 mx-auto'>
      <div>
        <h5 className='text-xl font-bold mb-2 text-gray-900 dark:text-gray-100'>
          {module.name}
        </h5>
        <h6 className='text-sm text-gray-500 dark:text-gray-300 mb-1'>
          Liste des capteurs
        </h6>
        <ul className='mb-4 list-disc list-inside text-gray-700 dark:text-gray-200'>
          {module.sensors && module.sensors.length > 0 ? (
            module.sensors.map((type, idx) => <li key={idx}>{type}</li>)
          ) : (
            <li className='italic text-gray-400 dark:text-gray-500'>
              Aucun capteur
            </li>
          )}
        </ul>
      </div>
      <Button
        className='mt-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition'
        onClick={onDetails}
      >
        {detailsLabel}
      </Button>
      <Button onClick={() => deleteModuleById(module.id)}>{deleteLabel}</Button>
    </div>
  );
};

export default ModuleCard;
