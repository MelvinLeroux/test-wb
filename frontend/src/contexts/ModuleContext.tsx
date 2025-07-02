import React, {
  createContext,
  useContext,
  useState,
  useCallback,
  useEffect,
} from 'react';
import { getAllModules } from '../api/modules';
import { Module, ModulePut } from '../types';
import { deleteModule } from '../api/module';
import { addNewModule } from '../api/module';
import { updateModule } from '../api/module';

interface ModuleContextType {
  modules: Module[];
  page: number;
  totalPages: number;
  setPage: (page: number) => void;
  deleteModuleById: (id: number) => void;
  addModule: (newModule: Pick<Module, 'name' | 'sensors'>) => Promise<void>;
  updateModuleById: (id: number, data: ModulePut) => Promise<void>;
}

const ModuleContext = createContext<ModuleContextType | undefined>(undefined);

export const ModuleProvider: React.FC<{ children: React.ReactNode }> = ({
  children,
}) => {
  const [modules, setModules] = useState<Module[]>([]);
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);

  const fetchModules = useCallback(async (currentPage = 1) => {
    try {
      const response = await getAllModules(currentPage, 6);
      setModules(response.data);
      setTotalPages(response.pages);
    } catch (error) {
      console.error('Erreur de chargement des modules :', error);
    }
  }, []);

  const deleteModuleById = async (id: number) => {
    try {
      await deleteModule(id);
      setModules(prevModules => prevModules.filter(module => module.id !== id));
    } catch (err) {
      console.error('Erreur lors de la suppression du module :', err);
    }
  };

  const addModule = async (newModule: Pick<Module, 'name' | 'sensors'>) => {
    try {
      const payload = await addNewModule(newModule);

      modules.push(payload);
    } catch (error) {
      console.error('Erreur:', error);
      throw error;
    }
  };

  const updateModuleById = async (id: number, data: ModulePut) => {
    try {
      const payload = await updateModule(id, data);
      console.log(payload);
      const moduleIndex = modules.findIndex(module => module.id === id);

      const updatedModule = { ...modules[moduleIndex], ...data };
      modules[moduleIndex] = updatedModule;
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  useEffect(() => {
    fetchModules(page);
  }, [page, fetchModules]);

  return (
    <ModuleContext.Provider
      value={{
        modules,
        page,
        totalPages,
        setPage,
        deleteModuleById,
        addModule,
        updateModuleById,
      }}
    >
      {children}
    </ModuleContext.Provider>
  );
};

export const useModule = (): ModuleContextType => {
  const context = useContext(ModuleContext);
  if (!context) {
    throw new Error('useModule doit être utilisé dans un ModuleProvider');
  }
  return context;
};
