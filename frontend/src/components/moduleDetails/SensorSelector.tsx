import React from 'react';
import { Button } from '../../design-system/Button';
interface SensorSelectorProps {
  sensors: string[];
  selected: string | null;
  onSelect: (sensor: string) => void;
}

const SensorSelector: React.FC<SensorSelectorProps> = ({
  sensors,
  selected,
  onSelect,
}) => (
  <div className='bg-white dark:bg-gray-800 p-4 rounded-lg shadow'>
    <h2 className='text-xl font-semibold mb-4 text-gray-900 dark:text-white'>
      Capteurs
    </h2>
    <div className='space-y-2'>
      {sensors.map(sensor => (
        <Button
          key={sensor}
          onClick={() => onSelect(sensor)}
          className={`w-full p-3 text-left rounded-lg transition-colors ${
            selected === sensor
              ? 'bg-blue-500 text-white'
              : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
          }`}
        >
          {sensor}
        </Button>
      ))}
    </div>
  </div>
);

export default SensorSelector;
