import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import ModuleList from '../components/moduleList/ModuleList';
import AddModuleModal from '../components/AddModuleModal';
import ModuleListHeader from '../components/moduleList/ModuleListHeader';
import ModulePagination from '../components/moduleList/ModulePagination';
import { useTheme } from '../contexts/ThemeContext';
import { useModule } from '../contexts/DisplayContext';
import UpdateModuleModal from '../components/UpdateModuleModal';

const Modules: React.FC = () => {
  const [showAddModal, setShowAddModal] = useState(false);
  const [showUpdateModal, setShowUpdateModal] = useState(false);
  const navigate = useNavigate();
  const { darkMode, toggleDarkMode } = useTheme();
  const { page, totalPages, setPage } = useModule();
  const [currentModuleId, setCurrentModuleId] = useState<number | undefined>(
    undefined
  );

  const handleModuleDetails = (moduleId: number) => {
    navigate(`/modules/${moduleId}`);
  };
  const handleModuleUpdate = (moduleId: number) => {
    setShowUpdateModal(true);
    setCurrentModuleId(moduleId);
  };

  const { addModule } = useModule();

  return (
    <div className='min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-200'>
      <div className='container mx-auto px-4 py-8'>
        <ModuleListHeader
          onAdd={() => setShowAddModal(true)}
          onToggleDarkMode={toggleDarkMode}
          darkMode={darkMode}
        />
        <ModuleList
          onModuleDetails={handleModuleDetails}
          onModuleUpdate={handleModuleUpdate}
        />
        <ModulePagination
          page={page}
          totalPages={totalPages}
          onPageChange={setPage}
        />
        {showAddModal && (
          <AddModuleModal
            onClose={() => setShowAddModal(false)}
            onAdd={addModule}
          />
        )}
        {showUpdateModal && !!currentModuleId && (
          <UpdateModuleModal
            moduleId={currentModuleId}
            onClose={() => setShowUpdateModal(false)}
          ></UpdateModuleModal>
        )}
      </div>
    </div>
  );
};

export default Modules;
