import React, { useState } from 'react';
import { Button } from '../design-system/Button';
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  ChartData,
} from 'chart.js';
import { Line } from 'react-chartjs-2';
import { Module } from '../types';

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
);

interface ModuleDetailsModalProps {
  module: Module | null;
  onClose: () => void;
  loading: boolean;
  error: string | null;
}

const ModuleDetailsModal: React.FC<ModuleDetailsModalProps> = ({
  module,
  onClose,
  loading,
  error,
}) => {
  const [selectedSensor, setSelectedSensor] = useState<string | null>(null);

  if (!module && !loading && !error) return null;

  const getChartData = (): ChartData<'line', number[], string> => {
    if (!selectedSensor || !module?.measurements) {
      return {
        labels: [],
        datasets: [
          {
            label: '',
            data: [],
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 2,
            tension: 0.3,
            fill: true,
            pointRadius: 4,
            pointHoverRadius: 6,
          },
        ],
      };
    }

    const sensorMeasurements = module.measurements.filter(
      m => m.sensor === selectedSensor
    );

    return {
      labels: sensorMeasurements.map(m =>
        new Date(m.createdAt).toLocaleTimeString()
      ),
      datasets: [
        {
          label: `Mesures du capteur ${selectedSensor}`,
          data: sensorMeasurements.map(m => m.value),
          borderColor: 'rgb(75, 192, 192)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderWidth: 2,
          tension: 0.3,
          fill: true,
          pointRadius: 4,
          pointHoverRadius: 6,
        },
      ],
    };
  };

  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'top' as const,
        labels: {
          font: {
            size: 14,
          },
        },
      },
      title: {
        display: true,
        text: 'Évolution des mesures',
        font: {
          size: 18,
        },
        padding: 20,
      },
      tooltip: {
        backgroundColor: 'rgba(0, 0, 0, 0.8)',
        titleFont: {
          size: 14,
        },
        bodyFont: {
          size: 14,
        },
        padding: 12,
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          font: {
            size: 12,
          },
        },
        grid: {
          color: 'rgba(0, 0, 0, 0.1)',
        },
      },
      x: {
        ticks: {
          font: {
            size: 12,
          },
          maxRotation: 45,
          minRotation: 45,
        },
        grid: {
          color: 'rgba(0, 0, 0, 0.1)',
        },
      },
    },
  };

  return (
    <div className='fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4'>
      <div className='bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-6xl max-h-[90vh] relative flex flex-col'>
        <Button onClick={onClose} aria-label='Fermer'>
          ×
        </Button>
        {loading && <div className='text-center py-8'>Chargement…</div>}
        {error && <div className='text-red-500 text-center py-8'>{error}</div>}
        {!loading && !error && module && (
          <>
            <h2 className='text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100 pr-8'>
              {module.name}
            </h2>
            <div className='flex-1 grid grid-cols-1 md:grid-cols-4 gap-6 min-h-0'>
              <div className='md:col-span-1 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg overflow-y-auto'>
                <h3 className='text-xl font-semibold mb-4 text-gray-700 dark:text-gray-200'>
                  Capteurs :
                </h3>
                <ul className='space-y-2'>
                  {module.sensors && module.sensors.length > 0 ? (
                    module.sensors.map((type, idx) => (
                      <li
                        key={idx}
                        className={`p-3 rounded-lg cursor-pointer transition-all duration-200 ${
                          selectedSensor === type
                            ? 'bg-blue-500 text-white'
                            : 'hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200'
                        }`}
                        onClick={() => setSelectedSensor(type)}
                      >
                        {type}
                      </li>
                    ))
                  ) : (
                    <li className='italic text-gray-400 dark:text-gray-500'>
                      Aucun capteur
                    </li>
                  )}
                </ul>
              </div>
              <div className='md:col-span-3 bg-white dark:bg-gray-700 p-6 rounded-lg flex flex-col min-h-[500px]'>
                {selectedSensor ? (
                  module.measurements &&
                  module.measurements.some(m => m.sensor === selectedSensor) ? (
                    <div className='flex-1'>
                      <Line data={getChartData()} options={chartOptions} />
                    </div>
                  ) : (
                    <p className='text-center text-gray-500 dark:text-gray-400 text-lg'>
                      Aucune donnée disponible pour ce capteur
                    </p>
                  )
                ) : (
                  <p className='text-center text-gray-500 dark:text-gray-400 text-lg'>
                    Sélectionnez un capteur pour voir le graphique
                  </p>
                )}
              </div>
            </div>
          </>
        )}
      </div>
    </div>
  );
};

export default ModuleDetailsModal;
