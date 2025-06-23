import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import ModuleList from '../components/moduleList/ModuleList';
import AddModuleModal from '../components/AddModuleModal';
import ModuleListHeader from '../components/moduleList/ModuleListHeader';
import ModulePagination from '../components/moduleList/ModulePagination';
import { useTheme } from '../contexts/ThemeContext';
import { Module } from '../types';
import { getAllModules } from '../api/modules';
import { addNewModule } from '../api/module';

const LIMIT = 6;

const Modules: React.FC = () => {
  const [modules, setModules] = useState<Module[]>([]);
  const [showAddModal, setShowAddModal] = useState(false);
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const navigate = useNavigate();
  const { darkMode, toggleDarkMode } = useTheme();

  useEffect(() => {
    fetchModules(page);
  }, [page]);

  const fetchModules = async (page = 1) => {
    try {
      const response = await getAllModules(page, LIMIT);
      const result = response;
      setModules(result.data);
      setTotalPages(result.pages);
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  const handleModuleDetails = (module: Module) => {
    navigate(`/modules/${module.id}`);
  };

  const handleAddModule = async (
    newModule: Pick<Module, 'name' | 'sensors'>
  ) => {
    try {
      const createdModule = await addNewModule(newModule);
      setModules(prevModules => [...prevModules, createdModule]);
      setShowAddModal(false);
    } catch (error) {
      console.error('Erreur:', error);
      // Tu peux ajouter une notification ou autre ici
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
        <ModuleList modules={modules} onModuleDetails={handleModuleDetails} />
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
