import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import ModuleList from '../components/moduleList/ModuleList';
import AddModuleModal from '../components/AddModuleModal';
import ModuleListHeader from '../components/moduleList/ModuleListHeader';
import ModulePagination from '../components/moduleList/ModulePagination';
import { useTheme } from '../contexts/ThemeContext';
import { useDisplay } from '../contexts/DisplayContext';
import { Module } from '../types';
import { addNewModule } from '../api/module';

const Modules: React.FC = () => {
  const [showAddModal, setShowAddModal] = useState(false);
  const navigate = useNavigate();
  const { darkMode, toggleDarkMode } = useTheme();
  const { page, totalPages, setPage, refreshModules } = useDisplay();

  const handleModuleDetails = (moduleId: number) => {
    navigate(`/modules/${moduleId}`);
  };

  const handleAddModule = async (
    newModule: Pick<Module, 'name' | 'sensors'>
  ) => {
    try {
      await addNewModule(newModule);
      refreshModules(); // recharge les modules depuis le contexte
      setShowAddModal(false);
    } catch (error) {
      console.error('Erreur:', error);
      throw error;
    }
  };

  return (
    <div className='min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-200'>
      <div className='container mx-auto px-4 py-8'>
        <ModuleListHeader
          onAdd={() => setShowAddModal(true)}
          onToggleDarkMode={toggleDarkMode}
          darkMode={darkMode}
        />
        <ModuleList onModuleDetails={handleModuleDetails} />
        <ModulePagination
          page={page}
          totalPages={totalPages}
          onPageChange={setPage}
        />
        {showAddModal && (
          <AddModuleModal
            onClose={() => setShowAddModal(false)}
            onAdd={handleAddModule}
          />
        )}
      </div>
    </div>
  );
};

export default Modules;
