import React, { useMemo, useState } from 'react';
import { Module } from '../types';
import { DropDown } from '../design-system/DropDown';
import { Button } from '../design-system/Button';
interface AddModuleModalProps {
  onClose: () => void;
  onAdd: (module: Partial<Module>) => Promise<void>;
}

const optionsData = [
  { id: 1, name: 'temperature' },
  { id: 2, name: 'humidity' },
  { id: 3, name: 'pressure' },
];

const AddModuleModal: React.FC<AddModuleModalProps> = ({ onClose, onAdd }) => {
  const [name, setName] = useState('');
  const [sensors, setSensors] = useState<string[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const filteredOptions = useMemo(() => {
    return optionsData.filter(option => !sensors.includes(option.name));
  }, [sensors]);

  const handleAddSensor = (sensorName: string) => {
    if (sensorName && !sensors.includes(sensorName)) {
      setSensors([...sensors, sensorName]);
    }
  };

  const handleRemoveSensor = (sensorToRemove: string) => {
    setSensors(sensors.filter(sensor => sensor !== sensorToRemove));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!name.trim()) {
      setError('Le nom du module est requis');
      return;
    }

    setLoading(true);
    setError(null);

    try {
      await onAdd({
        name: name.trim(),
        sensors: sensors,
      });
      onClose();
    } catch (err) {
      console.error('Erreur lors de la création du module:', err);
      setError('Une erreur est survenue lors de la création du module');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className='fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4'>
      <div className='bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-2xl'>
        <div className='flex justify-between items-center mb-6'>
          <h2 className='text-2xl font-bold text-gray-900 dark:text-gray-100'>
            Ajouter un nouveau module
          </h2>
          <Button
            onClick={onClose}
            className='text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 text-2xl font-bold'
            aria-label='Fermer'
          >
            ×
          </Button>
        </div>

        <form onSubmit={handleSubmit} className='space-y-6'>
          <div>
            <label
              htmlFor='name'
              className='block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2'
            >
              Nom du module
            </label>
            <input
              type='text'
              id='name'
              value={name}
              onChange={e => setName(e.target.value)}
              className='w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white'
              placeholder='Entrez le nom du module'
            />
          </div>

          <div>
            <label className='block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2'>
              Capteurs
            </label>
            <div className='flex gap-2 mb-2'>
              <DropDown
                options={filteredOptions}
                onDropDownChange={sensor => {
                  handleAddSensor(sensor.name);
                }}
              />
            </div>
            <div className='flex flex-wrap gap-2'>
              {sensors.map(sensor => (
                <div
                  key={sensor}
                  className='flex items-center gap-2 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full'
                >
                  <span className='text-sm text-gray-700 dark:text-gray-300'>
                    {sensor}
                  </span>
                  <Button
                    onClick={() => handleRemoveSensor(sensor)}
                    className='text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'
                  >
                    ×
                  </Button>
                </div>
              ))}
            </div>
          </div>

          {error && <div className='text-red-500 text-sm'>{error}</div>}

          <div className='flex justify-end gap-4'>
            <Button
              onClick={onClose}
              className='px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg'
            >
              Annuler
            </Button>
            <button
              type='submit'
              disabled={loading}
              className='px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50'
            >
              {loading ? 'Création...' : 'Créer le module'}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default AddModuleModal;
