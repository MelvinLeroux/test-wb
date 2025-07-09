import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { useTheme } from '../contexts/ThemeContext';
import { Module } from '../types';
import ModuleHeader from '../components/moduleDetails/ModuleHeader';
import SensorSelector from '../components/moduleDetails/SensorSelector';
import ModuleStatusMessage from '../components/moduleDetails/ModuleStatusMessage';
import SensorChart from '../components/moduleDetails/SensorChart';
import { getCurrentModule } from '../api/module';
import * as Sentry from '@sentry/react';

const ModuleDetails: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const navigate = useNavigate();
  const [module, setModule] = useState<Module | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [selectedSensor, setSelectedSensor] = useState<string | null>(null);
  const { darkMode } = useTheme();

  useEffect(() => {
    fetchModuleDetails();
    // eslint-disable-next-line
  }, [id]);

  const fetchModuleDetails = async () => {
    if (!id) return;
    setLoading(true);
    setError(null);
    try {
      const response = await getCurrentModule(id);
      const data = response;
      setModule(data);
      if (data.sensors && data.sensors.length > 0) {
        setSelectedSensor(data.sensors[0]);
      }
    } catch (error) {
      Sentry.captureException(error);
    } finally {
      setLoading(false);
    }
  };

  if (!module) {
    return (
      <ModuleStatusMessage
        loading={loading}
        error={error}
        status={1}
        name={''}
        onBack={() => navigate('/')}
      />
    );
  }

  // Affichage des messages d'état (chargement, erreur, module arrêté)
  const statusMessage = (
    <ModuleStatusMessage
      loading={loading}
      error={error}
      status={module.status}
      name={module.name}
      onBack={() => navigate('/')}
    />
  );
  if (loading || error || module.status === 0 || module.status === false) {
    return statusMessage;
  }

  return (
    <div className='min-h-screen bg-gray-100 dark:bg-gray-900'>
      <div className='container mx-auto px-4 py-8'>
        <ModuleHeader name={module.name} onBack={() => navigate('/')} />
        <div className='grid grid-cols-1 md:grid-cols-4 gap-6'>
          <div className='md:col-span-1'>
            <SensorSelector
              sensors={module.sensors}
              selected={selectedSensor}
              onSelect={setSelectedSensor}
            />
          </div>
          <div className='md:col-span-3 bg-white dark:bg-gray-800 p-6 rounded-lg shadow'>
            <div className='h-[500px]'>
              <SensorChart
                measurements={module.measurements || []}
                selectedSensor={selectedSensor!}
                darkMode={darkMode}
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ModuleDetails;
