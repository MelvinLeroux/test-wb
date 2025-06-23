import React from 'react';
import { Line } from 'react-chartjs-2';
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
import { Measurement } from '../../types';

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
);

interface SensorChartProps {
  measurements: Measurement[];
  selectedSensor: string;
  darkMode: boolean;
}

const SensorChart: React.FC<SensorChartProps> = ({
  measurements,
  selectedSensor,
  darkMode,
}) => {
  const sensorMeasurements =
    measurements?.filter(m => m.sensor === selectedSensor) || [];

  const chartData: ChartData<'line', number[], string> = {
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
          color: darkMode ? '#fff' : '#000',
        },
      },
      title: {
        display: true,
        text: 'Évolution des mesures',
        font: {
          size: 18,
        },
        color: darkMode ? '#fff' : '#000',
        padding: 20,
      },
      tooltip: {
        backgroundColor: darkMode
          ? 'rgba(0, 0, 0, 0.8)'
          : 'rgba(255, 255, 255, 0.8)',
        titleColor: darkMode ? '#fff' : '#000',
        bodyColor: darkMode ? '#fff' : '#000',
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
          color: darkMode ? '#fff' : '#000',
        },
        grid: {
          color: darkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
        },
      },
      x: {
        ticks: {
          font: {
            size: 12,
          },
          color: darkMode ? '#fff' : '#000',
          maxRotation: 45,
          minRotation: 45,
        },
        grid: {
          color: darkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
        },
      },
    },
  };

  if (!selectedSensor) {
    return (
      <div className='h-full flex items-center justify-center text-gray-500 dark:text-gray-400'>
        Sélectionnez un capteur pour voir le graphique
      </div>
    );
  }

  if (!sensorMeasurements.length) {
    return (
      <div className='h-full flex items-center justify-center text-gray-500 dark:text-gray-400'>
        Aucune donnée disponible pour ce capteur
      </div>
    );
  }

  return <Line data={chartData} options={chartOptions} />;
};

export default SensorChart;
