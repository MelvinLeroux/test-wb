import React from 'react';
import { Button } from '../../design-system/Button';
interface ModuleHeaderProps {
  name: string;
  onBack: () => void;
}

const ModuleHeader: React.FC<ModuleHeaderProps> = ({ name, onBack }) => (
  <div className='flex justify-between items-center mb-8'>
    <h1 className='text-3xl font-bold text-gray-900 dark:text-white'>{name}</h1>
    <Button
      onClick={onBack}
      className='px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600'
    >
      Retour à la liste
    </Button>
  </div>
);

export default ModuleHeader;
